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
            catch(PDOException $e){
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
                    <div class="friends">
                        <p><?php echo $row['email'];?></p>
                    <?php
                        $getUsers = $this->showFollowActivity($row['id']);
                    ?>
                        <div class="followActs">
                            <div class="followers">
                                <p>Followers</p>
                                <p><?php echo $getUsers->followers?></p>
                            </div>
                            <div class="following">
                                <p>Following</p>
                                <p><?php echo $getUsers->following?></p>
                            </div>
                        </div>
                        <div class="followActions">
                            <button>Follow</button>
                        </div>
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