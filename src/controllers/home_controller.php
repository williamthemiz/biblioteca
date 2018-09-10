<?php
require_once "models/Book.php";
require_once "models/Category.php";
session_start();

class HomeController{
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
    echo $this->twig->render('home.html.twig', [
      'rol' => $rol,
      'categories' => $categories,
      'books' => $books,
    ]);
  }
  /*
  public function Crud(){
      $cliente = new cliente();
      
      if(isset($_REQUEST['id'])){
          $cliente = $this->model->Obtener($_REQUEST['id']);
      }
      
      require_once 'view/header.php';
      require_once 'view/cliente/cliente-editar.php';
      
  }
  
  public function Guardar(){
      $cliente = new cliente();
      
      $cliente->id = $_REQUEST['id'];
      $cliente->dni = $_REQUEST['dni'];
      $cliente->Nombre = $_REQUEST['Nombre'];
      $cliente->Apellido = $_REQUEST['Apellido'];
      $cliente->Correo = $_REQUEST['Correo'];  
      $cliente->telefono = $_REQUEST['telefono'];    
    

      $cliente->id > 0 
          ? $this->model->Actualizar($cliente)
          : $this->model->Registrar($cliente);
      
      header('Location: index.php');
  }
  
  public function Eliminar(){
      $this->model->Eliminar($_REQUEST['id']);
      header('Location: index.php');
  }
  */
}
?>