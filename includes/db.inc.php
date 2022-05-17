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
//   class DBconnection{
//     private $host = "localhost";
//     private $nome_db = "friends";
//     private $username = "root";
//     private $password = "";
//     public $conn;

//     protected function dbConnect()
//     {

//         $this->conn = null;
//         try
//         {
//             $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->nome_db, $this->username,$this->password);
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $this->conn->exec("SET NAMES utf8");

//             return $this->conn;
//         }
//         catch(PDOException $e)
//         {
//           echo $e->getMessage();
//         }
//     }
// }
?>