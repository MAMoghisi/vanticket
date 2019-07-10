<?php
if (password_verify("Admins",$_COOKIE["admin"])){
include 'Repository/UserRepository.php';
include 'Repository/Database/Connection.php';

$Values = null;
$User = new \Repository\adminRepository();


if (isset($_POST['Submit']) && isset($_GET['id'])){
    $Result = $User->Update($_POST['Fullname'],$_POST['Phone'],$_POST['Status'],$_GET['id'],$_POST['vannum']);
    if ($Result)
    {
        echo "تغییرات ثبت شد!";
    }else{
        echo "error coured!";
    }
    }
if (isset($_POST['delete']) && isset($_GET['id'])){
    $Result = $User->delete($_GET['id']);
    if ($Result)
    {
        echo "کاربر حذف شد!";
    }
    else
    {
        echo "امکان حذف وجود ندارد!";
    }
}



if (isset($_GET['id']))
{
   $Values =  $User->FindById($_GET['id']);
}
else
{
    header("location:users.php");
}
}else{
    header("location:login.php");
}

?>



<html>
<head>
    <title>Update</title>
</head>
<body>
<form action="" method="post">
    fullname:<input type="text" required name="Fullname" value="<?php echo $Values['Fullname'] ?>"><br>
    email:<input type="email" readonly name="Email" value="<?php echo $Values['Email'] ?>" ><br>
    status:<input type="number" required  name="Status" value="<?php echo $Values['Status'] ?>" ><br>
    phone:<input type="tel" name="Phone" value="<?php echo $Values['Phone'] ?>" ><br>
    van-number:<input type="text" name="vannum" value="<?php echo $Values['vannum'] ?>" ><br>
    <input type="submit" name="Submit" value="Update">
    <input type="submit" name="delete" value="delete">
</form>
<a href="users.php"><button> back </button></a>
</body>
</html>
