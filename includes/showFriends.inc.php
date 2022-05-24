<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}
else{
    require("db.inc.php");
    class Friends extends DBconnection{

        function showFollowActivity($fid){
            try{
                $friendsUser = new stdClass();

                $sql = "SELECT * FROM followmap WHERE followers=:fid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['fid'=>$fid]);
                $friendsUser->followers = $stmt->rowcount();

                $sql = "SELECT * FROM followmap WHERE following=:fid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['fid'=>$fid]); 
                $friendsUser->following = $stmt->rowcount();
            
                return $friendsUser;
            }
            catch(PDOExtension $e){
                echo "Error: " . $e->getMessage();
            }
        }

        function showUsers(){
            try{
                $sql = "SELECT * FROM users";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $row){
                ?>
                    <div class="friendsUser">
                        <p><?php echo $row['email'];?></p>
                    <?php
                        $getUsers = $this->showFollowActivity($row['id']);
                    ?>
                        <div class="followActs">
                            <div class="followers"><?php echo $getUsers->followers?></div>
                            <div class="following"><?php echo $getUsers->following?></div>
                        </div>
                        <!--<div class="followActions">
                            <div class="follow"></div>
                            <div class="unfollow"></div>
                        </div> -->
                    </div>
                <?php
                }    
            }
            catch(PDOException $e){
                echo "Error " . $e->getMessage();
            }                         
        }  
    }
    $showAllUsers = new Friends();
    $showAllUsers->showUsers();
}
?>