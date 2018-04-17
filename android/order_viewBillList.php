<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["USERNAME_CUS"])) {

	$USERNAME_CUS = $_POST["USERNAME_CUS"];
}

$truyvan = "SELECT b.ID_ORDER, us.NAME_USER, b.DATE_BILL, o.TOTAL_ORDER 
FROM BILL as b
JOIN ORDERS as o ON o.ID_ORDER = b.ID_ORDER
JOIN USERS as us ON us.ID_USER = b.ID_USER
WHERE o.USERNAME_CUS = '". $USERNAME_CUS 
. "' ORDER BY b.DATE_BILL DESC";

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

	//Đưa vào mảng Bill
    array_push($result, array(
    	"ID_ORDER"=>$row['ID_ORDER'],
    	"NAME_USER"=>$row['NAME_USER'],
    	"DATE_BILL"=>$row['DATE_BILL'],
    	"TOTAL_ORDER"=>$row['TOTAL_ORDER'],
    	"AGRI_ORDER"=> $agriOrderArr));
}

echo json_encode($result);
	
	

mysqli_close($conn);

?>