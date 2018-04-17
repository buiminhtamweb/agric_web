<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");


if(isset($_POST["KEYWORD"])){
	$keyword = $_POST["KEYWORD"];
}
//Truy van
$sql = "SELECT a.NAME_AGRI
FROM AGRICULTURAL as a
WHERE a.NAME_AGRI LIKE '".$keyword."%'
LIMIT 5";
         
$query = mysqli_query($conn, $sql);
 
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

//Nhan du lieu
$result  = array();        
while ($row = mysqli_fetch_array($query))
{
        array_push($result,$row['NAME_AGRI']);
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>