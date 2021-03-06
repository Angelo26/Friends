<?php
    require 'header.php';
    if(isset($_SESSION['userid'])){
        header("Location: friends.php");
        exit();
    }
?>
    <link rel="stylesheet" href="css/main.css">
    <div class="main">
        <div class="logoAcro">
            <h1><span>P</span><span>A</span><span>P</span><span>O</span><span>L</span><span>A</span><span>R</span></h1>
            <p>Let's connect together.</p>
        </div>

        <div class="logReg">
            <div class="logRegCont">
                <div class="log">
                    <h2>Join with your friends now!</h2>
                    
                    <form name="logForm" class="logForm" method="POST">
                        <div class="form-group">
                            <div class="username">
                                <label for="username">Email or Username</label>
                                <input type="text" name="ulname" id="ulname" required>
                                <span class="ulnameValMsg errMsg"></span>
                            </div>
                            <div class="password">
                                <label for="lpwd">Password</label>
                                <input type="password" name="lpwd" class="checkPwd cpd" id="lpwd" required><span class="togglePwdView cpd"></span>
                                <span class="lpwdValMsg errMsg"></span>
                            </div>
                            <div class="fp">
                                <h6>Forgot password?</h6>
                            </div>
                            <button name="login" type="submit">Sign In</button>
                            <p>New to <span id="regLogo">FRIENDS</span>?<span class="lsp" id="signup"> Create an account.</span></p>
                        </div>
                    </form>
                </div>

                <div class="reg">
                    <h2>Lets get started!</h2>
                    
                    <form action="includes/signup.inc.php" class="regForm" method="POST">
                        <div class="form-group">
                            <div class="username">
                                <label for="username">Username</label>
                                <input type="text" name="uname" id="uname" required>
                                <span class="unameValMsg errMsg"></span>
                            </div>
                            <div class="email">
                                <label for="email">Email address</label>
                                <input type="email" name="email" id="email" required>
                                <span class="emailValMsg errMsg"></span>
                            </div>
                            <div class="password">
                                <label for="rpwd">Password</label>
                                <input type="password" name="rpwd" class="checkPwd" id="rpwd" required><span class="togglePwdView"></span>
                                <span class="rpwdValMsg errMsg"></span>
                            </div>
                            <div class="conform-password">
                                <label for="crpwd">Confirm Password</label>
                                <input type="password" name="crpwd" class="checkCPwd" id="crpwd" required><span class="toggleCPwdView"></span>
                                <span class="crpwdValMsg  errMsg"></span>
                            </div>
                            <button name="register" type="submit">Sign Up</button>
                            <p>Already have an account? <span class="rsn" id="signin">Sign in.</span></p>
                        </div>
                    </form>
                </div>

                <div class="frgtPwd">
                <h2>Request an email reset link</h2>
                    
                    <form action="includes/frgtPwd.inc.php" class="frgtPwdForm" method="POST">
                        <div class="form-group">
                            <div class="email">
                                <label for="email">Email address</label>
                                <input type="email" name="email" id="frgtPwd" required>
                                <span class="frgtPwdValMsg errMsg"></span>
                            </div>
                            <button name="frgtPwdBtn" type="submit">Send link</button>
                            <p>Remembered password? <span class="rsn" id="fsignin">Sign in.</span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require "footer.php";
?>