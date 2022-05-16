
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/friends.css">
    <title>Friends</title>
    <link rel="shortcut icon" type="image/png" href="pictures/couch.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Lobster Two|Permanent Marker|Architects Daughter|Oleo Script Swash Caps|Kaushan Script|Kalam|Abril Fatface|Alfa Slab One|Source Serif Pro|Shadows Into Light|Macondo|Pacifico|Dancing Script|Roboto|Lato|Josefin Sans|Send Flowers|Inconsolata">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="main">
        <div class="logoAcro">
            <h1>FRIENDS</h1>
            <p>Let's connect together.</p>
        </div>

        <div class="logReg">
            <div class="logRegCont">
                <div class="log">
                    <h2>Join with your friends now!</h2>
                    
                    <form action="includes/signin.inc.php" method = "POST">
                        <div class="form-group">
                            <div class="username">
                                <label for="uname">Email or Username</label>
                                <input type="text" name="uname" id="uname" required>
                            </div>
                            <div class="password">
                                <label for="lpwd">Password</label>
                                <input type="password" name="lpwd" id="lpwd">
                            </div>
                            <button name="login" type="submit">Sign In</button>
                            <p>New to <span id="regLogo">FRIENDS</span>?<span id="signup"> Create an account.</span></p>
                        </div>
                    </form>
                </div>

                <div class="reg">
                    <h2>Lets get started</h2>
                    
                    <form action="includes/signup.inc.php" method="POST">
                        <div class="form-group">
                  
                            <div class="email">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="password">
                                <label for="rpwd">Password</label>
                                <input type="password" name="rpwd" id="rpwd">
                            </div>
                            <div class="conform-password">
                                <label for="crpwd">Confirm Password</label>
                                <input type="password" name="crpwd" id="crpwd">
                            </div>
                            <button name="register" type="submit">Sign Up</button>
                            <p>Already have an account? <span id="signin">Sign in.</span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/friends.js"></script>
</html>