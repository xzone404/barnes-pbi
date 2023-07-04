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
    return $this->_method == 'post' ? $_POST : ($method == 'get' ? $_GET : $_REQUEST);
  }


  public function __construct($name, $fields=[], $method=''){

    $this->_name = $name;
    $this->_method = strtolower($method);
    if (!in_array($this->_method, ['post', 'get'])) $this->_method = 'both';
    $this->fields = $fields;
    
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

    if (!$this->get_field_value('human')) :
      $this->_errors[] = 'Vous devez accepter les <b>conditions de conservation et d\'utilisation de mes données personnelles</b>.';
      return;
    endif;
    
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
    // Define DB file
    $filepath = PATH_PRIVATE . 'stockage/' . DBFile;
    $uploadpath = PATH_PRIVATE . 'uploads/';
    $_create = !is_file($filepath);

    // Create db connection
    $db = new SQLite3($filepath, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, DBKey);
    $db->busyTimeout = 60;

    // Init DB file
    if ($_create) :
      $db->exec('CREATE TABLE users (' .
        'pk_item INTEGER PRIMARY KEY AUTOINCREMENT, recipient TEXT, owner_status TEXT, ' .
        'birth_gender TEXT, birth_name TEXT, birth_firstname TEXT, birth_firstname_others TEXT, birth_date TEXT, birth_cp TEXT, birth_city TEXT, birth_country TEXT, ' .
        'contact_name TEXT, contact_firstname TEXT, contact_address TEXT, contact_address2 TEXT, contact_cp TEXT, contact_city TEXT, contact_country TEXT, contact_email TEXT, contact_phone TEXT, ' .
        'curr_name TEXT, curr_address TEXT, curr_address2 TEXT, curr_cp TEXT, curr_city TEXT, curr_country TEXT, curr_email TEXT, curr_phone TEXT, ' .
        //'curr_gender TEXT, curr_name TEXT, curr_firstname TEXT, curr_firstname_others TEXT, curr_address TEXT, curr_address2 TEXT, curr_cp TEXT, curr_city TEXT, curr_country TEXT, curr_email TEXT, curr_phone TEXT, ' .
        'attachment_file_1 TEXT, attachment_file_2 TEXT, attachment_file_3 TEXT, ' .
        'death_cp TEXT, death_city TEXT, death_country TEXT, death_date TEXT, death_num TEXT, ' .
        'other_names TEXT, other_firtnames TEXT, other_cities TEXT, other_jobs TEXT, moreinfos TEXT, excid TEXT' .
      ')');
    endif;

    $query_insert = 'INSERT INTO users ';
    $query_insert_fields = [];
    $query_insert_values = [];
    foreach ($this->fields as $field) :
      if ($field->name == 'human') continue;
      $query_insert_fields[] = $field->name;
      $esc_val = $db->escapeString($field->to_string());

      // Specific for files
      if ($field->get_type() == 'file') {
        $esc_val = '';

        if (isset($_FILES[$field->name]) && $_FILES[$field->name]['size'] > 0) {
          $ext = strtolower(pathinfo($_FILES[$field->name]['name'], PATHINFO_EXTENSION)); // Get original ext
          while(empty($esc_val) || is_file($uploadpath . $esc_val . '.' . $ext)) $esc_val = (new Nonce())->createNonce('file-'.$field->name); // Find a unique name
          $esc_val .= '.' . $ext;
          move_uploaded_file($_FILES[$field->name]['tmp_name'], $uploadpath . $esc_val); // Move /rename file to Uploads
        }
      }

      $query_insert_values[] = $esc_val;
    endforeach;
    $query_insert .= '('.implode(', ', $query_insert_fields).')';
    $query_insert .= 'VALUES (\''.implode('\', \'', $query_insert_values).'\')';
    
    $db->exec($query_insert);

    $db->close();

  }

}