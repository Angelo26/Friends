<?php
    require 'header.php';
?>
    <div class="main">
        
        <div class="logoAcro">
            <h1>FRIENDS</h1>
            <p>Let's connect together.</p>
        </div>

        <div class="logReg">
            <div class="logRegCont">
                <div class="log">
                    <h2>Join with your friends now!</h2>
                    
                    <form name="logForm" class="logForm" method="POST">
                        <div class="form-group">
                            <div class="username">
                                <label for="uname">Email or Username</label>
                                <input type="text" name="uname" id="uname" required>
                                <span class="unameValMsg errMsg"></span>
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
                            <p>New to <span id="regLogo">FRIENDS</span>?<span id="signup"> Create an account.</span></p>
                        </div>
                    </form>
                </div>

                <div class="reg">
                    <h2>Lets get started!</h2>
                    
                    <form action="includes/signup.inc.php" class="regForm" method="POST">
                        <div class="form-group">
                  
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