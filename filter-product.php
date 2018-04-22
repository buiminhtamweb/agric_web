<?php
include_once("config.php");

#Connect to DB
$sql = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC";
$rs = mysqli_query($conn,$sql) or die(mysqlii_error());

#Select new products - Limit by 4 items
$sql_m = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC LIMIT 4";
$rs_m = mysqli_query($conn,$sql_m) or die(mysqli_error());

#Select sale products - Limit by 3 items
$sql_km = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI LIMIT 3";
$rs_km = mysqli_query($conn,$sql_km) or die(mysqli_error());

#Select products - Limit by 9 items
$incr_product = 0;


#Select kinds
$sql_kind = "SELECT * FROM kinds Order by ID_KIND";
$rs_kind = mysqli_query($conn,$sql_kind) or die(mysqli_error());

// #Select name agri
// $sql_name = "SELECT ID_AGRI,NAME_AGRI FROM agricultural Order by ID_AGRI";
// $rs_name = mysqli_query($conn,$sql_name) or die(mysqli_error());

function loadItem($incr_product,$conn) {
    $sql_sp = "SELECT * FROM agricultural,kinds
    WHERE agricultural.ID_KIND = kinds.ID_KIND AND
    Order by ID_AGRI LIMIT 9 OFFSET 1";
    $rs_sp = mysqli_query($conn,$sql_sp) or die(mysqli_error());
    while ($row = mysqli_fetch_array($rs_sp)) {
        echo "<div class='col-md-4'>"
        ."    <form id='itemform' method='POST' action='product-detail.php'>"
        // Create a transparent button that will make a whole item card clickable
        ."    <button type='submit' name='getidagri'value='".$row["ID_AGRI"]."' style='height:410px; background-color:transparent; border-color:transparent; cursor: pointer;'>"
        ."    <div class='card card-product' data-colored-shadow='true'>"
        ."        <div class='card-header card-header-image'>"
        ."            <a href='product-detail.html'>"
        ."                <img alt='...' src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
        ."            </a>"
        ."        </div>"
        ."        <div class='card-body'>"
        ."            <a href='product-detail.html'>"
        ."                <h4 class='card-title'>"
        ."                    <a href='product-detail.html'>".$row['NAME_AGRI']."</a>"
        ."                </h4>"
        ."            </a>"
        ."            <p class='description'>"
        ."                ".$row['DETAIL_AGRI']
        ."            </p>"
        ."        </div>"
        ."        <div class='card-footer justify-content-between'>"
        ."            <div class='price-container'>"
        ."                <span class='price'>".$row['PRICE_AGRI']." VNĐ/KG</span>"
        ."            </div>"
        ."        </div>"
        ."        <div class='float-right'>"
        ."        </div>"
        ."    </div>"
        ."    </button>"
        ."    </form>"
        ."    <!-- end card -->"
        ."</div>";
        }
}
$keyword = "";
if (isset($_POST['KEYWORD'])) {
  $keyword = $_POST['KEYWORD'];
}

?>

<!-- css -->
<style>
.vl {
    border-left: 1px solid green;

}

.vcenter {
    display: inline-block;
    vertical-align: middle;
    float: none;
}
</style>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Tìm kiếm</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">

    <style>
    .card-header-image img {
        width: 350px;
        height: 230px;
        margin: center;
    }
    </style>

</head>

