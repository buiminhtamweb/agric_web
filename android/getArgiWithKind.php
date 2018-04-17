<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if(isset($_POST["ID_KIND"])){
	$idKind = $_POST["ID_KIND"];
}

//Truy van
$sql = "SELECT * FROM AGRICULTURAL WHERE ID_KIND = '".$idKind."'";
         
$query = mysqli_query($conn, $sql);
 
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

//Nhan du lieu
$result  = array();        
while ($row = mysqli_fetch_array($query))
{
       array_push($result, array(
        	"ID_AGRI"=>$row['ID_AGRI'],
        	"ID_KIND"=>$row['ID_KIND'],
        	"NAME_AGRI"=>$row['NAME_AGRI'],
        	"IMG_URL_AGRI"=>$row['IMG_URL_AGRI'],
        	"PRICE_AGRI"=>$row['PRICE_AGRI']));
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>