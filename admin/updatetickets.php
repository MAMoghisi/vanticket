<?php
if (password_verify("Admins",$_COOKIE["admin"])){
    include 'Repository/UserRepository.php';
    include 'Repository/Database/Connection.php';

    $Values = null;
    $Ticket = new \Repository\adminRepository();


    if (isset($_POST['Submit']) && isset($_GET['id'])){
        $Result = $Ticket->UpdateTicket($_POST['home'],$_POST['purpose'],$_POST['date'],$_POST['time'],$_POST['capacity'],$_GET['id']);
        if ($Result)
        {
            echo "تغییرات ثبت شد!";
        }else{
            echo "error coured!";
        }
    }
    if (isset($_POST['delete']) && isset($_GET['id'])){
        $Result = $Ticket->deleteTickets($_GET['id']);
        if ($Result)
        {
           echo "بلیط حذف شد";
        }
        else
        {
            echo "امکان حذف وجود ندارد!";
        }
    }
    if (isset($_GET['id']))
    {
        $Values =  $Ticket->FindByIdTicket($_GET['id']);
    }
    else
    {
        header("location:tickets.php");
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
    From:<input type="text" required name="home" value="<?php echo $Values['home'] ?>"><br>
    To:<input type="text" required name="purpose" value="<?php echo $Values['purpose'] ?>" ><br>
    date:<input type="date" required  name="date" value="<?php echo $Values['date'] ?>" ><br>
    time:<input type="text" required name="time" value="<?php echo $Values['time'] ?>" ><br>
    capacity:<input type="text" required name="capacity" value="<?php echo $Values['capacity'] ?>" ><br>
    <input type="submit" name="Submit" value="Update">
    <input type="submit" name="delete" value="delete">
</form>
<a href="tickets.php"><button> back </button></a>
</body>
</html>
