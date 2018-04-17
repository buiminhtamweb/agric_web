<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");


//Truy van
$sql = "SELECT BANNER FROM BANNER";
         
$query = mysqli_query($conn, $sql);
 
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

//Nhan du lieu
$result  = array();        
while ($row = mysqli_fetch_array($query))
{
        array_push($result,$row['BANNER']);
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>