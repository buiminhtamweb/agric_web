<?php
session_start();

include_once("config.php");

//Kiem tra va tao ID_ORDER moi
$timestamp = time();
$_SESSION['ID_ORDER'] = $timestamp.(rand(10,99));

//Xóa nông sản trong SESSION
if (isset($_POST['Posi_Delete'])) {
  unset($_SESSION['AGRI_ORDER'][$_POST['Posi_Delete']]);
}

//Đặt hàng
if (isset($_POST['DAT_HANG'])){ //Kiểm tra tao tác đặt hàng
  if (!isset($_SESSION['USERNAME_CUS'])){ //Kiểm tra dăng nhâp

    header('Location: login.php');
  }else{
    $tongDH = $_POST['DAT_HANG'];
    try {
    	$truyvan = "INSERT INTO `ORDERS`(`ID_ORDER`, `USERNAME_CUS`, `TOTAL_ORDER`) VALUES ( '".$_SESSION['ID_ORDER']. "','".
    																								$_SESSION['USERNAME_CUS']. "',".
    																								$tongDH.")";

    	//Thêm hóa đơn đặt hàng mới
    	mysqli_query($conn,$truyvan);

    	//Duyệt qua từng nông sản để thêm vào CSQL
    	foreach ($_SESSION['AGRI_ORDER'] as $agriOrder ) {
      		$truyvan2 = "INSERT INTO `AGRI_ORDER`(`ID_ORDER`,
            `ID_AGRI`, `NUM_OF_AGRI`, `CURRENT_PRICE`) VALUES ( '".$_SESSION['ID_ORDER']. "',".
      																												$agriOrder["ID_AGRI"]. ",".
      																												$agriOrder["NUM_OF_AGRI"]. ",".
      																												$agriOrder["CURRENT_PRICE"].")";

      		//Thêm nông sản vào đơn đặt hàng
      		mysqli_query($conn,$truyvan2);

      		//Tìm Giá cũ trong CSQL để cập nhật lại số lượng trên hệ thống
          echo '$agriOrder["ID_AGRI"]='.$agriOrder["ID_AGRI"];
      		$truyvan3 = "SELECT AMOUNT_AGRI FROM AGRICULTURAL WHERE ID_AGRI = " . $agriOrder["ID_AGRI"];
          echo $truyvan3;
      		$query = mysqli_query($conn,$truyvan3);
      		$old_AMOUNT_AGRI = mysqli_fetch_array($query);

      		//Cập nhật lại số lượng trên hệ thống
      		$truyvan4 = "UPDATE AGRICULTURAL SET AMOUNT_AGRI = ".($old_AMOUNT_AGRI["AMOUNT_AGRI"] - $agriOrder["NUM_OF_AGRI"]) ." WHERE ID_AGRI = " . $agriOrder["ID_AGRI"];

      		mysqli_query($conn,$truyvan4);

      		echo "true";
          $_SESSION['AGRI_ORDER'] = array();

          header("Location: cus_control.php");
    	   }
      }catch (Exception $e) {
      	echo "false".$e;
      }
    }


}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Giỏ Hàng</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">
</head>

