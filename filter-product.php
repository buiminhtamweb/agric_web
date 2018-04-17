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

#Select name agri
$sql_name = "SELECT ID_AGRI,NAME_AGRI FROM agricultural Order by ID_AGRI";
$rs_name = mysqli_query($conn,$sql_name) or die(mysqli_error());

function loadItem($incr_product,$conn) {
    $sql_sp = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI LIMIT 9 OFFSET 1";
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
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
                <i class="material-icons">spa</i>
            </a>

            <form class="form-inline">
                <div class="form-group has-white" style="padding-left: 200px;">
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
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">
                            <i class="material-icons">content_paste</i>
                            Đăng ký
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../agric/login.html">
                            <i class="material-icons">account_circle</i>
                            Đăng nhập
                        </a>
                    </li>
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
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/img/slider-img-1.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Khuyến mãi</h1>
                    <h3>Giảm 20% đối với các loại Gạo</h3>
                </div>
            </div>
            <div class="carousel-item">
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
            </div>
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
    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <h2 class="section-title" id="saleproduct">Nông sản giảm giá</h2>
                <!-- Create a row -->
                <div class="row">
                    <!-- Page layout = 12 => 3 col (Each col = 4) -->
                    <!-- PHP fucntion select sale product -->
                    <?php
                    while ($row = mysqli_fetch_array($rs_km)) {
                    echo "<div class='col-md-4'>"
                    ."    <form id='itemform' method='POST' action='product-detail.php'>"
                        // Create a transparent button that will make a whole item card clickable
                    ."    <button type='submit' name='getidagri'value='".$row["ID_AGRI"]."' style='height:410px; background-color:transparent; border-color:transparent; cursor: pointer;'>"
                    ."    <div class='card card-product'>"
                    ."        <div class='card-header card-header-image'>"    
                    ."                <img alt='' src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
                    ."            <div class='colored-shadow' style='background-image: url('assets/img_agric/".$row['IMG_URL_AGRI']."'); opacity: 1;'></div>"
                    ."        </div>"
                    ."        <div class='card-body text-center'>"
                    ."            <h4 class='card-title'>"
                    ."                <a href='product-detail.html'>".$row['NAME_AGRI']."</a>"
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
                </div>
                <h2 class="section-title">Tìm kiếm</h2>
                <div class="row">
                    <!-- Filter Side -->
                    <div class="col-md-3">
                        <div class="card card-refine card-plain card-success">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Làm mới bộ lọc
                                    <button title="" class="btn btn-default btn-fab btn-fab-mini btn-link pull-right" data-original-title="Làm mới bộ lọc" rel="tooltip">
                                        <i class="material-icons">cached</i>
                                    </button>
                                </h4>
                                <div id="accordion" role="tablist">
                                    <div class="card card-collapse">
                                        <div class="card-header" id="headingOne" role="tab">
                                            <h5 class="mb-0">
                                                <a aria-expanded="true" aria-controls="collapseOne" href="#collapseOne" data-toggle="collapse">
                                                    Giá từ
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="card-body card-refine">
                                                <span class="price-left pull-left" id="price-left" data-currency=" VNĐ"></span>
                                                <span class="price-right pull-right" id="price-right" data-currency=" VNĐ"></span>
                                                <div class="clearfix"></div>
                                                <div id="sliderDouble" class="slider slider-success"></div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <input class="form-check-input" type="checkbox" checked="" value=""> Tất cả
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <!-- PHP fucntion select -->
                                                <?php
                                                while ($row = mysqli_fetch_array($rs_kind)) {
                                                echo" <div class='form-check'>"
                                                ."    <label class='form-check-label'>"
                                                ."        <input class='form-check-input' type='checkbox' value=''>". $row['NAME_KIND']
                                                ."        <span class='form-check-sign'>"
                                                ."            <span class='check'></span>"
                                                ."        </span>"
                                                ."    </label>"
                                                ."</div>";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-collapse">
                                        <div class="card-header" id="headingThree" role="tab">
                                            <h5 class="mb-0">
                                                <a class="collapsed" aria-expanded="false" aria-controls="collapseThree" href="#collapseThree" data-toggle="collapse">
                                                    Nhãn hiệu
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" checked="" value=""> Tất cả
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <!-- PHP fucntion select sale product -->
                                                <?php
                                                while ($row = mysqli_fetch_array($rs_name)) {
                                                echo" <div class='form-check'>"
                                                ."    <label class='form-check-label'>"
                                                ."        <input class='form-check-input' type='checkbox' value=''>". $row['NAME_AGRI']
                                                ."        <span class='form-check-sign'>"
                                                ."            <span class='check'></span>"
                                                ."        </span>"
                                                ."    </label>"
                                                ."</div>";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product side -->
                    <div class="col-md-9">
                        <div class="row">
                            <!-- PHP fucntion select 9 product -->
                            <?php
                            loadItem(0,$conn);
                            ?>

                            <div class="col-md-3 ml-auto mr-auto">
                                <button title="" class="btn btn-success btn-round" data-original-title="" rel="tooltip" onClick=loadItem>Mở rộng...</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Relative Products -->
    <div class="section">
        <div class="container">
            <h3 class="title text-center">Các nông sản mới: </h3>
            <div class="row">
                
                <!-- PHP fucntion select sale product -->
                <?php
                    while ($row = mysqli_fetch_array($rs_m)) {
                    echo "<div class='col-md-3'>"
                    ."    <form id='itemform' method='POST' action='product-detail.php'>"
                    // Create a transparent button that will make a whole item card clickable
                    ."    <button type='submit' name='getidagri'value='".$row["ID_AGRI"]."' style='background-color:transparent; border-color:transparent; cursor: pointer;'>"
                    ."    <div class='card card-product' style='width: 110%;'>"
                    ."        <div class='card-header card-header-image'>"
                    ."            <a href='product-detail.html'>"
                    ."                <img style='height: 200px;' alt='...' src='assets/img_agric/".$row['IMG_URL_AGRI']."'>"
                    ."            </a>"
                    ."        </div>"
                    ."        <div class='card-body'>"
                    ."            <h4 class='card-title'>"
                    ."                <a href='product-detail.html'>".$row['NAME_AGRI']."</a>"
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
                    ."</div>";
                    }
                ?>

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
    <script src="assets/js/core/popper.min.js"></script>
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