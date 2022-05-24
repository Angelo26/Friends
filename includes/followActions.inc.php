<?php

session_start();

if(isset($_POST['fid']) && isset($_POST['fsts']) && isset($_SESSION['userid'])){
    require 'db.inc.php';
    class FollowActions extends DBconnection{

        protected $fid;
        protected $fsts;

        function __construct(){
            $this->fid = $_POST['fid'];
            $this->fsts = $_POST['fsts'];
            $this->userid = $_SESSION['userid'];
        }

        function follow(){
            try{
                $fid = $this->fid;
                $id = $this->userid;

                $sql = "INSERT INTO followmap(followers, followed) VALUES(:id, :fid)";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(["id"=>$id,"fid"=>$fid]);
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        function unfollow(){
            try{
                $fid = $this->fid;
                $id = $this->userid;
                $sql = "DELETE FROM followmap WHERE followers=:id AND followed=:fid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(["id"=>$id, "fid"=>$fid]);
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        function fActions(){
            try{
                $fsts = $this->fsts;
                if($fsts>0){
                    $this->unfollow();
                }
                else{
                    $this->follow();
                }
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }
    $fActs = new FollowActions();
    echo $fActs->fActions();
}

else{
    echo "couldn't";
}

?>