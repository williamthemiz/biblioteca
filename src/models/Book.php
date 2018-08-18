<?php 
class Book {
	private $code;
	private $title;
	private $author;
	private $category;
	private $stock;
	private $image;
	private $pages;
	private $editorial;
	private $description;
	private $publication_date;
  private $connection;
  
	function __construct() {
    $this->connection = Connection::connect();
	}

	function getAll(){
    $query = "SELECT * FROM libros WHERE activo = 1 AND existencia>0 LIMIT 32";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $books;
	}

	function get($code){
		$book = $this->connection->query("SELECT * FROM libros WHERE codigo=$code");
		if ($book) {
			return mysqli_fetch_array($book);
		}
		return "";
	}

	function agregarLibro($titulo,$autor,$categoria,$existencia,$imagen,$numPaginas,$editorial,$descripcion,$fechaPublicacion)
	{
		$activo = 1;
	$statement = $this->connection->prepare("INSERT INTO libros (titulo,autor,categoria,existencia,imagen,numPaginas,editorial,descripcion,fechaPublicacion,activo) VALUES (?,?,?,?,?,?,?,?,?,?)");

    $statement->bind_param("ssiisissii",$titulo,$autor,$categoria,$existencia,$imagen,$numPaginas,$editorial,$descripcion,$fechaPublicacion,$activo);  
    $resultado = $statement->execute();
    return $resultado;
	}

	function buscarPorTexto($texto)
	{
		$texto = $this->connection->escape_string($texto);
		$libros =$this->connection->query("SELECT * FROM libros WHERE activo = 1 AND existencia>0 AND ((titulo LIKE '%" . $texto ."%') OR 
			(codigo LIKE '%" . $texto ."%') OR (autor LIKE '%" . $texto ."%') OR (descripcion LIKE '%" . $texto ."%'))");
		return $libros;
	}

	function buscarPorTitulo($titulo){
		$r=$this->connection->query("SELECT * FROM libros WHERE (titulo LIKE '%" . $titulo ."%') and activo=1");
		return $r;
	}

	function buscarPorCategoria($categoria)
	{
		$libros =$this->connection->query("SELECT * FROM libros WHERE categoria = $categoria AND activo = 1 AND existencia>0");
		return $libros;
	}

	function buscarPorCampo($campo,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$libros =$this->connection->query("SELECT * FROM libros WHERE activo = 1 AND existencia>0 AND $campo LIKE '%" . $texto . "%'");
		return $libros;
	}

	function buscarPorTextoyCat($categoria,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$libros =$this->connection->query("SELECT * FROM libros WHERE activo = 1 AND existencia>0 AND categoria = $categoria AND ((titulo LIKE '%" . $texto ."%') OR 
			(codigo LIKE '%" . $texto ."%') OR (autor LIKE '%" . $texto ."%') OR (descripcion LIKE '%" . $texto ."%'))");
		return $libros;
	}

	function buscarCompleto($campo,$categoria,$texto)
	{
		$texto = $this->connection->escape_string($texto);
		$libros =$this->connection->query("SELECT * FROM libros WHERE activo = 1 AND existencia>0 AND categoria = $categoria AND $campo LIKE '%" . $texto . "%'");
		return $libros;
	}

	function disminuirExistencia($codigo)
	{
		$statement = $this->connection->prepare("UPDATE libros SET existencia = existencia-1 WHERE codigo=?");
		$statement->bind_param("i",$codigo);
		$resultado = $statement->execute();
	return $resultado;
	}

	function aumentarExistencia($codigo)
	{
		$statement = $this->connection->prepare("UPDATE libros SET existencia = existencia+1 WHERE codigo=?");
		$statement->bind_param("i",$codigo);
		$resultado = $statement->execute();
	return $resultado;
	}

	function modificarLibro($codigo,$titulo,$autor,$categoria,$existencia,$imagen,$numPaginas,$editorial,$descripcion,$fechaPublicacion){
			$statement = $this->connection->prepare("UPDATE libros set 
			titulo=?,autor=?,categoria=?,existencia=?,imagen=?,numPaginas=?,editorial=?,descripcion=?,fechaPublicacion=? where codigo=?");
		    $statement->bind_param("ssiisissii",$titulo,$autor,$categoria,$existencia,$imagen,$numPaginas,$editorial,$descripcion,$fechaPublicacion,$codigo);  
		    $resultado = $statement->execute();
		    return $resultado;
	}

	function modificarLibroSinImagen($codigo,$titulo,$autor,$categoria,$existencia,$numPaginas,$editorial,$descripcion,$fechaPublicacion){
			$statement = $this->connection->prepare("UPDATE libros set 
			titulo=?,autor=?,categoria=?,existencia=?,numPaginas=?,editorial=?,descripcion=?,fechaPublicacion=? where codigo=?");
		    $statement->bind_param("ssiiissii",$titulo,$autor,$categoria,$existencia,$numPaginas,$editorial,$descripcion,$fechaPublicacion,$codigo);  
		    $resultado = $statement->execute();
		    return $resultado;
	}

	function mostrarPorExistencia()
	{
		$libros=$this->connection->query("SELECT * FROM libros WHERE activo = 1 ORDER BY existencia LIMIT 10");

	return $libros;
	}
	
	function eliminarLibro($codigo){
		$activo=0;
		$statement = $this->connection->prepare("UPDATE libros set activo=? where codigo=?");
		$statement->bind_param("ii",$activo,$codigo);
		$respuesta=$statement->execute();
		return $respuesta;
	}

	 function filtrarLibros($texto) //muestra todos los libros que contienen el texto indicado ordenados por existencias
    {
        $statement = $this->connection->prepare("SELECT codigo,titulo,existencia FROM libros WHERE activo = 1 AND ((codigo LIKE ?) OR (titulo LIKE ?) OR (existencia LIKE ?)) ORDER BY existencia LIMIT 10");
        $texto = "%" . $texto . "%";
        $statement->bind_param("sss",$texto,$texto,$texto);
        $statement->execute();
        $statement->bind_result($codigo,$titulo,$existencia);

        while ($statement->fetch()) 
        {
            echo "<tr>";
            echo "<td>$codigo</td>";
            echo "<td>$titulo</td>";
             echo "<td>$existencia</td>";
           echo "<td>" . '<a href="pedidos.php?l=' . $codigo . '">Agregar a pedido</a>' . "</td>";
            echo "</tr>";
        }

    }
}

?>