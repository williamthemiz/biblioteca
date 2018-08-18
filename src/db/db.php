<?php  
class Connection {
  public static function connect(){
    try {
      $connection= new PDO(DATABASE, USER, PASS);
      $connection->exec("SET CHARACTER SET utf8");
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      return $connection;
    } catch (PDOException $e) {
      print "Error connecting!: " . $e->getMessage();
      die();
    }
  }
}
?>