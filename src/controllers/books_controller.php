<?php
require_once "models/Book.php";
require_once "models/Category.php";
session_start();

class BookController{
  private $book;
  private $category;
  private $twig;
  
  function __CONSTRUCT($twig){
    $this->book = new Book();
    $this->category = new Category();
    $this->twig = $twig;
  }
  
  function Index(){
    $rol = 1;
    $categories = $this->category->getAll();
    $books = $this->book->getAll();
    echo $this->twig->render('books.html.twig', [
      'rol' => $rol,
      'categories' => $categories,
      'books' => $books,
    ]);
  }
}
?>