<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

 
if(isset($_POST["USERNAME_CUS"]) || isset($_POST["TYPE"]) || isset($_POST["DATA"])){
	$USERNAME_CUS = $_POST["USERNAME_CUS"];
	$TYPE = $_POST["TYPE"];
	$DATA = $_POST["DATA"];
}

switch ($TYPE) {
	//Thay đổi tên
	case 1:

		$sql = "UPDATE `CUSTOMER` SET `FULLNAME_CUS`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";
		
		break;

	//Thay đổi năm sinh
	case 2:

	$sql = "UPDATE `CUSTOMER` SET `BIRTHDAY`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";
		
		break;
	//Thay dổi giới tính
	case 3:

	$sql = "UPDATE `CUSTOMER` SET `SEX`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";
		
		break;
	//Thay đổi số điện thoại
	case 4:

	$sql = "UPDATE `CUSTOMER` SET `TEL_CUS`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";

		break;
	//Thay đổi địa chỉ nhà
	case 5:

	$sql = "UPDATE `CUSTOMER` SET `ADDRESS_CUS`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";

		break;

		//Thay đổi ảnh đại diện
	case 6:

	$sql = "UPDATE `CUSTOMER` SET `IMG_URL_CUS`= '".$DATA."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";

		break;
	
	default:
		echo "false";
		break;
}

if(mysqli_query($conn,$sql)){
	echo "true";
}else{
	echo "false";
}


?>