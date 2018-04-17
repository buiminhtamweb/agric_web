<?php

session_start();
#Include connect setting to DB
include_once("config.php");

#Select entry from DB
$sql = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC";
$rs = mysqli_query($conn,$sql) or die(mysqlii_error());

#Select new products - Limit by 6 items
$sql_nb = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC LIMIT 6";
$rs_nb = mysqli_query($conn,$sql_nb) or die(mysqli_error());

#Select sale products - Limit by 3 items
$sql_km = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI LIMIT 3";
$rs_km = mysqli_query($conn,$sql_km) or die(mysqli_error());

#Banner
$sql_banner = "SELECT BANNER FROM BANNER";
$rs_banner = mysqli_query($conn,$sql_banner) or die(mysqli_error());


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

    <title>Agric Shop - Nông sản Online</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/material-kit.css" rel="stylesheet">
    <link href="./assets/css/customefx.css" rel="stylesheet">
    <?php   $mobile_browser = '0';

    //Kiểm tra thiết bị có phải là điện thoại hay k
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }    

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda ','xda-');

    if (in_array($mobile_ua,$mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
        $mobile_browser = 0;
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'mac') > 0) {
            $mobile_browser = 0;
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ios') > 0) {
            $mobile_browser = 1;
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'android') > 0) {
            $mobile_browser = 1;
    }

    if($mobile_browser != 0)
    {
        //its a mobile browser
        header ('Location:mobile.php');
        exit;
    }
    ?>
    <style>
    .card-header-image img {
        width: 350px;
        height: 250px;
        margin: center;
    }
    </style>

