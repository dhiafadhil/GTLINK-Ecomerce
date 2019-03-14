<?php
session_start();
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="../../">
                                <img src="" alt="GT LINK">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="../../model/user/login_p.php" method="POST">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login">sign
                                    in</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have an account?
                                    <a href="../register/register.php">Register</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
include "../../js/page3.php";
?>
<script type="text/javascript">
$(document).ready(function(){
 <?php
 echo echo_validasi();
 ?> 
});
</script>
</html>
<!-- end document-->