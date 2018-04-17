<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if(isset($_POST["USERNAME_CUS"]) || isset($_POST["PASSWORD_CUS"])){
	$tendangnhap = $_POST["USERNAME_CUS"];
	$matkhau = $_POST["PASSWORD_CUS"];
}

$truyvan = "SELECT * FROM CUSTOMER WHERE USERNAME_CUS='".$tendangnhap."' AND PASSWORD_CUS='".$matkhau."' LIMIT 1";
$ketqua = mysqli_query($conn,$truyvan);
$demdong = mysqli_num_rows($ketqua);

if($demdong >=1){
	echo "true";
}else {
	echo "false";
}

mysqli_close($conn);

?>