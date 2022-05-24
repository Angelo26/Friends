<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}
else{
    require("db.inc.php");
    class Friends extends DBconnection{

        function __construct(){
            $this->userid = $_SESSION['userid'];
        }

        function showFollowActivity($fid){
            try{
                $friendsUser = new stdClass();

                $sql = "SELECT * FROM followmap WHERE followers=:fid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['fid'=>$fid]);
                $friendsUser->followers = $stmt->rowcount();

                $sql = "SELECT * FROM followmap WHERE followed=:fid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['fid'=>$fid]); 
                $friendsUser->following = $stmt->rowcount();
            
                return $friendsUser;
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        function followStatus($fwrid){
            try{
                $fwdid = $this->userid;

                $sql = "SELECT * FROM followmap WHERE followers=:fwdid AND followed=:fwrid";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(["fwrid"=>$fwrid, "fwdid"=>$fwdid]);
                $result = $stmt->rowCount();
                return $result;
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

        }

        function showUsers(){
            try{
                $uid = $this->userid;
                $sql = "SELECT * FROM users WHERE NOT id = :id";
                $stmt = $this->dbConnect()->prepare($sql);
                $stmt->execute(['id'=>$uid]);
                $result = $stmt->fetchAll();
                foreach($result as $row){
                ?>
                    <div class="friends">
                        <h3><?php echo $row['username'];?></h3>
                    <?php
                        $this->getUsers = $this->showFollowActivity($row['id']);
                    ?>
                        <div class="followAssoc">
                            <div class="followers">
                                <p>Followers</p>
                                <p><?php echo $this->getUsers->followers?></p>
                            </div>
                            <div class="following">
                                <p>Following</p>
                                <p><?php echo $this->getUsers->following?></p>
                            </div>
                        </div>
                        <div class="followStatus">
                            <?php $this->followStatus = $this->followStatus($row['id']);
                                if($this->followStatus>0){
                                    $this->fstatus="UnFollow";
                                }
                                else{
                                    $this->fstatus="Follow";
                                }
                            ?>
                            <button class="followActions" onclick="followActions(<?php echo $row['id'];?>, <?php echo $this->followStatus;?>)"><?php echo $this->fstatus;?></button>
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