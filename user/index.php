<?php
if (password_verify("customer",$_COOKIE["user"])){
    header("location:tickets.php");
}else{
    header("location:login.php");
}