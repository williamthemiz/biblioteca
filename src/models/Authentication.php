<?php
class Authentication {
	private $user;
	private $password;
	private $credentials;

	function __construct($user, $password){
		$this->user = $user;
		$this->password = $password;
    $this->connection = Connection::conect();
	}

	function getCredentials(){
		$query = "SELECT role,pass FROM login WHERE user = :user AND active = 1";
		$statement = $this->conexion->prepare($query);
		$statement->bindParam(":user",$this->user);
		$statement->execute();
		$statement->bind_result($clave);
		$credentials = $statement->fetch(PDO::FETCH_ASSOC);
	  $this->credentials = $credentials;
	}

	function getRole(){
		return $this->credentials["role"];
	}

	function verify(){
		$this->getCredentials();
		if (sha1($this->password) === $this->credentials["pass"]) {
			return true;
		}
		return false;
	}
}
?>