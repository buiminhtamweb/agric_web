<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if(isset($_POST["ID_AGRI"])){
	$ID_AGRI = $_POST["ID_AGRI"];
}

//Truy van
$sql = 'SELECT agri.ID_AGRI, 
agri.NAME_AGRI, 
k.NAME_KIND,
agri.DETAIL_AGRI, 
agri.IMG_URL_AGRI, 
agri.PRICE_AGRI, 
agri.AMOUNT_AGRI 
FROM KINDS as k , AGRICULTURAL as agri 
WHERE agri.ID_KIND = k.ID_KIND  
	and agri.ID_AGRI = "'. $ID_AGRI . '" LIMIT 1';
         
$query = mysqli_query($conn, $sql);
 
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

//Nhan du lieu       
while ($row = mysqli_fetch_array($query))
{
        $result =  array("ID_AGRI"=>$row['ID_AGRI'],
        					"NAME_AGRI" => $row['NAME_AGRI'],
      						"NAME_KIND"=>$row['NAME_KIND'],
   							"DETAIL_AGRI"=>$row['DETAIL_AGRI'],
							"IMG_URL_AGRI"=>$row['IMG_URL_AGRI'],
							"PRICE_AGRI"=>$row['PRICE_AGRI'],
							"AMOUNT_AGRI"=>$row['AMOUNT_AGRI']
						);
}
//Chuyen va in ra JSON
echo json_encode($result, 0, 1024);
?>