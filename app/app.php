<?php

define('PATH_SITE', dirname(dirname(__FILE__)) . '/' );
define('PATH_PRIVATE', dirname(PATH_SITE) . '/private/' );

require_once(PATH_PRIVATE . 'config.barnes-pbi.xzone.fr.php');

if (!defined('ENV')) define('ENV', 'development');

if (!defined('FOLDER_APP')) define('FOLDER_APP', 'app' );
if (!defined('FOLDER_VIEWS')) define('FOLDER_VIEWS', 'views' );
if (!defined('FOLDER_ASSETS')) define('FOLDER_ASSETS', 'dist' );
if (!defined('FOLDER_CLASSES')) define('FOLDER_CLASSES', 'classes' );

if (!defined('PATH_APP')) define('PATH_APP', PATH_SITE . FOLDER_APP . '/' );
if (!defined('PATH_VIEWS')) define('PATH_VIEWS', PATH_SITE . FOLDER_VIEWS . '/' );
if (!defined('PATH_ASSETS')) define('PATH_ASSETS', PATH_SITE . FOLDER_ASSETS . '/' );
if (!defined('PATH_CLASSES')) define('PATH_CLASSES', PATH_APP . FOLDER_CLASSES . '/' );


require_once('./app/functions.php');