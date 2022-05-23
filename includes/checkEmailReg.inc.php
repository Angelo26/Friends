<?php
    if(isset($_POST['email'])){
        require("db.inc.php");
        class Checkemail extends DBconnection{
            protected $emailId;

            function __construct(){
                $this->emailId = $_POST['email'];
            }

            function checkEml(){
                $uemail = $this->emailId;
                try{
                    $sql = "SELECT * FROM users where email=:email";
                    $stmt = $this->dbConnect()->prepare($sql);
                    $stmt->execute(['email'=>$uemail]);
                    $result = $stmt->rowCount();
                    return $result;
                }
                catch(PDOException $e){
                    echo "Sql error: " . $e->getMessage();
                }
            }
        }
        $chkEml = new Checkemail();
        $resultnum = $chkEml->checkEml();
        echo $resultnum;
    }