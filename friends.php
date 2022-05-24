<?php
    require "header.php";
    if(!isset($_SESSION['userid'])){
        header("Location: index.php");
        exit();
    }
?>
    <link rel="stylesheet" href="css/friends.css">

    <div class="main">
        <div class="content">
            <div class="header">
                <div class="logo">
                    <a href="friends.php"><h1>FRIENDS</h1></a>
                    <!-- <p>Let's connect together.</p> -->
                </div>
                <?phpif(isset($_SESSION['useremail'])) {?>
                    <form action="includes/logout.inc.php" method="POST">
                        <button class="logout" type="submit" name="logout">Log out</button>
                    </form>
                <?php}?>
            </div>
            <div class="section">
                <div class="showUsers">
                    
                </div>
            </div>
        </div>
    </div>

<?php
    require "footer.php";
?>