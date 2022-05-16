<?php
  if (isset($_POST['login'])) {
    include 'db.inc.php';
    class Login extends DBconnection {
      Protected $username;
      Protected $password;
    
      function __construct() {
        $this->username = $_POST['uname'];
        $this->password = $_POST['lpwd'];
      }

      function checkInfo() { 
        $user = $this->username;
        $pwd = $this->password;

        try{
          $sql = "SELECT * FROM users WHERE email=:user OR username=:user";
          $stmt = $this->dbConnect()->prepare($sql);
          $stmt->execute(['user'=>$user]);
          $result = $stmt->rowCount();
          if($result<1){
            header("Location: ../index.php?login=User not found");
            exit();
          }
          else{
            if($row = $stmt->fetch(PDO::FETCH_OBJ)){
              $hashedPwdCheck = password_verify($pwd, $row->password);
              if ($hashedPwdCheck == false){
                header("Location: ../index.php?$pwd,$row->password");
                exit();
              }
                          
              elseif($hashedPwdCheck == $row->password){
                $_SESSION['userid'] = $row->id;
                $_SESSION['useremail'] = $row->email;
                header("Location: ../friends.php?login=Success");
                exit();
              }
            }
          }
        }catch(PDOException $e){
          echo $e->getMessage();
        } 
      }
    }
    $userObj = new Login();
    $userObj->checkInfo();
  }
?>