</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100" style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php"><i class="material-icons">spa</i></a>
            <!-- Search form -->
            <form class="form-inline">
                <div class="form-group has-white" style="padding-left: 200px;" >
                    <input class="form-control" type="text" placeholder="Tìm sản phẩm" style="width:300px;">
                </div>
                <button type="button" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round ml-2" onclick="window.location.href='filter-product.php'">
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
                <!-- Leftside -->
                <!-- <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul> -->

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


                     echo '<a href="#" class="pull-left"><img src="images/'.$url_img_avata.'" height="36" width="36" ></a>'; 


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
                <!-- Carousel Slider -->
                <div id="carouselIndicators" class="carousel slide" data-ride="carousel" data-pause="hover">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <!-- Auto load Slide 1 *acitve -->
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($rs_banner)) {
                        	echo '<div class="carousel-item ';
                        if ($i==1) {
                        	echo "active";
                        	$i++;
                        }
                        echo '">
                            <img class="d-block w-100" src="assets/img_banner/'.$row["BANNER"].'" alt="First slide" >
                         
                        </div>';
                        }
                        ?>
                        <!-- <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/img/slider-img-1.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h1>Khuyến mãi</h1>
                                <h3>Giảm 20% đối với các loại Gạo</h3>
                            </div>
                        </div> -->
                   <!--      <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/slider-img-1.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h1>Khuyến mãi</h1>
                                <h3>Giảm 20% đối với các loại Gạo</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/slider-img-1.jpg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h1>Khuyến mãi</h1>
                                <h3>Giảm 20% đối với các loại Gạo</h3>
                            </div>
                        </div> -->
                    </div>
                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <br>
                <br>
    <!-- Image header -->
    <!-- <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('assets/img/img-header.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <div class="brand">
                        <h1 class="title">Agric Shop</h1>
                        <h4>Nông sản Online - Lấy chất lượng làm
                            <b>Niềm tin!</b>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Main content -->
    <div class="main main-raised" id="toppage">
        <div class="section">
            <div class="container">
                <!-- Slider - Tin khuyến mãi -->

                <!-- Sale products -->
                <h2 class="section-title" id="hotproduct">Nông sản nổi bật</h2>
                <!-- Create a row -->
                <div class="row">
                    <!-- Page layout = 12 => 3 col (Each col = 4) -->
                    <?php
                    while ($row = mysqli_fetch_array($rs_nb)) {
                    echo "<div class='col-md-4'>"
                    ."    <form id='itemform' method='POST' action='product-detail.php'>"
                    // Create a transparent button that will make a whole item card clickable
                    ."    <button type='submit' name='getidagri'value='".$row["ID_AGRI"]."' style='height:410px; background-color:transparent; border-color:transparent; cursor: pointer;'>"
                    ."    <div class='card card-product'>"
                    ."        <div class='card-header card-header-image'>"
                    ."                <img alt='...' src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
                    ."        </div>"
                    ."        <div class='card-body'>"
                    ."            <h4 class='card-title'>"
                    ."                <a href='product-detail.php'>".$row['NAME_AGRI']."</a>"
                    ."            </h4>"
                    ."            <p class='card-description'>".$row['DETAIL_AGRI']."</p>"
                    ."        </div>"
                    ."        <div class='card-footer'>"
                    ."            <div class='price-container'>"
                    ."                <span class='price'>".$row['PRICE_AGRI']." VNĐ/KG</span>"
                    ."            </div>"
                    ."        </div>"
                    ."    </div>"
                    ."    </button>"
                    ."    </form>"
                    ."    </div>";
                    }
                    ?>
                </div>
                <h2 class="section-title" id="saleproduct">Nông sản giảm giá</h2>
                <!-- Create a row -->
                <div class="row">
                    <!-- Page layout = 12 => 3 col (Each col = 4) -->
                    <?php
                    while ($row = mysqli_fetch_array($rs_km)) {
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
                    ."            <p class='card-description'>".$row['DETAIL_AGRI']."</p>"
                    ."        </div>"
                    ."        <div class='card-footer'>"
                    ."            <div class='price-container'>"
                    ."                <span class='price price-old'> 25.000 VNĐ/KG</span>"
                    ."                <span class='price price-new'>&nbsp;".$row['PRICE_AGRI']." VNĐ/KG</span>"
                    ."            </div>"
                    ."        </div>"
                    ."    </div>"
                    ."    </button>"
                    ."    </form>"
                    ."</div>";
                    }
                    ?>

                    <div class="ml-auto mr-auto">
                        <a href="filter-product.php" class="btn btn-success btn-round" role="button">Xem thêm...</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Customer's Feedback -->
    <div class="section section-blog">
        <div class="container">
            <h2 class="section-title">Đánh giá của Khách hàng</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-header card-header-image">
                                <img src="assets/img/user-feedback.jpg" alt="">
                            <div class="colored-shadow" style="background-image: url(&quot;../assets/img/kit/pro/dg6.jpg&quot;); opacity: 1;"></div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-rose">Customer 1</h6>
                            <h4 class="card-title">
                                "Good site, good price and fresh products."
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-header card-header-image">
                                <img src="assets/img/user-feedback.jpg" alt="">
                            <div class="colored-shadow" style="background-image: url(&quot;../assets/img/kit/pro/dg10.jpg&quot;); opacity: 1;"></div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-rose">Customer 2</h6>
                            <h4 class="card-title">
                                "Good site, good price and fresh products."
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-header card-header-image">
                                <img src="assets/img/user-feedback.jpg" alt="">
                            <div class="colored-shadow" style="background-image: url(&quot;../assets/img/kit/pro/dg9.jpg&quot;); opacity: 1;"></div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-rose">Customer 3</h6>
                            <h4 class="card-title">
                                "Good site, good price and fresh products."
                            </h4>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.840125724688!2d105.76888941529546!3d10.0300485252669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883d0dac6b15%3A0xf6ae5b1bd18625!2sCan+Tho+University!5e0!3m2!1sen!2s!4v1521453020174" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/bootstrap-material-design.js"></script>

    <!--  Google Maps Plugin  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YAIzaSyDdeBa7CAoqmil82R_2_EjaGYFynotJrJs"><script>

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
        $(document).ready(function () {

            var slider2 = document.getElementById('sliderDouble');

            noUiSlider.create(slider2, {
                start: [20, 45],
                connect: true,
                range: {
                    'min': [10],
                    'max': [80]
                }
            });

            var limitFieldMin = document.getElementById('price-left');
            var limitFieldMax = document.getElementById('price-right');
            // Add Price text on top of handle
            slider2.noUiSlider.on('update', function (values, handle) {
                if (handle) {
                    limitFieldMax.innerHTML = Math.round(values[handle]) + ".000" + $('#price-right').data('currency');
                } else {
                    limitFieldMin.innerHTML = Math.round(values[handle]) + ".000" + $('#price-left').data('currency');
                }
            });
        });
    </script>

</body>

</html>