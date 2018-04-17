<?php
#Include connect setting to DB
include_once("config.php");

#Select entry from DB
$sql = "SELECT * FROM agricultural,agri_order WHERE agricultural.ID_AGRI='".$_POST['getidagri']."' and agricultural.ID_AGRI = agri_order.ID_AGRI";
$rs = mysqli_query($conn,$sql) or die(mysqlii_error());
#Call data entry that've selected above
$row = mysqli_fetch_assoc($rs);

#Select name kind entry from DB

$sql_kind = "SELECT * FROM agricultural,kinds WHERE ID_AGRI='".$_POST['getidagri']."' and agricultural.ID_KIND = kinds.ID_KIND";
$rs_kind = mysqli_query($conn,$sql_kind) or die(mysqlii_error());
#Call data entry that've selected above
$row_kind = mysqli_fetch_assoc($rs_kind);


#Select relative - Limit by 4 items
$sql_lq = "SELECT * FROM agricultural WHERE ID_KIND='".$row_kind['ID_KIND']."'  LIMIT 4";
$rs_lq = mysqli_query($conn,$sql_lq) or die(mysqli_error());

?>

<?php
#Only run PHP SQL Insert if the Submit button was clicked
if (isset($_POST['submit'])){
    #SQL Insert
    $sql_is_order = "insert into AGRI_ORDER values('"
    . $_POST["ID_ORDER"] . "','"
    . $_POST["ID_AGRI"] . "','"
    . $_POST["NUM_OF_AGRI"] . "',"
    . $_POST["CURRENT_PRICE"] . ")";

    $rs_is = mysqli_query($conn,$sql_is) or die(mysqli_error());
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

    <title>Agric Shop - Sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">
</head>

<body class="product-page ">
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

    <!-- Main content -->
    <div class="section section-gray">
        <div class="container">
            <div class="main main-raised main-product">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="tab-content">
                            <div class="tab-pane" id="product-page1">
                            <!-- PHP get product img from db -->
                            <?php
                            echo "    <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."</div>"
                            ."<div class='tab-pane active' id='product-page2'>"
                            ."    <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."</div>"
                            ."<div class='tab-pane' id='product-page3'>"
                            ."    <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."</div>"
                            ."<div class='tab-pane' id='product-page4'>"
                            ."    <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."</div>";
                            ?>
                        </div>
                        <ul class="nav flexi-nav" data-tabs="tabs" id="flexiselDemo1">
                            <!-- PHP get product small thumbnail img from db -->
                            <?php
                            echo "<li class='nav-item'>"
                            ."    <a href='#product-page1' class='nav-link' data-toggle='tab'>"
                            ."        <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."    </a>"
                            ."</li>"
                            ."<li class='nav-item'>"
                            ."    <a href='#product-page1' class='nav-link' data-toggle='tab'>"
                            ."        <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."    </a>"
                            ."</li>"
                            ."<li class='nav-item'>"
                            ."    <a href='#product-page1' class='nav-link' data-toggle='tab'>"
                            ."        <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."    </a>"
                            ."</li>"
                            ."<li class='nav-item'>"
                            ."    <a href='#product-page1' class='nav-link' data-toggle='tab'>"
                            ."        <img src='assets/img_agric/".$row_kind['IMG_URL_AGRI']."'>"
                            ."    </a>"
                            ."</li>";
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <form method='POST' action='cart-table.php'>
                        <!-- PHP Get data from id_agri -->
                        <?php
                        echo "<h2 class='title'>" .$row_kind['NAME_AGRI']. "</h2>"
                        ."<h3 class='main-price'>".$row_kind['PRICE_AGRI']. "VNĐ/KG</h3>"
                        ."<div id='accordion' role='tablist'>"
                        ."    <div class='card card-collapse'>"
                        ."        <div class='card-header' role='tab' id='headingOne'>"
                        ."            <h5 class='mb-0'>"
                        ."                <a data-toggle='collapse' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>"
                        ."                    Thông tin"
                        ."                    <i class='material-icons'>keyboard_arrow_down</i>"
                        ."                </a>"
                        ."            </h5>"
                        ."        </div>"
                        ."        <div id='collapseOne' class='collapse show' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>"
                        ."            <div class='card-body'>"
                        ."                <p>".$row_kind['DETAIL_AGRI']."</p>"
                        ."            </div>"
                        ."        </div>"
                        ."    </div>"
                        ."    <div class='card card-collapse'>"
                        ."        <div class='card-header' role='tab' id='headingTwo'>"
                        ."            <h5 class='mb-0'>"
                        ."                <a class='collapsed' data-toggle='collapse' href='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'>"
                        ."                    Loại nông sản"
                        ."                    <i class='material-icons'>keyboard_arrow_down</i>"
                        ."                </a>"
                        ."            </h5>"
                        ."        </div>"
                        ."        <div id='collapseTwo' class='collapse' role='tabpanel' aria-labelledby='headingTwo' data-parent='#accordion'>"
                        ."            <div class='card-body'>"
                        .                $row_kind['NAME_KIND']
                        ."            </div>"
                        ."        </div>"
                        ."    </div>"
                        ."</div>"
                        ."<br>"
                        ."<form>"
                        ."    <div class='form-group label-floating has-success'>"
                        ."        <label class='control-label'>Số lượng</label>"
                        ."        <input type='text' value='".$row['NUM_OF_AGRI']."' class='form-control' />"
                        ."    </div>"
                        ."    <div class='row pull-center'>"
                        ."        <button type='submit' class='btn btn-success btn-round' name='getidagri'value='".$row_kind["ID_AGRI"]."'>Thêm vào giỏ &#xA0;"
                        ."            <i class='material-icons'>shopping_cart</i>"
                        ."        </button>"
                        ."    </div>"
                        ."</form>";
                        ?>
                        
                        </form>
                    </div>
                </div>
            </div>
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
            <!-- Relative Products -->
            <div class="section">
                <div class="container">
                    <h3 class="title text-center">Các sản phẩm liên quan: </h3>
                    <div class="row">
                <!-- PHP fucntion select sale product -->
                <?php
                    while ($row = mysqli_fetch_array($rs_lq)) {
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
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script>
        $(document).ready(function () {
            $("#flexiselDemo1").flexisel({
                visibleItems: 4,
                itemsToScroll: 1,
                animationSpeed: 400,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 3
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 3
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });
        });
    </script>
</body>

</html>