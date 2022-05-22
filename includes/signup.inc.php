<?php
if(isset($_POST['register'])) {
	include 'db.inc.php';	

    class Register extends DBconnection {
      Protected $email;
      Protected $password;
      Protected $confirm_password;
    
      function __construct() {
        $this->email = $_POST['email'];
        $this->password = $_POST['rpwd'];
        $this->confirm_password = $_POST['crpwd'];    
      }

      function addInfo() { 
        $email = $this->email;
        $pwd = $this->password;
        $cpwd = $this->confirm_password;

        if($pwd!==$cpwd){
            header("Location: ../index.php?register=passwords donot match.");
            exit();   
        }
        else{
            try{
                $sql = "SELECT * FROM users WHERE email=:email";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['email'=>$email]);
                $result = $stmt->rowCount();
                if($result>0){
                    header("Location: ../index.php");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "Insert into users(email, password) values(:email, :hashedPwd)";
                    $stmt = $this->dbConnect()->prepare($sql);
                    if($stmt->execute(['email'=>$email, 'hashedPwd'=>$hashedPwd])){
                        header("Location: ../index.php");
                        exit();   
                    }
                }

            }catch(PDOException $e){
                echo "Insertion failed: " . $e->getMessage();
            }
        }
      }
    }
    $userObj = new Register();
    $userObj->addInfo();
}

?>