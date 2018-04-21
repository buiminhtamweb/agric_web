<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

if (!isset($_SESSION["OFFSET_SEARCH"])) {
	$_SESSION["OFFSET_SEARCH"] = 0;
}

if (isset($_POST['MAIN'])) {
$_SESSION["OFFSET_SEARCH"] = $_POST['MAIN'];
}
$keyword = "";
if (isset($_POST['KEYWORD'])) {
$keyword = $_POST['KEYWORD'];
}

$countRow = 0;
//Lấy só lượng dòng dữ liệu
$sql_count = 'SELECT COUNT(ID_AGRI) as COUNT_ROW
FROM (SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
WHERE a.ID_KIND = k.ID_KIND
AND a.NAME_AGRI LIKE "%'.$keyword.'%"
Order by ID_AGRI) AS TABLE_TEMP';
	$query = mysqli_query($conn, $sql_count);
	while ($row = mysqli_fetch_array($query)) {
		$countRow = $row['COUNT_ROW'];
	}

	$limit = 3;

//Truy van
if($_SESSION["OFFSET_SEARCH"] < $countRow){
	$offset = $_SESSION["OFFSET_SEARCH"];
	//Truy van
	$sql = 'SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
	WHERE a.ID_KIND = k.ID_KIND
	AND a.NAME_AGRI LIKE "%'.$keyword.'%"
	Order by ID_AGRI LIMIT '.$limit.' OFFSET '.$offset;

	$query = mysqli_query($conn, $sql);
	$countResult = 0;
	while ($row = mysqli_fetch_array($query)) {
		if ($row['AMOUNT_AGRI']>=1000){
			$conLai = ($row['AMOUNT_AGRI']/1000)." Kg";
		}else {
			$conLai = $row['AMOUNT_AGRI']." Gam";
		}
	$countResult += 1;
	echo "<div class='col-md-4'>"
	."    <form id='itemform' method='POST' action='product-detail.php' >"
			// Create a transparent button that will make a whole item card clickable
	."    <button type='submit' name='getidagri'value='".$row["ID_AGRI"]."' style='height:410px; background-color:transparent; border-color:transparent; cursor: pointer;'>"
	."    <div class='card card-product'>"
	."        <div class='card-header card-header-image'>"
	."                <img alt='' src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
	."            <div class='colored-shadow' style='background-image: url('assets/img_agric/".$row['IMG_URL_AGRI']."'); opacity: 1;'></div>"
	."        </div>"
	."        <div class='card-body text-center'>"
	."            <h4 class='card-title'>"
	."                <a href='product-detail.php'>".$row['NAME_AGRI']."</a>"
	."            </h4>"
	."            <span class='price price-old'>Còn lại:  $conLai </span><br>"
	."            <span class='price price-new'>&nbsp;".$row['PRICE_AGRI']." VNĐ/KG</span>"
	."        </div>"
	."    </div>"
	."    </button>"
	."    </form>"
	."</div>";
	}
	if ($countResult==3) {
		echo '<div class="ml-auto mr-auto" id="div_btnmore">
				<a class="btn btn-success btn-round text-center" role="button" onclick="showSearchResultContinue()">Xem thêm...</a>
		</div>';
	}else {
	$_SESSION["OFFSET_SEARCH"] = 0;
	}


	$_SESSION["OFFSET_SEARCH"] += 3;
}

?>
