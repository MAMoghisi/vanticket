<?php
session_start();
if (password_verify("driver",$_COOKIE["user"])){
    include 'Repository/UserRepository.php';
    include 'Repository/Database/Connection.php';
    include '../vendor/morilog/jalali/src/Jalalian.php';
    include '../vendor/autoload.php';
    $ticks = new \Repository\adminRepository();
    $yourticketlist = $ticks->DriverTicket();
}else{
    header("refresh:2 , login.php");
}

?>
<a href="logout.php">logout</a>
<table>
    <thead>
    <tr>
        <td>from</td>
        <td>to</td>
        <td>date</td>
        <td>time</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($yourticketlist as $ticks):;?>
        <tr>
            <td><?php echo  $ticks['home'] ?></td>
            <td><?php echo  $ticks['purpose'] ?></td>
            <td><?php echo  substr(jdate($ticks['date']),0,10) ?></td>
            <td><?php echo  $ticks['time'] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>