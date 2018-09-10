<?php  
class Student {
	public $id;
	public $student_id;
	public $name;
	public $email;
	public $address;
  public $phone;
  private $connection;
  
  function __construct(){
		$this->connection = Connection::connect();
  }

  function getAll(){
    $query = "SELECT * FROM students";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $students;
  }

  function get(){
    $query = "SELECT * FROM students WHERE id = :id";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
		return $user;
  }

  function save(){
    $query = "INSERT INTO students (student_id, name, address, phone, email) 
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
    $query = "UPDATE students set student_id=:student:id, name = :name, address=:address
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
  
  function delete(){
    $query = "DELETE FROM students WHERE id = :id";
    $statement = $this->conexion->prepare($query);
    $statement->bindParam(':id',$this->id,PDO::PARAM_INT);
    $statement->execute(); 
    $result = $statement->execute();
    return $result;
    } 
}
?>