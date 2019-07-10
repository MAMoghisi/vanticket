<?php
if (isset($_COOKIE["admin"])){
    echo "شما قبلا وارد شدید!";
    header("refresh:2 , index.php");
}else{

    if (isset($_POST['Submit'])) {

        include 'Repository/UserRepository.php';
        include 'Repository/Database/Connection.php';

        $Fullname = $_POST['Fullname'];
        $Email = $_POST['Email'];
        $Password = strlen($_POST['Password']) >= 8 ? $_POST['Password'] : null;
        $Phone = $_POST['Phone'];

        $Connection = new \Repository\adminRepository();

        $Result = $Connection->Insert($Fullname, $Email, $Password, $Phone);

        if ($Result) {
            echo "ثبت نام انجام شد!";
        } else {
            echo 'error!!!';
        }

    }
}

?>
<html>
<head>
    <title>Register Form</title>
</head>
<body>
<form action="" method="post">
    <input type="text" required name="Fullname" placeholder="full name">
    <input type="email" required name="Email" placeholder="email">
    <input type="password" required  name="Password" placeholder="password">
    <input type="tel" name="Phone" placeholder="phone">
    <input type="submit" name="Submit" value="Submit">
    <br>
    <a href="../">back</a>
    <a href="login.php">login</a>
</form>
</body>
</html>
