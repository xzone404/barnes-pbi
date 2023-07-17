<?php

require_once(dirname(__FILE__) . '/Field.php');
require_once(dirname(__FILE__) . '/Nonce.php');
require_once(dirname(__FILE__) . '/Validation.php');

class Form {

  public $fields = [];

  private $_name = [];
  public function get_name() { return $this->_name; }

  private $_submit = false;
  private $_errors = [];

  private $_nonce = '';
  public function get_nonce() { return $this->_nonce; }

  private function SUBMIT_VALUES() {
    global $_SQLDATA;
    
    $values = [];

    foreach($this->_method as $method) {
      $values = array_merge(
        $values,
        $method == 'sqldata' ?
          ($_SQLDATA ?? []) :
            ($method == 'post' ?
              ($_POST ?? []) :
                ($method == 'get' ?
                  ($_GET ?? []) :
                    ($_REQUEST ?? [])
                )
            )
      );
    }
    
    return $values;
  }


  public function __construct($name, $fields=[], $method='', $data=[]){

    $this->_name = $name;

    $this->_method = is_string($method) ? [$method] : $method;
    foreach ($this->_method as $k => $m) {
      $m = strtolower($m);
      $this->_method[$k] = (!in_array($m, ['post', 'get', 'sqldata'])) ? 'both' : $m;
    }
    array_unique($this->_method);

    $this->fields = $fields;

    if (!empty($data)) {
      foreach ($this->fields as $field) :
        $field->value = $data[$field->name] ?? '';
      endforeach;
    }
    
    $this->_init();

    $this->_create_new_nonce();

  }


  private function _init(){

    $_FDS = self::SUBMIT_VALUES();

    $this->_submit = (($_FDS['_formid_'] ?? '') == $this->_name);
    if (!$this->_submit) return;

    foreach ($this->fields as $field) :
      $field->value = $_FDS[$field->name] ?? '';
    endforeach;

    $this->validate();

    if ($this->is_valid()) :
      // Save data
      $this->save_data();
    endif;

  }

  public function get_field($fieldname='') {
    foreach ($this->fields as $field) :
      if ($field->name == $fieldname) return $field;
    endforeach;
    return null;
  }

  public function get_field_value($fieldname='') {

    foreach ($this->fields as $field) :
      if ($field->name == $fieldname) return $field->value;
    endforeach;

    return '';
    
  }

  public function get_field_value_esc($fieldname='') {

    return esc_attr($this->get_field_value($fieldname));

  }

  private function _create_new_nonce() {

    $this->_nonce = (new Nonce())->createNonce('form-'.$this->get_name());

  }

  private function _check_nonce() {

    $_FDS = self::SUBMIT_VALUES();
    return (new Nonce())->verifyNonce($_FDS['_frmctrl_']??'', 'form-'.$this->get_name());

  }

  /*public function is_submit() {
    return $this->_submit;
  }*/

  public function is_valid() {

    return $this->_submit && empty($this->_errors);

  }

  public function has_errors() {

    return !empty($this->_errors);

  }

  public function get_errors() {

    return $this->_errors ?? [];

  }

  public function validate() {

    $this->_errors = [];

    if (!$this->_check_nonce()) :
      $this->_errors[] = 'Une erreur est survenue lors de l\'envoi du formulaire. Veuiller le soumettre à nouveau.';
      return;
    endif;

    /*if (!$this->get_field_value('human')) :
      $this->_errors[] = 'Vous devez accepter les <b>conditions de conservation et d\'utilisation de mes données personnelles</b>.';
      return;
    endif;*/
    
    // Only check required first
    $validator = new Validation();

    foreach ($this->fields as $field) :
      if ($field->required)
        $validator->label($field->label)->name($field->name)->value($field->value)->required();
    endforeach;

    if (!$validator->isSuccess()) :
      $this->_errors = $validator->getErrors();
      return;
    endif;

    // Then check values
    $validator = new Validation();

    foreach ($this->fields as $field) :
      $validator->label($field->label)->name($field->name)->value($field->value)->pattern($field->get_type());
    endforeach;

    if (!$validator->isSuccess()) :
      $this->_errors = $validator->getErrors();
      return;
    endif;

    // Then check options
    $validator = new Validation();

    foreach ($this->fields as $field) :
      if ($field->get_type() == 'file' && isset($_FILES[$field->name]) && $_FILES[$field->name]['size'] > 0) {
        $v = $validator->label($field->label)->name($field->name)->file($_FILES[$field->name]);
        if (0 < intval($field->options['MAX_SIZE'] ?? 0)) $v->maxSize(intval($field->options['MAX_SIZE']));
        if (0 < strlen($field->options['VALID_EXT'] ?? '')) {
          $v->exts(strtolower($field->options['VALID_EXT']));
        }
      }
    endforeach;

    if (!$validator->isSuccess()) :
      $this->_errors = $validator->getErrors();
      return;
    endif;

  }

  public function save_data() {
    global $DBConn;

    if ($this->get_field_value('id') > 0 && !empty($_POST['delete'] ?? '')) {

      $q = 'DELETE FROM [' . $this->get_name() . '] WHERE id = :id ;';
      $s = $DBConn->prepare($q);
      $s->execute(['id' => $this->get_field_value('id')]);

    } elseif ($this->get_field_value('id') > 0) {

      $q = 'UPDATE [' . $this->get_name() . '] SET {FIELDS} WHERE id = :id ;';
      $qf = []; $qfv = [];
      foreach ($this->fields as $field){
        if ($field->name != 'id') $qf[] = ' [' . $field->name . '] = :' . $field->name;
        $qfv[$field->name] = $field->to_string();
      }
      $q = str_replace('{FIELDS}', implode(',', $qf), $q);

      $s = $DBConn->prepare($q);
      $s->execute($qfv);

    } else {
      
      $new_id = -1;
      $r = $DBConn->query('SELECT MAX([id]) as max_id FROM [' . $this->get_name() . '];');
      if ($r) {
        foreach ($r as $row) {  
          $new_id = (int) $row['max_id'];
          break;
        }
      } else {
        $errInfo = $DBConn->errorInfo();
        print_r( $errInfo );
      }
      if ($new_id > 0) $new_id++;
      else return false;

      $q = 'INSERT INTO [' . $this->get_name() . '] ({FIELDS}) VALUES ({FIELDS_V}) ;';
      $qf1 = []; $qf2 = []; $qfv = [];
      foreach ($this->fields as $field){
        if (get_current_uri() == 'cluster_bu/edit' && $field->name == 'id') continue;
        $qf1[] = '[' . $field->name . ']';
        $qf2[] = ':' . $field->name;
        $qfv[$field->name] = ($field->name == 'id') ? $new_id : $field->to_string();
      }
      $q = str_replace(['{FIELDS}', '{FIELDS_V}'], [implode(',', $qf1),implode(',', $qf2)], $q);

      $s = $DBConn->prepare($q);
      try {
        $s->execute($qfv);
      } catch(Exception $e) {
        var_dump($e);
        var_dump($s->errorInfo());
      }
    }

  }

}