<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["USERNAME_CUS"])){
	$USERNAME_CUS = $_POST["USERNAME_CUS"];
}
$truyvan = "SELECT USERNAME_CUS FROM CUSTOMER WHERE USERNAME_CUS = '".$USERNAME_CUS."' LIMIT 1";

$ketqua = mysqli_query($conn,$truyvan);
$demdong = mysqli_num_rows($ketqua);
if($demdong >=1){
	echo "true";
}else {
	echo "false";
}

?>