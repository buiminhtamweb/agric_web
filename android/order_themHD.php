<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["HOA_DON"])) {

	$HOA_DON = $_POST["HOA_DON"];

}


$arrHoaDon = json_decode($HOA_DON);



$truyvan = "INSERT INTO CUSTOMER VALUES ('".$USERNAME_CUS."','".$PASSWORD_CUS."','".$FULLNAME_CUS."','".$SEX."','".$BIRTHDAY."','".$IMG_URL_CUS."','".$TEL_CUS."','".$ADDRESS_CUS."') ";

if(mysqli_query($conn,$truyvan)){
	echo "true";
}else{
	echo "false";
}

mysqli_close($conn);

?>