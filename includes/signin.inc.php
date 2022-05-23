<?php
  if (isset($_POST['uname']) && isset($_POST['upwd'])) {
    include 'db.inc.php';
    class Login extends DBconnection {
      Protected $username;
      Protected $password;
    
      function __construct() {
        $this->username = $_POST['uname'];
        $this->password = $_POST['upwd'];
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
            return $result;
          }
          else{
            if($row = $stmt->fetch(PDO::FETCH_OBJ)){
              $hashedPwdCheck = password_verify($pwd, $row->password);
              if ($hashedPwdCheck == false){
                return "wp";
              }
                          
              elseif($hashedPwdCheck == $row->password){
                $_SESSION['userid'] = $row->id;
                $_SESSION['useremail'] = $row->email;
                return "sl";
              }
            }
          }
        }catch(PDOException $e){
          echo $e->getMessage();
        } 
      }
    }
    $userObj = new Login();
    echo $userObj->checkInfo();
  }
?>