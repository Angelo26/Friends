<?php

class DBconnection {

  Protected function dbConnect(){
    $this->servername = "localhost";
    $this->dbname = "friends";
    $this->username = "root";
    $this->password = "";
    try {
      $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->conn;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }  
}

?>