<body class="product-page ">
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg bg-success" color-on-scroll="0" style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
                <i class="material-icons">spa</i>
            </a>

            <form class="form-inline" method="post" action="filter-product.php">
                <div class="form-group has-white" style="padding-left: 200px;">
                    <input name="KEYWORD" class="form-control" type="text" placeholder="Tìm sản phẩm" style="width:300px;">
                </div>
                <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round ml-2">
                    <i class="material-icons">search</i>
                </button>
            </form>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsCollapse" aria-controls="navbarsCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
                <!-- 3 line Toggle Collapse Button -->
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse nav justify-content-end" id="navbarsCollapse">


                <!-- Rightside Links -->
                <ul class="navbar-nav">
                  <?php
                  //Kiểm tra nếu coockie đã đăng nhập
                  if(isset($_COOKIE["USERNAME_CUS"])) {
                      $tendangnhap = $_COOKIE["USERNAME_CUS"];

                      $sql = "SELECT * FROM CUSTOMER WHERE USERNAME_CUS = '". $tendangnhap. "' LIMIT 1";
                      $rs_user = mysqli_query($conn,$sql) or die(mysqlii_error());
                      $row = mysqli_fetch_array($rs_user);
                      $fullname = $row['FULLNAME_CUS'];
                      $url_img_avata = $row['IMG_URL_CUS'];


                  echo 'Xin chào '.$fullname . ' ! ';

                  echo '<a href="cus_control.php" class="pull-left"><img src="assets/img_cus/'.$url_img_avata.'" height="36" width="36" ></a>';

                  echo '<li class="nav-item">

                          <a class="nav-link" href="signout.php">
                              <i class="material-icons">content_paste</i>
                              Đăng xuất
                          </a>
                      </li>';

                  }else{
                      echo '<li class="nav-item">
                              <a class="nav-link" href="signup.php">
                                  <i class="material-icons">content_paste</i>
                                  Đăng ký
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="../agric/login.php">
                                  <i class="material-icons">account_circle</i>
                                  Đăng nhập
                              </a>
                          </li>';
                  }
                  ?>

                </ul>

            </div>
        </div>
    </nav>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="section section-gray">
        <div class="container">
            <div class="main main-raised main-product">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Giỏ hàng</h1>
                    </div>
                    <div class="col-lg-12 col-md-12 ml-auto mr-auto">
                        <div class="table-responsive">
                            <form method='POST' action=''>
                            <table class="table table-shopping">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Sản phẩm</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-left">Đơn vị</th>
                                        <th class="text-right">Thành giá</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- Show ra danh sach cac nong san da dat hang -->
                                <?php
                                $tongDonHang = 0.0;

                                if (isset($_SESSION['AGRI_ORDER']) && !count($_SESSION['AGRI_ORDER'])==0) {
                                  foreach ($_SESSION['AGRI_ORDER'] as $position => $agri) {
                                    $sql = "SELECT * FROM agricultural,kinds WHERE ID_AGRI='".$agri['ID_AGRI']."' and agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC";
                                    $rs = mysqli_query($conn,$sql) or die(mysqlii_error());


                                    while ($row = mysqli_fetch_array($rs)) {
                                      $giaHienTai = $agri['CURRENT_PRICE'];
                                      //Show thông tin
                                      if ($agri['NUM_OF_AGRI']>1000){
                                        $soLuongMua = $agri['NUM_OF_AGRI']/1000;
                                        $donVi = "Kg";
                                      }else{
                                        $soLuongMua = $agri['NUM_OF_AGRI'];
                                        $donVi = "g";
                                      }


                                      //Tính giá
                                      $tongGia = ($agri['NUM_OF_AGRI']*$agri['CURRENT_PRICE'])/1000;
                                      $tongDonHang += $tongGia;
                                    $inspector[] = $row['ID_AGRI'];
                                    echo "    <tr>"
                                    .'        <form  id="formname'.$agri['ID_AGRI'].'" action="product-detail.php" method="post" >'
                                    ."        <td>"
                                    ."            <div class='img-container'>"
                                    ."                <img src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
                                    ."            </div>"
                                    ."        </td>"
                                    ."        <td class='td-name'>"

                                    .'            <a href="javascript:;" onclick="'."document.getElementById('formname".$agri['ID_AGRI']."')".'.submit();">'
                                    ."                <font color='#4caf50'>".$row['NAME_AGRI']."</font>"
                                    ."            </a>"
                                    .'        <input type="hidden" name="getidagri" value="'.$agri['ID_AGRI'].'" />'

                                    ."            <br>"
                                    ."            <small>Loại: ".$row['NAME_KIND']."</small>"
                                    ."        </td>"
                                    .'        </form>'
                                    ."        <td class='td-number text-right'>"
                                    .            $giaHienTai
                                    ."            <small> VNĐ</small>"
                                    ."        </td>"
                                    ."        <td class='td-number text-center'>"

                                    .             $soLuongMua

                                    ."        </td>"
                                    ."        <td>"
                                    ."            <div class='form-group' style='width: 30px;'>"

                                    .             $donVi
                                    ."            </div>"
                                    ."        </td>"
                                    ."        <td class='td-number text-right' id = 'tong'>"
                                    .             $tongGia
                                    ."            <small> VNĐ</small>"
                                    ."        </td>"
                                    ."        <td class='td-actions'>"
                                    .'        <form  action="cart-table.php" method="post" >'
                                    ."            <button type='submit' rel='tooltip' data-placement='right' title='Xoá' class='btn btn-link' name='Posi_Delete' value= '".$position."' >"
                                    ."                <i class='material-icons'>close</i>"
                                    ."            </button>"
                                    .'        </form>'
                                    ."        </td>"
                                    ."    </tr>";

                                    }
                                  }

                                }else {
                                  echo "Giỏ hàng trống !";
                                }

                                ?>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="td-total">
                                            Tổng cộng
                                        </td>
                                        <td class="td-price text-center">
                                          <?php
                                          echo "$tongDonHang";
                                           ?>
                                            <small> VNĐ</small>
                                        </td>
                                        <td colspan="3" class="text-right">
                                          <form  action="cart-table.php" method="post" >
                                            <button type="submit" class="btn btn-success btn-round"
                                            name='DAT_HANG' value=<?php echo "$tongDonHang"; ?> >ĐẶT HÀNG
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </button>
                                          </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="features text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">local_shipping</i>
                            </div>
                            <h4 class="info-title"> Vận chuyển nội thành trong 30 phút </h4>
                            <p>Ngay sau khi quý khách đặt hàng trên hệ thống, chúng tôi sẽ liên lạc để xác thực đơn hàng và
                                tiến hành giao tận nơi trong vòng 30 phút.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Đảm bảo chất lượng sản phẩm</h4>
                            <p>Hoàn tiền 100% nếu khách hàng phát hiện sẩn phẩm kém chất lượng, không rõ nguồn gốc.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">group</i>
                            </div>
                            <h4 class="info-title">Đội ngũ nhân viên chuyên nghiệp</h4>
                            <p>Với mong muốn mang lại sự hài lòng cho quý khách hàng và nâng cao chất lượng cửa hàng. Agric
                                Shop đã không ngừng cải tiến nâng cao trình độ đội ngũ nhân viên tư vấn bán hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- Footer -->
    <!-- CONTACT US -->
    <div class="contactus-1 section-image" style="background-image: url('assets/img/contact-footer.jpg')" id="contactus">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="title">Thông tin liên hệ</h2>
                    <h5 class="description"></h5>
                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                            <i class="material-icons">pin_drop</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Địa chỉ shop</h4>
                            <p> ĐH Cần Thơ - Khu II,
                                <br> Đường 3 tháng 2, P.Xuân Khánh, Q.Ninh Kiều
                                <br> Cần Thơ
                            </p>
                        </div>
                    </div>
                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                            <i class="material-icons">phone</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Gọi ngay khi bạn cần</h4>
                            <p> Minh Tâm
                                <br> +84 123 456 7890
                                <br> Thứ 2 - Thứ 6, 7:30-20:30
                            </p>
                        </div>
                    </div>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.840125724688!2d105.76888941529546!3d10.0300485252669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883d0dac6b15%3A0xf6ae5b1bd18625!2sCan+Tho+University!5e0!3m2!1sen!2s!4v1521453020174"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <!-- END CONTACT US -->
    <footer class="footer footer-black footer-big">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <h5>About Us</h5>
                        <p>Mua hàng trực tuyến (mua hàng online) mang lại sự tiện lợi, lựa chọn đa dạng hơn và các dịch vụ tốt
                            hơn cho người tiêu dùng, thế nhưng người tiêu dùng Việt Nam vẫn chưa tận hưởng được những tiện
                            ích đó. Chính vì vậy Agric shop được triển khai với mong muốn trở thành thương hiệu mua sắm nông
                            sản trực tuyến, nơi bạn có thể chọn lựa các mặt hàng nông sản từ loại thông dụng cho đến các
                            loại đặc biệt… Chúng tôi có tất cả!</p>
                    </div>
                    <div class="col-md-8">
                        <h5>Social Feed</h5>
                        <div class="social-feed">
                            <div class="feed-line">
                                <i class="fa fa-youtube"></i>
                                <p>Youtube.com/user</p>
                            </div>
                            <div class="feed-line">
                                <i class="fa fa-facebook-square"></i>
                                <p>Fb.com/huy.tran.dsner</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <nav class="float-left">
                <ul>
                    <li>
                        <a href="#">
                            Designed by Huy Tran
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="copyright float-right">
                &#xA9;
                <script>
                    document.write(new Date().getFullYear())
                </script>, Material Kit for Bootstrap 4 by
                <a href="http://www.creative-tim.com" target="_blank">Creative Tim</a>
            </div>
        </div>

    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
    <!--   Core JS Files   -->
    <!-- <script src="assets/js/core/jquery.min.js"></script> -->
    <!-- <script src="assets/js/core/popper.min.js"></script> -->
    <script src="assets/js/bootstrap-material-design.js"></script>

    <!-- Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="assets/js/plugins/moment.min.js"></script>

    <!-- Plugin for Select -->
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>

    <!-- Plugin for Tags -->
    <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>

    <!-- Plugin for Fileupload -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>

    <!-- Plugin for Small Gallery in Product Page -->
    <script src="assets/js/plugins/jquery.flexisel.js"></script>

    <!-- Plugin for the Datepicker -->
    <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

    <!-- Plugin for the Sliders -->
    <script src="assets/js/plugins/nouislider.min.js"></script>

    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="assets/js/material-kit.js?v=2.0.0"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

</body>

</html>
