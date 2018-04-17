<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if(isset($_POST["USERNAME_CUS"]) || isset($_POST["OLD_PASSWORD"]) || isset($_POST["NEW_PASSWORD"])){
	$USERNAME_CUS = $_POST["USERNAME_CUS"];
	$OLD_PASSWORD = $_POST["OLD_PASSWORD"];
	$NEW_PASSWORD = $_POST["NEW_PASSWORD"];

}

$sqlCheckOldPass = "SELECT PASSWORD_CUS FROM CUSTOMER WHERE USERNAME_CUS = '".$USERNAME_CUS."' LIMIT 1";
$ketqua = mysqli_query($conn,$sqlCheckOldPass);
$row = mysqli_fetch_array($ketqua);
$oldPass = $row["PASSWORD_CUS"];

if ($oldPass == $OLD_PASSWORD ) {
	$sql = "UPDATE `customer` SET `PASSWORD_CUS`= '".$NEW_PASSWORD."' WHERE USERNAME_CUS = '" . $USERNAME_CUS ."'";
	if(mysqli_query($conn,$sql)){
	echo "true";
	}else echo "false";
}else echo "false";

?>