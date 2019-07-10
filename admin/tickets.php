<?php
if (password_verify("Admins",$_COOKIE["admin"])){


    include 'Repository/UserRepository.php';
    include 'Repository/Database/Connection.php';
    echo '[<a href="logout.php">logout</a>]';
    echo '[<a href="users.php">users</a>]';
    $ticketss = new \Repository\adminRepository();
    $ticketsList = $ticketss->AllTICKETS();
}else{
    header("location:login.php");
}
?>

<html>
<head>
    <title>List of ticketss</title>
</head>
<body>
<table style="text-align: center">
    <thead>
    <tr>
        <td>from</td>
        <td>to</td>
        <td>date</td>
        <td>time</td>
        <td>van</td>
        <td>capacity</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($ticketsList as $tickets): ?>
        <tr>
            <td><?php echo  $tickets['home'] ?></td>
            <td><?php echo  $tickets['purpose'] ?></td>
            <td><?php echo  $tickets['date'] ?></td>
            <td><?php echo  $tickets['time'] ?></td>
            <td><?php echo  $tickets['van'] ?></td>
            <td><?php echo  $tickets['capacity'] ?></td>
            <td><a href="http://moghisi.co/ticket/admin/updatetickets.php?id=<?php echo  $tickets['Id'] ?>"><button>Update</button></a></td>

        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
<a href="http://moghisi.co/ticket/admin/create-ticket.php">ساخت بلیط جدید</a>
</body>
</html>
