<?php
class Category {
	private $id;
	private $name;
  private $active;
  private $connection;
	
	function __construct(){
		$this->connection = Connection::connect();
  }

	public function setName($name){
		$this->name = $name;
	}

	public function setActive($active){
		$this->active = $active;
	}

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getActive(){
    return $this->active;
  }

	function getAll(){
    $query = "SELECT * FROM categorias WHERE activo = 1";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $categories;
	}

	function get($id){ //cambiar a prepared
		$category = $this->connection->query("SELECT nombre FROM categorias WHERE id = $id and activo=1");
		return $category;
  }
  
	function filterByName($name){
    $query = "SELECT * FROM categorias WHERE nombre LIKE %:name% AND activo=1";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();
		$category = $statement->fetch(PDO::FETCH_ASSOC);
		return $category;
	}

	function save($name){	
    $statement = $this->connection->prepare("INSERT INTO categorias (nombre,activo) VALUES (?,?)");
    $active = 1;
    $statement->bind_param('si', $name, $active);
    $result = $statement->execute();
    return $result;
  }
  
	function update($id,$name){
		$statement=$this->connection->prepare("UPDATE categorias SET nombre=? WHERE id=?");
    $statement->bind_param("si",$name,$id);
    $result=$statement->execute();
    return $result;
	}
	function delete($id){	
    $statement=$this->connection->prepare("UPDATE categorias SET activo = ? WHERE id = ?");
    $active=0;
    $statement->bind_param("ii",$active,$id);
    $result = $statement->execute();
    return $result;
	}
}
?>