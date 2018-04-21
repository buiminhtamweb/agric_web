<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include_once("config.php");
mysqli_set_charset($conn, "utf8");

//Khởi tạo giá trị OFFSET
if (!isset($_SESSION["OFFSET_SEARCH"])) {
	$_SESSION["OFFSET_SEARCH"] = 0;
}

//Trang chính hoặc xem thêm
if (isset($_POST['MAIN'])) {
$_SESSION["OFFSET_SEARCH"] = $_POST['MAIN'];
}

//Từ khóa tìm kiếm
$keyword = "";
if (isset($_POST['KEYWORD'])) {
$keyword = $_POST['KEYWORD'];
}

//Nhận dữ liệu Lọc Giá
if (isset($_POST["minPrice"]) && isset($_POST["maxPrice"])) {
	$_SESSION["minPrice"] = $_POST["minPrice"];
	$_SESSION["maxPrice"] = $_POST["maxPrice"];
}
$minPrice = $_SESSION["minPrice"];
$maxPrice = $_SESSION["maxPrice"];
$countRow = 0;

$limit = 6;
//Nhận dữ liệu Lọc Loại nông sản
if (isset($_POST["kindAgri"]) && $_POST["kindAgri"] != "0") {
 $kindAgri = $_POST["kindAgri"];

 //Lấy só lượng dòng dữ liệu
 $sql_count = 'SELECT COUNT(ID_AGRI) as COUNT_ROW
 FROM (SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
 WHERE a.ID_KIND = k.ID_KIND
 And a.PRICE_AGRI > '.$minPrice.'
 And a.PRICE_AGRI < '.$maxPrice.'
 And a.ID_KIND = '.$kindAgri.'
 AND a.NAME_AGRI LIKE "%'.$keyword.'%"
 Order by ID_AGRI) AS TABLE_TEMP';

 $offset = $_SESSION["OFFSET_SEARCH"];
 //SQL lấy kết quả
 $sql = 'SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
 WHERE a.ID_KIND = k.ID_KIND
 And a.PRICE_AGRI > '.$minPrice.'
 And a.PRICE_AGRI < '.$maxPrice.'
 And a.ID_KIND = '.$kindAgri.'
 AND a.NAME_AGRI LIKE "%'.$keyword.'%"
 Order by ID_AGRI LIMIT '.$limit.' OFFSET '.$offset;

}else {
	//Lấy só lượng dòng dữ liệu
	$sql_count = 'SELECT COUNT(ID_AGRI) as COUNT_ROW
	FROM (SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
	WHERE a.ID_KIND = k.ID_KIND
	And a.PRICE_AGRI > '.$minPrice.'
	And a.PRICE_AGRI < '.$maxPrice.'
	AND a.NAME_AGRI LIKE "%'.$keyword.'%"
	Order by ID_AGRI) AS TABLE_TEMP';

	$offset = $_SESSION["OFFSET_SEARCH"];
	//SQL lấy kết quả
	$sql = 'SELECT a.*,k.NAME_KIND FROM agricultural as a,kinds as k
	WHERE a.ID_KIND = k.ID_KIND
	And a.PRICE_AGRI > '.$minPrice.'
	And a.PRICE_AGRI < '.$maxPrice.'
	AND a.NAME_AGRI LIKE "%'.$keyword.'%"
	Order by ID_AGRI LIMIT '.$limit.' OFFSET '.$offset;


}



// echo $sql_count;
//Truy vấn số KQ
	$query = mysqli_query($conn, $sql_count);
	while ($row = mysqli_fetch_array($query)) {
		$countRow = $row['COUNT_ROW'];
	}


//Truy van kết quả

if($_SESSION["OFFSET_SEARCH"] < $countRow){


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
	."            <span class='price'>Còn lại:  $conLai </span><br>"
	."            <span class='price price-new'>&nbsp;".$row['PRICE_AGRI']." VNĐ/KG</span>"
	."        </div>"
	."    </div>"
	."    </button>"
	."    </form>"
	."</div>";
	}
	if ($countResult==$limit) {
		echo '<div class="ml-auto mr-auto" id="div_btnmore">
				<button class="btn btn-success btn-round text-center" role="button" onclick="showSearchResultContinue()">Xem thêm...</button>
		</div>';
	}else {
	$_SESSION["OFFSET_SEARCH"] = 0;
	}


	$_SESSION["OFFSET_SEARCH"] += $limit;
}

?>
