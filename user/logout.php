<?php
echo "you loged out!";
$hash = password_hash("customer", 1);
setcookie("user", $hash, time() - 60 * 60 * 24 * 365, "/", "moghisi.co");
header('refresh:2; url=login.php');