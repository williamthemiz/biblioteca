<?php
require_once "../config/config.php";
require_once "../vendor/autoload.php";
require_once "db/db.php";
require_once "views/twig.php";

if(!isset($_REQUEST['c'])){
  require_once "controllers/home_controller.php";
  $controller = new HomeController($twig);
  $controller->Index();    
} else {
  $controller = strtolower($_REQUEST['c']);
  $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

  switch($controller){
    case 'authentication':
      require_once "controllers/authentication_controller.php";
      $controller = new AuthenticationController($twig);
      call_user_func(array($controller, $action));    
      break;
    case 'books':
      require_once "controllers/books_controller.php";
      $controller = new BookController($twig);
      call_user_func(array($controller, $action));    
      break;
    case 'categories':
      require_once "controllers/categories_controller.php";
      $controller = new CategoryController($twig);
      call_user_func(array($controller, $action));    
      break;
    default:
      echo "404 Not found.";
  }
}
?>
