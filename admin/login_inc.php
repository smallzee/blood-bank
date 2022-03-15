<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/1/2019
 * Time: 3:52 PM
 */


    $sql = $db->prepare("SELECT id FROM admin WHERE username = :user_id and password= :password");
    $sql->execute(
        array(
            'user_id' => $_POST['user_id'],
            'password' => $_POST['password']
        )
    );
    $n = $sql->rowCount();

    if($n == 0){
        set_flash("Invalid login details","danger");
        $sql->closeCursor();
    }else{
        $rs = $sql->fetch(PDO::FETCH_ASSOC);
        $id = $rs['id'];
        $_SESSION['blood-admin'] = $id;
        $sql->closeCursor();
        header("location:index.php");
        exit();
    }

