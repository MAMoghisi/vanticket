<?php
echo "welcome <br/>";
    if (isset($_COOKIE['admin'])){
        header("location:admin");
}elseif (isset($_COOKIE['user'])){
        header("location:user");
}elseif (isset($_COOKIE['user'])){
        header("location:user");
    }else {
        echo '[<a href="admin">Admins</a>]';
        echo '[<a href="user">User & Drivers</a>]';
    }