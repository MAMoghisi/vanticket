<?php
include 'Repository/UserRepository.php';
include 'Repository/Database/Connection.php';

if (isset($_COOKIE["user"])){
    if (password_verify("customer",$_COOKIE["user"])) {
    echo "شما قبلا وارد شدید";
    header("refresh:2 , ../user/tickets.php");
}else{
        echo "شما قبلا وارد شدید";
        header("refresh:2 , ../user/driver.php");
    }
}else{
if (isset($_POST['Submit']))
{



    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Connection = new \Repository\adminRepository();
    $Result = $Connection->Login($Email,$Password);
    echo $Result;

}
}


?>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
<form action="" method="post">
    <input type="email" required name="Email" placeholder="email">
    <input type="password" required  name="Password" placeholder="password">
    <input type="submit" name="Submit" value="Submit">
    <br>
    <a href="../">back</a>
    <a href="register.php">register</a>
</form>
</body>
</html>