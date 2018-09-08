<?php  
class User{
	public $id;
	public $student_id;
	public $name;
	public $email;
	public $address;
	public $phone;

  function getAll(){
    $query = "SELECT * FROM users";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  function get(){
    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
		return $user;
  }

  function save(){
    $query = "INSERT INTO users (student_id, name, address, phone, email) 
    VALUES (:student_id, :name, :address, :phone, :email)";
    $statement = $this->conexion->prepare($query);
    $statement->bindParam(':student_id',$this->student_id,PDO::PARAM_INT);
		$statement->bindParam(':name',$this->name,PDO::PARAM_STR);
		$statement->bindParam(':address',$this->address,PDO::PARAM_STR);
		$statement->bindParam(':phone',$this->phone,PDO::PARAM_INT);
    $statement->bindParam(':email',$this->email,PDO::PARAM_INT);
    $result = $statement->execute();
    return $result;
  }

  function update(){
    $query = "UPDATE users set student_id=:student:id, name = :name, address=:address
    , phone=:phone, email=:email where id=:id";
    $statement = $this->conexion->prepare($query);
    $statement->bindParam(':id',$this->id,PDO::PARAM_INT);
    $statement->bindParam(':student_id',$this->student_id,PDO::PARAM_INT);
		$statement->bindParam(':name',$this->name,PDO::PARAM_STR);
		$statement->bindParam(':address',$this->address,PDO::PARAM_STR);
		$statement->bindParam(':phone',$this->phone,PDO::PARAM_INT);
    $statement->bindParam(':email',$this->email,PDO::PARAM_INT);
    $result = $statement->execute();  
    return $result;
}

  /* THIS should go on save login method
  $statement = $this->conexion->prepare("INSERT INTO login (user,pass,rol,activo) VALUES (?,?,?,?)"); //preparando sentencia para insertar los datos de acceso del usuario
    $statement->bind_param("isii",$carnet,$clave,$rol,$activo);  //asignando valores a los parametros
    $resultado = $statement->execute(); //ejecutando la sentencia
    echo mysqli_error();
    */

    function eliminarUsuario($carnet){
        $activo=0;


        $statement = $this->conexion->prepare("UPDATE usuarios set activo=? where carnet=?");
        $statement->bind_param("is",$activo,$carnet);  
        $statement->execute();

        $statement = $this->conexion->prepare("UPDATE login set activo=? where user=?");
        $statement->bind_param("is",$activo,$carnet);  
        $resultado=$statement->execute();
        return $resultado;
    }

    
	
    function buscarUsuarios($carnet){
        $activo=1;
        $statement=$this->conexion->prepare("SELECT * from usuarios where carnet like CONCAT('%',?,'%') and activo=?");
        $statement->bind_param("si",$carnet,$activo);
        $statement->execute();
        $usuarios=$statement->get_result();
        return $usuarios;
    }

	
    function modificarClave($clave,$user){
        $clave=sha1($clave);
        $statement=$this->conexion->prepare("UPDATE login set pass=? where user=?");
        $statement->bind_param("ss",$clave,$user);
        $respuesta=$statement->execute();
        return $respuesta;
    }
    

    
}
?>