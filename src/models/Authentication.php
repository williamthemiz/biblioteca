<?php  
require_once "conexion.php";

class Autenticacion {
	
	function __construct(){
    $this->conexion = Conexion::conectar();
	}

	function obtenerClave($usuario)
	{
		$statement = $this->conexion->prepare("SELECT pass FROM login WHERE user=? AND activo=1");
		$statement->bind_param("s",$usuario);
		$statement->execute();
		$statement->bind_result($clave);
		$statement->fetch();
	 return $clave;
	}

	function obtenerRol($usuario)
	{
		$statement = $this->conexion->prepare("SELECT rol FROM login WHERE user=? AND activo=1");
		$statement->bind_param("s",$usuario);
		$statement->execute();
		$statement->bind_result($rol);
		$statement->fetch();
	 return $rol;
	}
}




?>