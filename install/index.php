<?php

error_reporting();
$db_host = "localhost";
$db_user = "root";
$db_name = "blood";
$db_pass = "";


$conn = mysqli_connect("$db_host", "$db_user","$db_pass");

$df = mysqli_query($conn,"CREATE DATABASE  $db_name") or die(mysqli_error($conn));

$connection = mysqli_connect("$db_host", "$db_user","$db_pass","$db_name");

$sqls = file_get_contents("db.sql");

$sqls_array = explode(";", $sqls);

foreach ($sqls_array as $sql) {
	if(strlen($sql) == 0)
		continue;
    $query = mysqli_query($connection, "$sql");// or die(mysqli_error($connection));
}

echo "Installation successful <a href='../index.php'>Click here to go home</a>";
?>