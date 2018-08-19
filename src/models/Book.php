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
	public $active = 1;
  private $connection;
  
	function __construct() {
    $this->connection = Connection::connect();
	}

	function getAll(){
    $query = "SELECT * FROM books WHERE active = 1 AND stock > 0 LIMIT 32";
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
		$query = "INSERT INTO books (code,title,author,category,stock,image,pages,editorial,description,publication_date,active) 
		VALUES (:code,:title,:author,:category,:stock,:image,:pages,:editorial,:description,:publication_date,:active)";
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
		$statement->bindParam(':active',$this->active,PDO::PARAM_INT); 
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
		publication_date = :publication_date WHERE id = :id";
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
		$statement->bindParam(':active',$this->active,PDO::PARAM_INT); 
    $resultado = $statement->execute();
    return $resultado;
	}

	function delete(){
		$query = "UPDATE books SET active = :active WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':active',$this->active,PDO::PARAM_INT);
		$statement->bindParam(':id',$this->id,PDO::PARAM_INT);
		$result = $statement->execute();
		return $result;
	}

	function filter($text){
		$query = "SELECT * FROM books WHERE active = 1 AND stock > 0 AND ((title LIKE :text) OR 
		(code LIKE :text) OR (author LIKE :text) OR (description LIKE :text))";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':text',"%$texto%",PDO::PARAM_STR);
		$statement->execute();
		$books = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $books;
	}

	function filterByTitle($title){
		$query = "SELECT * FROM books WHERE active = 1  AND stock > 0 AND (titulo LIKE :title)";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':title', "%$titulo%",PDO::PARAM_STR);
		$statement->execute();
		$books = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $books;
	}

	function filterByCategory($categoria){
		$query = "SELECT * FROM books WHERE category = :category AND active = 1 AND stock > 0";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':title', $categoria,PDO::PARAM_INT);
		$statement->execute();
		$books = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $books;
	}

/*
	function buscarPorCampo($campo,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$books =$this->connection->query("SELECT * FROM books WHERE activo = 1 AND existencia>0 AND $campo LIKE '%" . $texto . "%'");
		return $books;
	}

	function buscarPorTextoyCat($categoria,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$books =$this->connection->query("SELECT * FROM books WHERE activo = 1 AND existencia>0 AND categoria = $categoria AND ((titulo LIKE '%" . $texto ."%') OR 
			(id LIKE '%" . $texto ."%') OR (autor LIKE '%" . $texto ."%') OR (descripcion LIKE '%" . $texto ."%'))");
		return $books;
	}

	function buscarCompleto($campo,$categoria,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$books =$this->connection->query("SELECT * FROM books WHERE activo = 1 AND existencia>0 AND categoria = $categoria AND $campo LIKE '%" . $texto . "%'");
		return $books;
	}
*/
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
		$query = "SELECT * FROM books WHERE active = 1 AND stock > 0 ORDER BY stock LIMIT 10";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $books;
	}

	 function filtrarbooks($text){
		//muestra todos los books que contienen el texto indicado ordenados por existencias
		$query = "SELECT id,title,stock FROM books WHERE active = 1 AND ((id LIKE :text) 
		OR (titulo LIKE :text) OR (stock LIKE :text)) ORDER BY stock LIMIT 10";
		$statement = $this->connection->prepare($query);
		$statement->bindParam(':text',"%$text%",PDO::PARAM_STR);
		$statement->execute();
		$books = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $books;
		/* while ($statement->fetch()) 
				{
				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$titulo</td>";
				echo "<td>$existencia</td>";
				echo "<td>" . '<a href="pedidos.php?l=' . $id . '">Agregar a pedido</a>' . "</td>";
				echo "</tr>";
			}*/
    }
}
?>