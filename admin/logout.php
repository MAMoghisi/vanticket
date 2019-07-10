<?php
echo "you loged out!";
$hash = password_hash("Admins", 1);
setcookie("admin", $hash, time() - 60 * 60 * 24 * 365, "/", "moghisi.co");
header('refresh:2; url=login.php');