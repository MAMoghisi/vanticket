<?php
session_start();

if (password_verify("customer",$_COOKIE["user"])){
    include 'Repository/UserRepository.php';
    include 'Repository/Database/Connection.php';
    include '../vendor/morilog/jalali/src/Jalalian.php';
    include '../vendor/autoload.php';
    $ticketss = new \Repository\adminRepository();
    $ticketsList = $ticketss->AllTICKETS();
    $ticks = new \Repository\adminRepository();
    $yourticketlist = $ticks->UserTickets();
}else{
    header("refresh:2 , login.php");
}
?>

<html>
<head>
    <title>List of ticketss</title>
</head>
<body>
    <p>wellcome</p>
    <a href="logout.php">logout</a>
<table>
    <thead>
    <tr>
        <td>from</td>
        <td>to</td>
        <td>date</td>
        <td>time</td>
        <td>capacity</td>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($ticketsList as $tickets):;?>
        <tr>
            <td><?php echo  $tickets['home'] ?></td>
            <td><?php echo  $tickets['purpose'] ?></td>
            <td><?php echo  substr(jdate($tickets['date']),0,10) ?></td>
            <td><?php echo  $tickets['time'] ?></td>
            <td><?php echo  $tickets['capacity'] ?></td>
            <td><a href="http://moghisi.co/ticket/user/buy.php?id=<?php echo  $tickets['Id'] ?>"><button>خرید</button></a></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
    <br><br><br>
<p>بلیط های شما</p>
    <table>
        <thead>
        <tr>
            <td>from</td>
            <td>to</td>
            <td>date</td>
            <td>time</td>
            <td>your-ticket</td>
            <td>van-num</td>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($yourticketlist as $ticks):;?>
            <tr>
                <td><?php echo  $ticks['home'] ?></td>
                <td><?php echo  $ticks['purpose'] ?></td>
                <td><?php echo  substr(jdate($ticks['date']),0,10) ?></td>
                <td><?php echo  $ticks['time'] ?></td>
                <td><?php echo  $ticks['Tooken'] ?></td>
                <td><?php echo  $ticks['van'] ?></td>
                </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>