<?php

session_start();
setcookie("ID_USER", "", time() + 3600, "/","", false, true);
// setcookie("USERNAME_CUS", "", time() + 3600, "/","", false, true);
unset($_SESSION['ID_USER']);
header('Location: admin_login.php');

?>
