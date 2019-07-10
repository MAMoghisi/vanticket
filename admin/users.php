<?php
if (password_verify("Admins",$_COOKIE["admin"])){
include 'Repository/UserRepository.php';
include 'Repository/Database/Connection.php';
echo '[<a href="logout.php">logout</a>]' ;
echo '[<a href="tickets.php">tickets</a>]' ;
$Users = new \Repository\adminRepository();
$UserList = $Users->All();
//if (isset($_POST['delete'])){
//    $username = $_POST['username'];
//    if ($User->delete($username)==1){
//        echo "deleted!";
//    }
//}
}else{
    header("location:login.php");
}
?>

<html>
<head>
    <title>List of users</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>Fullname</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Status</td>
                <td>driver</td>
                <td>van-number</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($UserList as $User): ?>
            <tr>
                <td><?php echo  $User['Fullname'] ?></td>
                <td><?php echo  $User['Email'] ?></td>
                <td><?php echo  $User['Phone'] ?></td>
                <td><?php echo  $User['Status'] ?></td>
                <td><?php echo  $User['driver'] ?></td>
                <td><?php echo  $User['vannum'] ?></td>
                <td><a href="http://moghisi.co/ticket/admin/update.php?id=<?php echo  $User['Id'] ?>"><button>Update</button></a></td>
                </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="logout.php">logout</a>
</body>
</html>