<?php

include 'Repository/UserRepository.php';
include 'Repository/Database/Connection.php';
include '../vendor/morilog/jalali/src/Jalalian.php';
include '../vendor/autoload.php';
if (password_verify("customer",$_COOKIE["user"])){



    $Values = null;
    $tickets = new \Repository\adminRepository();

    if (isset($_POST['buy']) && isset($_GET['id'])) {
        $Result = $tickets->BUY($_GET['id']);
    }

    if (isset($_GET['id'])){
        $Values = $tickets->FindTicket($_GET['id']);
        $time = jdate($Values['date']);
    } else {
        header("Location: http://moghisi.co/user/tickets.php");
    }
}
else{
    header("location:login.php");
}

?>

<html>
<head>
    <title>buy</title>
</head>
<body>
<form action="" method="post">
    from:<input type="text" readonly name="home" value="<?php echo $Values['home'] ?>"><br>
    to:<input type="text" readonly name="purpose" value="<?php echo $Values['purpose'] ?>" ><br>
    date:<input type="text" readonly name="date" value="<?php echo $time ?>" ><br>
    time:<input type="text" readonly name="time" value="<?php echo $Values['time'] ?>" ><br>
    capacity:<input type="text" readonly name="capacity" value="<?php echo $Values['capacity'] ?>" ><br>
    <input type="submit" name="buy" value="BUY">
</form>
<a href="tickets.php"><button> Back > </button></a>
</body>
</html>
