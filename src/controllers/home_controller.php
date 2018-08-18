<?php
require_once "models/Book.php";
require_once "models/Category.php";
session_start();

if (true /*isset($_SESSION["usuario"])*/){
  $category = new Category();
  $categories = $category->getAll();
  $book = new Book();
  $books = $book->getAll();
  require_once("views/home_view.phtml");
} else {
	header("location:php/procesos/login.php");
}
?>