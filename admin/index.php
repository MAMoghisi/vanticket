<?php

if (isset($_COOKIE['user'])){
    echo "شما ادمین نیستید";
    header("refresh:2 , ../");
}else {
    echo "admin";
    if (password_verify("Admins",$_COOKIE["admin"])){
        echo '[<a href="users.php">users</a>]';
        echo '[<a href="tickets.php">tickets</a>]';
    }else{
        header("location:login.php");
    }
}