<body class="ecommerce">
    <!-- Navigation bar -->
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg bg-success" color-on-scroll="0"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
                <i class="material-icons">spa</i>
            </a>

            <form class="form-inline" >
                <div class="form-group has-white" style="padding-left: 200px;">
                    <input id="inputSearch" class="form-control" type="text"
                    placeholder="Tìm sản phẩm" style="width:300px;" value="<?php echo $keyword; ?>" onkeypress="return runScript(event)">
                </div>
                <button type="button" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round ml-2" onclick="showSearchResult()">
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
                    <li class="nav-item">
                        <a class="nav-link" href="cart-table.php">
                            <i class="material-icons">shopping_cart</i>
                            Giỏ hàng
                        </a>
                    </li>
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
                     echo '<a href="cus_control.php" class="pull-left"><img src="images/'.$url_img_avata.'" height="36" width="36" ></a>';
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

    <!-- Main content -->
    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <h2 class="section-title col-md-3">Tìm kiếm</h2>
                <div class="row">
                    <!-- Filter Side -->
                    <div class="col-md-3">
                        <div class="card card-refine card-plain card-success">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Bộ lọc nông sản

                                </h4>
                                <div id="accordion" role="tablist">
                                  <!-- Bộ lọc giá -->
                                    <div class="card card-collapse">
                                        <div class="card-header" id="headingOne" role="tab">
                                            <h5 class="mb-0">
                                                <a aria-expanded="true" aria-controls="collapseOne" href="#collapseOne" data-toggle="collapse">
                                                    Giá từ                     (Đơn vị tính: VND)
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="card-body card-refine">
                                                <span class="price-left pull-left" id="price_left" data-currency=" VNĐ">1000</span>
                                                <span class="price-right pull-right" id="price_right" data-currency=" VNĐ">500000</span>
                                                <div class="clearfix"></div>
                                                <div id="sliderDouble" class="slider slider-success"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Lọc theo loại nông sản -->
                                    <div class="card card-collapse">
                                        <div class="card-header" id="headingTwo" role="tab">
                                            <h5 class="mb-0">
                                                <a class="collapse show" aria-expanded="true" aria-controls="collapseTwo" href="#collapseTwo" data-toggle="collapse">
                                                    Nông sản
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" name='kindAgri' type="radio" checked value=0> Tất cả
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <!-- PHP fucntion select -->
                                                <?php
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($rs_kind)) {

                                                echo" <div class='form-check'>"
                                                ."    <label class='form-check-label'>"
                                                ."        <input class='form-check-input' name='kindAgri' type='radio' value=".$i.">". $row['NAME_KIND']
                                                ."        <span class='form-check-sign'>"
                                                ."            <span class='check'></span>"
                                                ."        </span>"
                                                ."    </label>"
                                                ."</div>";
                                                $i++;
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nút áp dụng -->
                                    <br>
                                    <br>
                                    <div class="ml-auto mr-auto text-center" >
                                				<button class="btn btn-success btn-round text-center" role="button" onclick="showSearchResult()">Áp dụng</button>
                                		</div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- <div class="vl"></div> -->

<!-- Product side -->
                    <div class="col-md-9">

                        <div class="row" id="result_search">
                            <!-- PHP fucntion select 9 product -->
                            <?php
                            // loadItem(0,$conn);
                            ?>


                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Giới thiệu dịch vụ vận chuyển và cam kết sản phẩm -->
    <div class="features text-center">
        <div class="row">
            <div class="col-md-4">
                <div class="info">
                    <div class="icon icon-success">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <h4 class="info-title"> Vận chuyển nội thành trong 30 phút </h4>
                    <p>Ngay sau khi quý khách đặt hàng trên hệ thống, chúng tôi sẽ liên lạc để xác thực đơn hàng và tiến hành giao tận nơi trong vòng 30 phút.</p>
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
                    <p>Với mong muốn mang lại sự hài lòng cho quý khách hàng và nâng cao chất lượng cửa hàng. Agric Shop đã không ngừng cải tiến nâng cao trình độ đội ngũ nhân viên tư vấn bán hàng.</p>
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
    <script src="assets/js/core/jquery.min.js"></script>
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

    <!-- Slider JS -->
    <script>

    //Khởi tạo Bộ lọc giá
      $('span').bind('dblclick',
               function(){
                   $(this).attr('contentEditable',true);
               });
      $(document).ready(function () {
          var slider2 = document.getElementById('sliderDouble');
          noUiSlider.create(slider2, {
              start: [1, 500],
              connect: true,
              range: {
                  'min': [1],
                  'max': [500]
              }
          });
          var limitFieldMin = document.getElementById('price_left');
          var limitFieldMax = document.getElementById('price_right');
          // Add Price text on top of handle
          slider2.noUiSlider.on('update', function (values, handle) {
              if (handle) {
                  limitFieldMax.innerHTML = Math.round(values[handle]) + "000";
              } else {
                  limitFieldMin.innerHTML = Math.round(values[handle]) + "000";
              }
          });
      });

      //Xem thêm kết quả tìm kiếm
    function showSearchResultContinue() {
      var minPrice = document.getElementById('price_left').innerHTML;
      var maxPrice = document.getElementById('price_right').innerHTML;
      var inputSearch = document.getElementById("inputSearch").value;
      var kindAgri = 0;
      var checkbox = document.getElementsByName("kindAgri");
      for (var i = 0; i < checkbox.length; i++){
          if (checkbox[i].checked === true){
            kindAgri = checkbox[i].value;

          }
      }

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

              $("#div_btnmore").remove();
              document.getElementById("result_search").innerHTML += this.responseText;

          }
      };
      xmlhttp.open("POST", "view_search.php", true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send("KEYWORD="+inputSearch+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&kindAgri="+kindAgri);
    }

    //Kết quả tìm kiếm
    function showSearchResult() {

      var minPrice = document.getElementById('price_left').innerHTML;
      var maxPrice = document.getElementById('price_right').innerHTML;

      var inputSearch = document.getElementById("inputSearch").value;


      var kindAgri = 0;
      var checkbox = document.getElementsByName("kindAgri");
      for (var i = 0; i < checkbox.length; i++){
          if (checkbox[i].checked === true){
            kindAgri = checkbox[i].value;

          }
      }


      if (inputSearch!="") {
        var xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

              if (this.responseText == "") {
                document.getElementById("result_search").innerHTML = "Không tìm thấy nông sản!"
              }else {
                document.getElementById("result_search").innerHTML = this.responseText;
              }
            }
        };
        xmlhttp1.open("POST", "view_search.php", true);
        xmlhttp1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp1.send("MAIN=0&KEYWORD="+inputSearch+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&kindAgri="+kindAgri);
      }else {
        document.getElementById("result_search").innerHTML = "Bạn chưa nhập từ khóa tìm kiếm"
      }


    }

    function runScript(e) {
      if (e.keyCode == 13) {
        showSearchResult();

      }
    }



    //Kết quả tìm kiếm từ trang khác sang
      showSearchResult();

    </script>
</body>

</html>
