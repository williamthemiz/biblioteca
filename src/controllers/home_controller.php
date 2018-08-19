<?php
require_once "models/Book.php";
require_once "models/Category.php";
session_start();

if (true /*isset($_SESSION["usuario"])*/){
  $rol = 1;
  $category = new Category();
  $categories = $category->getAll();
  $book = new Book();
  $books = $book->getAll();
  echo $twig->render('home.html.twig', [
    'rol' => $rol,
    'categories' => $categories,
    'books' => $books,
    ]);
} else {
	header("location:php/procesos/login.php");
}
?>