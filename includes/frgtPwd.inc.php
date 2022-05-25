<?php
if (isset($_POST['ufemail']) && isset($_SESSION['userid'])) {

    require 'db.inc.php';

    class ForgotPassword extends DBconnection{

        protected $ufemail;

        function __construct(){
            $this->ufemail = $_POST['ufemail'];
        }

        function deleteVkey(){
            $ufemail = $this->ufemail;
            $sql = "DELETE from vkey WHERE email = :email";
            $stmt = $this->dbConnect()->prepare($sql);
            $stmt->execute(['email'=>$ufemail]);            
        }

        function sendLink(){

            try{
                $ufemail = $this->ufemail;
                $this->deleteVkey();
                $vcode= md5(time());
                $sql="INSERT INTO vkey(vkey, email) VALUES (':vcode', :email)";

                $stmt = $this->dbConnect()->prepare($sql); 
                if($stmt->execute(['vcode'=>$vcode, 'email'=>$ufemail])){

                    $sql = "SELECT vid FROM vkey WHERE email = :email"; 
                    $stmt = $this->dbConnect()->prepare($sql);
                    if($stmt->execute(['email'=>$ufemail])){

                        $result = $stmt->fetch();
                        
                        $id= $result->id;

                        $receiver = $ufemail;
                        $subject = "Reset your password";
                        $body = "<a href='http://localhost/friends/resetPwd.php?id=$id&vkey=$vcode'>Click on this link to reset your password.</a>";
                        $headers = "From:Friends Team\r\n";
                        $headers .= "Content-type:text/html\r\n";
                        if(mail($receiver, $subject, $body, $headers)){
                            return "sent";
                        }
                        else{
                            return "abort";
                        }
                    }
                    else{
                        return "abort";
                    }
                }
                else{
                    return "abort";
                }
            }
            catch(PDOException $e){
                echo "Error: ". $e->getMessage();
            }
        }
    }
}
?>