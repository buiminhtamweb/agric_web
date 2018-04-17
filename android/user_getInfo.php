<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if(isset($_POST["USERNAME_CUS"])){
	$USERNAME_CUS = $_POST["USERNAME_CUS"];
}
$truyvan = "SELECT FULLNAME_CUS,SEX,BIRTHDAY ,IMG_URL_CUS,TEL_CUS,ADDRESS_CUS FROM CUSTOMER WHERE USERNAME_CUS = '".$USERNAME_CUS."' LIMIT 1";

$ketqua = mysqli_query($conn,$truyvan);
while ($row = mysqli_fetch_array($ketqua))
{
       $result = array(
        	"FULLNAME_CUS"=>$row['FULLNAME_CUS'],
        	"SEX"=>$row['SEX'],
        	"BIRTHDAY"=>$row['BIRTHDAY'],
        	"IMG_URL_CUS"=>$row['IMG_URL_CUS'],
        	"TEL_CUS"=>$row['TEL_CUS'],
        	"ADDRESS_CUS"=>$row['ADDRESS_CUS']);
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>