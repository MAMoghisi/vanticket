<?php
if (password_verify("Admins",$_COOKIE["admin"])){
include 'Repository/UserRepository.php';
include 'Repository/Database/Connection.php';
$ticketss = new \Repository\adminRepository();
$ticketsList = $ticketss->AllAdminTICKETS();
include '../vendor/morilog/jalali/src/Jalalian.php';
if (isset($_POST['Submit']))
{
    $home = $_POST['home'];
    $purpose = $_POST['purpose'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $van = $_POST['van'];
    $capacity = $_POST['capacity'];

    $Connection = new \Repository\adminRepository();

    $Result = $Connection->InsertTICKETS($home,$purpose,$date,$time,$van,$capacity);

    if ($Result)
    {
        echo "ثبت بلیط انجام شد!";
    }
    else
    {
        echo '<br>error!!!';
    }

}
}else{
    header("location:login.php");
}
?>
            <html>
            <head>
                <title>Register Form</title>
            </head>
<body>
<form action="" method="post">
    <input type="text" required name="home" placeholder="مبداء">
    <input type="text" required name="purpose" placeholder="مقصد">
    <input type="date" required  name="date" placeholder="تاریح">
    <input type="time" required  name="time" placeholder="ساعت">
    <input type="number"  name="capacity" placeholder="ظرفیت"><br>
    <br><br>
    <p>انتخاب ون</p>
    <?php foreach ($ticketsList as $tickets):
        if ($tickets['driver'] == 1){
            $vans = $tickets['vannum'];
        echo "<input type=\"radio\" required value=\"$vans\" name='van'>" .  $tickets['vannum'] . "-----" . $tickets['Fullname'] . "<br>";
        }
    endforeach; ?>

    <br>   <input type="submit" name="Submit" value="Submit">
    <br>
    <a href="tickets.php">back</a>
</form>
</body>
</html>
