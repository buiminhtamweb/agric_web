<?php
session_start();
include_once("config.php");
if (!isset($_COOKIE['ID_USER'])) {
header("Location: admin_login.php");
}

 ?>

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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Adminitrator</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            $("input").blur();
        });
    </script>
</head>

<body style="background-color: #3B3E45;">
    <!-- Navigation bar -->
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="admin_control.php">
                <i class="material-icons">spa</i>
            </a>



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
                        <a class="nav-link" href="admin_signout.php">
                            <i class="material-icons">power_settings_new</i>
                            Đăng xuất
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- Image header -->
    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('assets/img/admin-img-header.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <div class="brand">
                        <h1 class="title">Adminitrator Control Panel</h1>
                        <!-- <h4>Nông sản Online - Lấy chất lượng làm
                            <b>Niềm tin!</b>
                        </h4> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="main main-raised" style="background-color: #F1F0EF;">
        <div class="section">
            <div class="container">
                <!-- Tab panel -->
                <ul class="nav nav-pills nav-pills-icons nav-pills-success" role="tablist">
                    <!--
                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                    -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_ordering" role="tab" data-toggle="tab">
                            <i class="material-icons">store</i>
                            Duyệt đơn hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#tab_bill" role="tab" data-toggle="tab">
                            <i class="material-icons">list</i>
                            Đơn hàng đã duyệt
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#tab_addAgri" role="tab" data-toggle="tab">
                            <i class="material-icons">add</i>
                            Thêm nông sản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_editAgri" role="tab" data-toggle="tab">
                            <i class="material-icons">edit</i>
                            Cập nhật nông sản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_banner" role="tab" data-toggle="tab">
                            <i class="material-icons">payment</i>
                            Quản lý banner
                        </a>
                    </li>

                </ul>
                <br>
                <div class="tab-content tab-space">

                    <?php
                    include_once("admin_tab_odering.php");
                    include_once("admin_tab_bill.php");
                    include_once("admin_tab_addAgri.php");
                    include_once("admin_tab_editAgri.php");
                    include_once("admin_tab_banner.php");
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="section" style="background-color: #3B3E45;">

    </div>
    <!-- Footer -->
    <footer class="footer footer-black footer-big">
        <div class="container">
            <div class="content">

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
