<?php
class Login {
	public $id;
	public $user_id;
	public $username;
	private $pass;
	public $role;
	private $connection;

	function __construct(){
    $this->connection = Connection::conect();
	}

	function save(){
		$statement = $this->conexion->prepare("INSERT INTO login (user,pass,rol,activo) VALUES (?,?,?,?)"); //preparando sentencia para insertar los datos de acceso del usuario
    $statement->bind_param("isii",$carnet,$clave,$rol,$activo);  //asignando valores a los parametros
    $resultado = $statement->execute(); //ejecutando la sentencia
    echo mysqli_error();
		$query = "SELECT role,pass FROM login WHERE user = :user";
		$statement = $this->conexion->prepare($query);
		$statement->bindParam(":user",$this->user_id);
		$statement->execute();
		$statement->bind_result($clave);
		$credentials = $statement->fetch(PDO::FETCH_ASSOC);
		$this->credentials = $credentials;
		
		$statement=$this->conexion->prepare("INSERT into login (user,pass,rol,activo) values(?,?,?,?)");
		$statement->bind_param("ssii",$username,$clave,$rol,$activo);
		$resultado=$statement->execute();
		return $resultado;
	}

	function update(){
		$clave=sha1($clave);
		$statement=$this->conexion->prepare("UPDATE login set pass=? where user=?");
		$statement->bind_param("ss",$clave,$user);
		$respuesta=$statement->execute();
		return $respuesta;
		$query = "SELECT role,pass FROM login WHERE user = :user";
		$statement = $this->conexion->prepare($query);
		$statement->bindParam(":user",$this->user_id);
		$statement->execute();
		$statement->bind_result($clave);
		$credentials = $statement->fetch(PDO::FETCH_ASSOC);
	  $this->credentials = $credentials;
	}

	function delete(){
		$query = "SELECT role,pass FROM login WHERE user = :user";
		$statement = $this->conexion->prepare($query);
		$statement->bindParam(":user",$this->user_id);
		$statement->execute();
		$statement->bind_result($clave);
		$credentials = $statement->fetch(PDO::FETCH_ASSOC);
	  $this->credentials = $credentials;
	}

	function getCredentials(){
		$query = "SELECT role,pass FROM login WHERE user = :user";
		$statement = $this->conexion->prepare($query);
		$statement->bindParam(":user",$this->user_id);
		$statement->execute();
		$statement->bind_result($clave);
		$credentials = $statement->fetch(PDO::FETCH_ASSOC);
	  $this->credentials = $credentials;
	}

	function getRole(){
		return $this->credentials["role"];
	}

	function verify($password){
		$this->getCredentials();
		if (sha1($this->password) === $password) {
			return true;
		}
		return false;
	}

	function changePass($clave,$user){
    $clave=sha1($clave);
    $statement=$this->conexion->prepare("UPDATE login set pass=? where user=?");
    $statement->bind_param("ss",$clave,$user);
    $respuesta=$statement->execute();
    return $respuesta;
  }
}
?>