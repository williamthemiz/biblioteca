<?php
class Category {
	public $id;
	public $name;
  private $connection;
	
	function __construct(){
		$this->connection = Connection::connect();
  }

	function getAll(){
    $query = "SELECT * FROM categories";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $categories;
	}

	function get(){
    $query = "SELECT name FROM categories WHERE id = :id";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $category = $statement->fetch(PDO::FETCH_ASSOC);
		return $category;
  }

	function save(){
    $query = "INSERT INTO categories (name) VALUES (:name)";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
    $result = $statement->execute();
    return $result;
  }
  
	function update(){
    $query = "UPDATE categories SET name = :name WHERE id = :id";
		$statement = $this->connection->prepare($query);
    $statement->bindParam(':name',$this->name);
    $statement->bindParam(':id',$this->id);
    $result=$statement->execute();
    return $result;
	}
	function delete(){
    $query = "DELETE FROM categories WHERE id = :id";
    $statement=$this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $result = $statement->execute();
    return $result;
  }
}
?>