<?php

  ob_start(); // turn on output buffering

  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("UPLOAD_PATH", PUBLIC_PATH . '/upload');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public');
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  /** 
   * Loads all necessary files
   */
  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');
  require_once('upload_functions.php');
  require_once('vendor/autoload.php');
  require_once('vendor/samayo/bulletproof/src/utils/func.image-crop.php');
  require_once('vendor/samayo/bulletproof/src/utils/func.image-resize.php');

  foreach(glob('classes/*.class.php') as $file) {
    require_once($file);
  }

  /** 
   * Autoloads all classes in the directory
   * 
   * @param string $class The class to load
   */
  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');

  /** 
   * Connects to the database and set mysqli objects
   */
  $database = db_connect();
  DatabaseObject::set_database($database);
  Search::set_database($database);

  $session = new Session;
?>