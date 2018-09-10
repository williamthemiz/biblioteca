<?php
class Loan {
  public $id;
  public $user_id;
  public $date;
  public $quantity;
  public $return_date;
  private $connection;

  function __construct(){
		$this->connection = Connection::connect();
  }

	function getAll(){
    $query = "SELECT * FROM loans";
    $statement = $this->connection->prepare($query);
    $statement->execute();
    $loans = $statement->fetchAll(PDO::FETCH_ASSOC);
	  return $loans;
	}

	function get(){
    $query = "SELECT * FROM loans WHERE id = :id";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $statement->execute();
    $loan = $statement->fetch(PDO::FETCH_ASSOC);
		return $loan;
  }

	function save(){
    $query = "INSERT INTO loans (user_id,date,quantity,return_date) 
    VALUES (:user_id,:date,:quantity,:return_date)";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
    $statement->bindParam(':date', $this->date, PDO::PARAM_STR);
    $statement->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
    $statement->bindParam(':return_date', $this->return_date, PDO::PARAM_STR);
    $result = $statement->execute();
    return $result;
  }
  
	function update(){
    $query = "UPDATE loans SET user_id = :user_id, date = :date,
    quantity = :quantity, return_date = :return_date WHERE id = :id";
		$statement = $this->connection->prepare($query);
    $statement->bindParam(':id',$this->id,PDO::PARAM_INT);
    $statement->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
    $statement->bindParam(':date', $this->date, PDO::PARAM_STR);
    $statement->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
    $statement->bindParam(':return_date', $this->return_date, PDO::PARAM_STR);
    $result=$statement->execute();
    return $result;
	}
	function delete(){
    $query = "DELETE FROM loans WHERE id = :id";
    $statement=$this->connection->prepare($query);
    $statement->bindParam(':id',$this->id);
    $result = $statement->execute();
    return $result;
  }
}
?>