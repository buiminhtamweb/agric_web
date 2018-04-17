<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["USERNAME_CUS"])) {

	$USERNAME_CUS = $_POST["USERNAME_CUS"];
}

$truyvan = "SELECT o.ID_ORDER, o.DATE_ORDER , o.TOTAL_ORDER 
FROM ORDERS as o
LEFT JOIN BILL as b ON o.ID_ORDER = b.ID_ORDER
WHERE b.ID_ORDER IS NULL 
AND o.USERNAME_CUS = '" .$USERNAME_CUS . "' ORDER BY o.DATE_ORDER DESC ";



$query = mysqli_query($conn,$truyvan);

$result  = array();        
while ($row = mysqli_fetch_array($query))
{
	//Truy vấn lấy danh sách các NS trong hóa đơn
	$sqlNS_HD = "SELECT ao.ID_AGRI, ao.NUM_OF_AGRI, ao.CURRENT_PRICE
	FROM AGRI_ORDER as ao 
	WHERE ao.ID_ORDER = '" . $row['ID_ORDER'] . "'";
	$agriOrderArr  = array();

	$query2 = mysqli_query($conn,$sqlNS_HD);

	while ($row2 = mysqli_fetch_array($query2)) {
	array_push($agriOrderArr, array(
	    	"ID_AGRI"=>$row2['ID_AGRI'],
	    	"NUM_OF_AGRI"=>$row2['NUM_OF_AGRI'],
	    	"CURRENT_PRICE"=>$row2['CURRENT_PRICE']));

	}

	//Đưa vào mảng ORDER
    array_push($result, array(
    	"ID_ORDER"=>$row['ID_ORDER'],
    	"DATE_ORDER"=>$row['DATE_ORDER'],
    	"TOTAL_ORDER"=>$row['TOTAL_ORDER'],
    	"AGRI_ORDER"=> $agriOrderArr));
}

echo json_encode($result);
	
	

mysqli_close($conn);

?>