<?php 
class Book {
	public $id;
	public $code;
	public $title;
	public $author;
	public $category;
	public $stock;
	public $image;
	public $pages;
	public $editorial;
	public $description;
	public $publication_date;
  private $connection;
  
	function __construct() {
    $this->connection = Connection::connect();
	}

	function getAll(){
    $query = "SELECT * FROM books WHERE stock > 0 LIMIT 32";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $books;
	}

	function get(){
		$query = "SELECT * FROM books WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':id',$this->id);
    $statement->execute();
		$book = $statement->fetch(PDO::FETCH_ASSOC);
		return $book;
	}

	function save(){
		$query = "INSERT INTO books (code,title,author,category,stock,image,pages,editorial,description,publication_date) 
		VALUES (:code,:title,:author,:category,:stock,:image,:pages,:editorial,:description,:publication_date)";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':code',$this->code,PDO::PARAM_INT);
		$statement->bindParam(':title',$this->title,PDO::PARAM_STR);
		$statement->bindParam(':author',$this->author,PDO::PARAM_STR);
		$statement->bindParam(':category',$this->category,PDO::PARAM_INT);
		$statement->bindParam(':stock',$this->stock,PDO::PARAM_INT);
		$statement->bindParam(':image',$this->image,PDO::PARAM_STR);
		$statement->bindParam(':pages',$this->pages,PDO::PARAM_INT); 
		$statement->bindParam(':editorial',$this->editorial,PDO::PARAM_STR); 
		$statement->bindParam(':description',$this->description,PDO::PARAM_STR); 
		$statement->bindParam(':publication_date',$this->publication_date,PDO::PARAM_STR);
    $resultado = $statement->execute();
    return $resultado;
	}

	function update(){
		$query = "UPDATE books SET
		code = :code,
		title = :title,
		autor = :author,
		category = :category,
		stock = :stock,
		image = :image,
		pages = :pages,
		editorial = :editorial,
		description = :description,
		publication_date = :publication_date 
		WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':code',$this->code,PDO::PARAM_INT);
		$statement->bindParam(':title',$this->title,PDO::PARAM_STR);
		$statement->bindParam(':author',$this->author,PDO::PARAM_STR);
		$statement->bindParam(':category',$this->category,PDO::PARAM_INT);
		$statement->bindParam(':stock',$this->stock,PDO::PARAM_INT);
		$statement->bindParam(':image',$this->image,PDO::PARAM_STR);
		$statement->bindParam(':pages',$this->pages,PDO::PARAM_INT); 
		$statement->bindParam(':editorial',$this->editorial,PDO::PARAM_STR); 
		$statement->bindParam(':description',$this->description,PDO::PARAM_STR); 
		$statement->bindParam(':publication_date',$this->publication_date,PDO::PARAM_STR);
    $result = $statement->execute();
    return $result;
	}

	function delete(){
		$query = "DELETE FROM books WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':id',$this->id,PDO::PARAM_INT);
		$result = $statement->execute();
		return $result;
	}

	function decreaseStock(){
		$query = "UPDATE books SET stock = stock - 1 WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':id', $this->id,PDO::PARAM_INT);
		$result = $statement->execute();
		return $result;
	}

	function increaseStock(){
		$query = "UPDATE books SET stock = stock + 1 WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':id', $this->id,PDO::PARAM_INT);
		$result = $statement->execute();
		return $result;
	}

	function sortByStock(){
		$query = "SELECT * FROM books WHERE stock > 0 ORDER BY stock LIMIT 10";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $books;
	}
}
?>