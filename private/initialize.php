<?php 
  session_start();
  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  require_once("functions.php");
  require_once('database.php');
  require_once("query_functions.php");
  require_once('classes/User.class.php');
  require_once('classes/Post.class.php');
  require_once("validation_functions.php");
  require_once("auth_functions.php");


  $db = db_connect();
  $errors = [];