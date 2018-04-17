<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Truy van
if(isset($_POST["DON_HANG"])) {

	$DON_HANG = $_POST["DON_HANG"];

}

$arrHoaDon = json_decode($DON_HANG, true);
$idOrder = $arrHoaDon["ID_ORDER"];

try {
	$truyvan = "INSERT INTO `ORDERS`(`ID_ORDER`, `USERNAME_CUS`, `TOTAL_ORDER`) VALUES ( '".$idOrder. "','".
																								$arrHoaDon["USERNAME_CUS"]. "',".
																								$arrHoaDon["TOTAL_ORDER"].")";

	//Thêm hóa đơn đặt hàng mới
	mysqli_query($conn,$truyvan);

	//Duyệt qua từng nông sản để thêm vào CSQL
	$arrAgriOrder = $arrHoaDon["AGRI_ORDER"];
	for ($i=0; $i < count($arrAgriOrder); $i++) { 
		$agriOrder = $arrAgriOrder[$i];
		$truyvan2 = "INSERT INTO `AGRI_ORDER`(`ID_ORDER`, `ID_AGRI`, `NUM_OF_AGRI`, `CURRENT_PRICE`) VALUES ( '".$idOrder. "',".
																												$agriOrder["ID_AGRI"]. ",".
																												$agriOrder["NUM_OF_AGRI"]. ",".
																												$agriOrder["CURRENT_PRICE"].")";

		//Thêm nông sản vào đơn đặt hàng
		mysqli_query($conn,$truyvan2);

		//Tìm Giá cũ trong CSQL để cập nhật lại số lượng trên hệ thống
		$truyvan3 = "SELECT AMOUNT_AGRI FROM AGRICULTURAL WHERE ID_AGRI = " . $agriOrder["ID_AGRI"];
		$query = mysqli_query($conn,$truyvan3);
		$old_AMOUNT_AGRI = mysqli_fetch_array($query);
		
		//Cập nhật lại số lượng trên hệ thống
		$truyvan4 = "UPDATE AGRICULTURAL SET AMOUNT_AGRI = ".($old_AMOUNT_AGRI["AMOUNT_AGRI"] - $agriOrder["NUM_OF_AGRI"]) ." WHERE ID_AGRI = " . $agriOrder["ID_AGRI"];

		mysqli_query($conn,$truyvan4);
		echo "true";
	}
}catch (Exception $e) {
	echo "false";
}																							

mysqli_close($conn);

?>