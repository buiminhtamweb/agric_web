<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["USERNAME_CUS"]) || 
	isset($_POST["PASSWORD_CUS"]) || 
	isset($_POST["FULLNAME_CUS"]) || 
	isset($_POST["SEX"]) || 
	isset($_POST["BIRTHDAY"])|| 
	isset($_POST["IMG_URL_CUS"])|| 
	isset($_POST["TEL_CUS"])||
	isset($_POST["ADDRESS_CUS"])) {

	$USERNAME_CUS = $_POST["USERNAME_CUS"];
	$PASSWORD_CUS = $_POST["PASSWORD_CUS"];
	$FULLNAME_CUS = $_POST["FULLNAME_CUS"];
	$SEX = $_POST["SEX"];
	$BIRTHDAY = $_POST["BIRTHDAY"];
	$IMG_URL_CUS = $_POST["IMG_URL_CUS"];
	$TEL_CUS = $_POST["TEL_CUS"];
	$ADDRESS_CUS = $_POST["ADDRESS_CUS"];
}


$truyvan = "INSERT INTO CUSTOMER VALUES ('".$USERNAME_CUS."','".$PASSWORD_CUS."','".$FULLNAME_CUS."','".$SEX."','".$BIRTHDAY."','".$IMG_URL_CUS."','".$TEL_CUS."','".$ADDRESS_CUS."') ";

if(mysqli_query($conn,$truyvan)){
	echo "true";
}else{
	echo "false";
}

mysqli_close($conn);

?>