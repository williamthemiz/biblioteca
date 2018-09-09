<?php 
class Employee {
	public $id;
	public $name;
	public $position;
	public $person_id;
	public $address;
	public $phone;
	public $email;

  function __construct(){
		$this->connection = Connection::connect();
  }

  function getAll(){
    $query = "SELECT * from employees";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $employees = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $employees;
  }

  function get(){
    $query = "SELECT * FROM employees WHERE id = :id";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $employee = $statement->fetch(PDO::FETCH_ASSOC);
		return $employee;
  }

	function save(){
    $query = "INSERT INTO employees (name, position, person_id, address, phone, email) 
    VALUES (:name, :position, :person_id, :address, :phone, :email)";
    $statement = $this->conexion->prepare($query);
    $statement->bindParam(':name',$this->name,PDO::PARAM_STR);
    $statement->bindParam(':position',$this->position,PDO::PARAM_INT);
    $statement->bindParam(':person_id',$this->person_id,PDO::PARAM_INT);
		$statement->bindParam(':address',$this->address,PDO::PARAM_STR);
		$statement->bindParam(':phone',$this->phone,PDO::PARAM_INT);
    $statement->bindParam(':email',$this->email,PDO::PARAM_INT);
    $result = $statement->execute();
    return $result;
	}
	
  function update(){
    $query = "UPDATE employees SET name = :name, position = :position, person_id = :person_id,
    address = :address, phone = :phone, email = :email WHERE id = :id";
    $statement=$this->conexion->prepare($query);
    $statement->bindParam(':id',$this->id,PDO::PARAM_STR);
    $statement->bindParam(':name',$this->name,PDO::PARAM_STR);
    $statement->bindParam(':position',$this->position,PDO::PARAM_INT);
    $statement->bindParam(':person_id',$this->person_id,PDO::PARAM_INT);
		$statement->bindParam(':address',$this->address,PDO::PARAM_STR);
		$statement->bindParam(':phone',$this->phone,PDO::PARAM_INT);
    $statement->bindParam(':email',$this->email,PDO::PARAM_INT);
    $result=$statement->execute();
    return $result;
  }
  
	function delete(){
    $query = "DELETE FROM employees WHERE id = :id";
		$statement = $this->conexion->prepare($query);
    $statement->bindParam(':id',$this->id,PDO::PARAM_INT); 
    $result = $statement->execute();
    return $result;
	}
}
 ?>