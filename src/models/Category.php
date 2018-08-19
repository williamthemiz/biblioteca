<?php
class Category {
	public $id;
	public $name;
  public $active = 1;
  private $connection;
	
	function __construct(){
		$this->connection = Connection::connect();
  }

	function getAll(){
    $query = "SELECT * FROM categories WHERE active = 1";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $categories;
	}

	function get(){
    $query = "SELECT name FROM categories WHERE id = :id and active = 1";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $category = $statement->fetch(PDO::FETCH_ASSOC);
		return $category;
  }

	function save(){
    $query = "INSERT INTO categories (name,active) VALUES (:name,:active)";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
    $statement->bindParam(':active', $this->active, PDO::PARAM_INT);
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
    $query = "UPDATE categories SET active = :active WHERE id = :id";
    $statement=$this->connection->prepare();
    $statement->bindParam(':active',$this->active);
    $statement->bindParam(':id',$this->id);
    $result = $statement->execute();
    return $result;
  }
  
  function filterByName(){
    $query = "SELECT * FROM categories WHERE name LIKE :name AND active = 1";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':name', "%" . $this->name . "%", PDO::PARAM_STR);
    $statement->execute();
		$category = $statement->fetch(PDO::FETCH_ASSOC);
		return $category;
	}
}
?>