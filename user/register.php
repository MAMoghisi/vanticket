<?php

if (isset($_COOKIE["user"])){
        echo "شما قبلا وارد شدید";
        header("refresh:2 , ../user/tickets.php");

} elseif(isset($_COOKIE["user"])) {
    echo "شما قبلا وارد شدید";
    header("refresh:2 , ../user/driver.php");
}else{
    include 'Repository/UserRepository.php';
    include 'Repository/Database/Connection.php';
    if (isset($_POST['Submit'])) {




        $Fullname = $_POST['Fullname'];
        $Email = $_POST['Email'];
        $Password = strlen($_POST['Password']) >= 8 ? $_POST['Password'] : null;
        $Phone = $_POST['Phone'];

        $Connection = new \Repository\adminRepository();

        $Result = $Connection->Insert($Fullname, $Email, $Password, $Phone);

        if ($Result) {
            echo "Values Inserted";
        } else {
            echo 'Error occured during the insertion!';
        }

    }
    if (isset($_POST['SubmitDriver'])) {


        $Fullname = $_POST['Fullname'];
        $Email = $_POST['Email'];
        $Password = strlen($_POST['Password']) >= 8 ? $_POST['Password'] : null;
        $Phone = $_POST['Phone'];
        $vannum = $_POST['vannum'];

        $Connection = new \Repository\adminRepository();

        $Result = $Connection->InsertDriver($Fullname, $Email, $Password, $Phone , $vannum);

        if ($Result) {
            echo "Values Inserted";
        } else {
            echo 'Error occured during the insertion!';
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
    <p>user register:</p>
    <input type="text" required name="Fullname" placeholder="full name">
    <input type="email" required name="Email" placeholder="email">
    <input type="password" required  name="Password" placeholder="password">
    <input type="tel" name="Phone" placeholder="phone">
    <input type="submit" name="Submit" value="Submit">
    <br>
    <a href="../">back</a>
    <a href="login.php">login</a>
</form>
<br><br><br><br><br><br><br><br><br>
<form action="" method="post">
    <p>driver register:</p>
    <input type="text" required name="Fullname" placeholder="full name">
    <input type="email" required name="Email" placeholder="email">
    <input type="password" required  name="Password" placeholder="password">
    <input type="tel" name="Phone" placeholder="phone">
    <input type="text" required name="vannum" placeholder="van-number">
    <input type="submit" name="SubmitDriver" value="Submit">
    <br>
    <a href="../">back</a>
    <a href="login.php">login</a>
</form>
</body>
</html>
