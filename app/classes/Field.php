<?php

class Field {
  private static $_types = ['bool', 'array', 'uri', 'url', 'alpha', 'words', 'alphanum', 'int', 'float', 'tel', 'text', 'name', 'file', 'folder', 'address', 'date_dmy', 'date_ymd', 'email'];

  public $id = '';
  public $name = '';
  public $label = '';
  public $required = false;
  public $options = [];

  private $_type = 'bool';
  public function get_type() { return $this->_type; }

  private $_value = null;

  public function __construct($name, $type="text", $label='', $required=false, $options=[]) {
    $this->id = $this->name = $name ?? md5(random_int(0, PHP_INT_MAX));
    $this->label = $label ?? '';
    $this->_type = in_array($type ?? '', self::$_types) ? $type : 'text';
    $this->required = !!$required;
    $this->options = $options ?? [];
  }

  public function to_string() {
    return (string) $this->_value;
  }

  public function __get($prop) {
    if ($prop == 'value') :
      return $this->_value;
    endif;
    return false;
  }

  public function __set($prop, $val='') {
    if ($prop == 'value') :
      switch ($this->_type) :
        case 'array' :
          $this->_value = [];
          if (is_string($val)) :
            $this->_value[] = $val;
          else :
            foreach ($val as $_val) :
              if (!empty($_val??'')) $this->_value[] = (string) $_val;
            endforeach;
          endif;
          break;
        case 'bool' :
          $this->_value = in_array($val, [true, '1', 1, 't', 'true', 'on'], true);
          break;
        case 'int' :
          $this->_value = intval($val);
          break;
        case 'float' :
          $this->_value = floatval($val);
          break;
        case 'date_ymd' :
          list($y, $m, $d) = explode('-', str_replace('/', '-', $val));
          $this->_value = str_pad($y, 4, '0', STR_PAD_LEFT) . '-' . str_pad($m, 2, '0', STR_PAD_LEFT) . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);
          break;
        default :
          $this->_value = (string) $val;
      endswitch;
    endif;
  }
}