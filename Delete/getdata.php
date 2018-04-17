<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
$sql = 'SELECT * FROM kinds';
         
$query = mysqli_query($conn, $sql);
 
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

//Nhan du lieu
$result  = array();        
while ($row = mysqli_fetch_array($query))
{
        array_push($result, array("ID_KIND"=>$row['ID_KIND'],"NAME_KIND" => $row['NAME_KIND']));
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>