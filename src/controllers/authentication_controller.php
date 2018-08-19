<?php
require_once "models/Authentication.php";
session_start();
if (isset($_SESSION["usuario"])) {
	header("location:../../index.php");
}

if (isset($_REQUEST["user"]) && isset($_REQUEST["password"])) {
  $user = $_REQUEST["user"];
  $password = $_REQUEST["password"];
  $auth = new Authentication($user,$password);
  $isLogged = $auth->verify();
  if ($isLogged){
    $_SESSION["user"] = $user;
    $_SESSION["rol"] = $auth->getRole();
  } else {
    $_SESSION["error"] = true;
  }
} else {
  $error = isset($_SESSION["error"]);
  echo $twig->render('login.html.twig', [
    'error' => $error,
  ]);
}
//unset($_SESSION["error"]);
?>