<?php
    require "header.php";
?>
    <link rel="stylesheet" href="css/friends.css">

    <div class="main">
    <div class="header">
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

<?php
    require "footer.php";
?>