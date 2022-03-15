<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 8/17/2019
 * Time: 1:29 PM
 */

include_once "../core/db.php";
if(admin()){
    header("location:index.php");
    exit();
}


if(isset($_POST['ok-login'])){
    include_once "login_inc.php";
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title><?php echo $config['site_name'];?> - Login</title>
    <?php
    include_once "meta.php";
    ?>

    <link href="assets/css/login.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="assets/js/login.js"></script>
    <script>$(document).ready(function () {
            Login.init()
        });</script>
</head>
<body class="login">
<div class="logo"><img src="assets/img/logo.png" alt="logo"/> <strong>Student</strong> Blood Bank</div>
<div class="box">
    <div class="content">
        <?php flash();?>
        <form class="form-vertical login-form" action="" method="post">
            <h3 class="form-title">Admin Login</h3>
            <div class="alert fade in alert-danger" style="display: none;">
                <i class="icon-remove close" data-dismiss="alert"></i> Enter any
                username and password.
            </div>
            <div class="form-group">
                <div class="input-icon"><i class="icon-user"></i>
                    <input required type="text" name="user_id" class="form-control" placeholder="Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username."/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon"><i class="icon-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." required/>
                </div>
            </div>
            <div class="form-actions"><label class="checkbox pull-left">
                    <input type="checkbox" class="uniform" name="remember"> Remember me</label>
                <button type="submit" name="ok-login" class="submit btn btn-primary pull-right"> Sign In <i class="icon-angle-right"></i></button>
            </div>
        </form>

    </div>

</div>

</body>
</html>