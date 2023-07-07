<?php

if (!defined('ENV')) die();

if (ENV == 'development') :
  error_reporting(E_ALL);
endif;

// Init globals

global $lang, $lang_dft;
if (defined('DEFAULT_LANGUAGE')) $lang_dft = DEFAULT_LANGUAGE;
$lang_dft = $lang_dft ?? 'en_GB';
if (defined('LANGUAGE')) $lang = LANGUAGE;
$lang = $lang ?? $lang_dft;

global $labels, $variables;
$labels = is_file(PATH_APP . 'l18n/texts.'.$lang.'.php') ?
  include(PATH_APP . 'l18n/texts.'.$lang.'.php') :
  include(PATH_APP . 'l18n/texts.'.$lang_dft.'.php');
$variables = include('routes.php');

global $DBConn;
if (defined('DB_HOST')) {
  if (DB_TYPE == 'mssql') {
    try {
      $DBConn = new PDO("sqlsrv:server = tcp:barnes-crm-data-server.database.windows.net,1433; Database = barnes_data", "barnes_admin", "(38EPRa?ZJ");
      if ($DBConn) {
        $DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DBConn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
      } else {
        $DBConn = false;
      }
    } catch(Error $e) {
      $DBConn = false;
      var_dump($e);
    }
  }
  if ($DBConn) {
    register_shutdown_function(function(){
      global $DBConn;
      if (isset($DBConn)) {
        unset($DBConn);
      }
    });
  }
}

session_start();
authenticate();

parse_request();

// Get label

function __($tid='', $dft='') {
  global $labels;
  $l = $labels->{$tid} ?? '';
  if (empty($l)) $l = $dft ?? '';
  if (empty($l)) $l = $tid;
  return (string) $l;
}

function __e($tid='', $dft='') {
  echo __($tid, $dft);
}

// Get variable

function v($vid='') {
  global $variables;
  return $variables->{$vid} ?? false;
}

// Auth
function is_authenticated() {
  return (!empty($_SESSION['auth'] ?? '') && $_SESSION['auth'] == '1');
}

function authenticate() {
  if (get_current_uri() == 'logout') logout();
  else if (!is_authenticated() && !empty($_POST['k'] ?? '') && $_POST['k'] == PASSWORD) {
    $_SESSION['auth'] = '1';
    header('Location: /');
    die();
  }
}

function logout() {
  unset($_SESSION['auth']);
  header('Location: /');
  die();
}

// Get request / page / view

function parse_request() {
  global $request_uri;

  $uri = $_SERVER['REQUEST_URI'] ?? '';
  $uri = trim( preg_replace( ['/\?.*$/', '/\\+/'], ['', '/'], $uri ), '/' );

  $nodes = explode('/', $uri);
  $nodes_cnt = count($nodes);
  if ($nodes_cnt >= 2 && preg_match('/^[1-9][0-9]*$/', $nodes[$nodes_cnt-1]) && $nodes[$nodes_cnt-2] == 'edit') {
    define('EDIT_ID', (int) array_pop($nodes));
    $request_uri = implode('/', $nodes);
  } else {
    define('EDIT_ID', 0);
    $request_uri = $uri;
  }
}

function get_pages() {
  return v('pages');
}

function get_page($uri='') {
  $default = false;
  $pages = v('pages');
  foreach($pages as $page) :
    if (trim($page->uri, '/') == trim($uri, '/')) return $page;
    elseif (!$default && $page->uri == '404') $default = $page;
  endforeach;

  return $default;
}

function get_page_home() {
  return get_page('');
}

function get_current_page() {
  if (!is_authenticated()) {
    
    $uri = 'login';

  } else {

    global $request_uri;
    $uri = $request_uri;
  
  }
  
  return get_page($uri);
}

function get_current_uri() {
  $p = get_current_page();
  return $p->uri ?? '';
}

function get_current_view() {
  $p = get_current_page();
  return $p->view ?? 'index';
}

function get_current_layout() {
  $p = get_current_page();
  return $p->layout ?? 'html';
}

function get_current_menu_label() {
  $p = get_current_page();
  return $p->menu_label ?? get_current_view();
}

function is_home() {
  return (get_current_uri() == '');
}

// Render view

function view($v='', $data=null, $return=false) {
  $v = str_replace('.', '/', $v);
  $v_fname = PATH_VIEWS . trim($v, '/') . '.php';

  if (is_file($v_fname)) :
    if (isset($data)) :
      foreach($data as $varname => $varvalue) :
        $varname = preg_replace('/[^a-z0-9_]/i', '', $varname);
        if (!empty($varname)) $$varname = $varvalue;
      endforeach;
    endif;

    ob_start();
    include ($v_fname);
    $v_content = ob_get_contents();
    ob_end_clean();

    if ($return) return $v_content;
    else echo $v_content;

  endif;

  if ($return) return '';
}

function render() {
  $l_filename = PATH_VIEWS . 'layouts/' . get_current_layout() . '.php';
  if (is_file($l_filename)) :
    include_once($l_filename);
  else :
    echo 'No layout detected.';
  endif;
}

// Page title

function get_page_title() {
  $p = get_current_page();
  $t = __('title_' . $p->uri);

  return (empty($p->uri) || empty($t)) ?
    __('site_title') :
    __('site_title_prefix') . $t;
}

// Miscellaneous

function get_site_link($path='') {
  $nodes = explode('/', trim($path, '/'));
  array_walk($nodes, function($item, $idx){ return urlencode($item); });
  return 'https://'.$_SERVER['HTTP_HOST'].'/'.implode('/', $nodes);
}

function get_page_link($page_uri='') {
  return get_site_link($page_uri);
}

function get_asset_uri($asset='') {
  return get_site_link( FOLDER_ASSETS . '/' . ltrim($asset, '/') );
}

function esc_attr($str) {
  return htmlentities($str ?? '');
}

function esc_html($str) {
  return strip_tags($str ?? '', '<br><a><i><b><strong><em><u><sub><sup><font>');
}