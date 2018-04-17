<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
$sql = 'SELECT a.ID_AGRI, a.ID_KIND, a.NAME_AGRI, a.IMG_URL_AGRI , a.PRICE_AGRI , u.OLD_PRICE as OLD_PRICE
FROM AGRICULTURAL as a, UPDATE_AGRI as u 
WHERE a.ID_AGRI = u.ID_AGRI
and a.PRICE_AGRI < u.OLD_PRICE
GROUP BY a.NAME_AGRI LIMIT 10';
         
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
        	"PRICE_AGRI"=>$row['PRICE_AGRI'],
       		"OLD_PRICE"=>$row['OLD_PRICE']));
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>