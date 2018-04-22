<?php

session_start();
setcookie("ID_USER", "", time() + 3600, "/","", false, true);
setcookie("USERNAME_CUS", "", time() + 3600, "/","", false, true);
session_destroy();
header('Location: admin_login.php');

?>
