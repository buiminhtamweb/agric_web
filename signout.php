<?php

session_start();
setcookie("USERNAME_CUS", "", time() + 3600, "/","", false, true);
session_destroy();
header('Location: ../agric/index.php');

?>