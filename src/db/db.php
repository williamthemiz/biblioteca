<?php  
class Connection {
  public static function conect(){
    $connection=new mysqli(SERVER,USER,PASS,BASE);
    $connection->set_charset(CHAR);
    if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
		}
    return $connection;
  }
}

?>