<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 8/17/2019
 * Time: 1:27 PM
 */

session_start();

unset($_SESSION['blood-admin']);
header("location:login.php");
exit();