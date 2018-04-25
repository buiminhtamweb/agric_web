<?php

session_start();
// setcookie("ID_USER", "", time() + 3600, "/","", false, true);
setcookie("USERNAME_CUS", "", time() + 3600, "/","", false, true);
unset($_SESSION['USERNAME_CUS']);
header('Location: ../agric/index.php');

?>
