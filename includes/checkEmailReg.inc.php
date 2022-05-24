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

    if(isset($_POST['uname'])){
        require("db.inc.php");
        class Checkuname extends DBconnection{
            protected $username;

            function __construct(){
                $this->username = $_POST['uname'];
            }

            function checkUsername(){
                $uname = $this->username;
                try{
                    $sql = "SELECT * FROM users where username=:uname";
                    $stmt = $this->dbConnect()->prepare($sql);
                    $stmt->execute(['uname'=>$uname]);
                    $result = $stmt->rowCount();
                    return $result;
                }
                catch(PDOException $e){
                    echo "Sql error: " . $e->getMessage();
                }
            }
        }
        $checkUser = new Checkuname();
        $resultnum = $checkUser->checkUsername();
        echo $resultnum;
    }
?>