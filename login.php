<?php
session_start();

$isFail = false;

if(!empty($_POST)) {
    
    include_once("config.php");
    $username = $_POST["form-username"];
    $pass = $_POST["form-password"];
    mysqli_set_charset($conn, "utf8");
    $truyvan = "SELECT * FROM CUSTOMER WHERE USERNAME_CUS='".$username."' AND PASSWORD_CUS='".$pass."' LIMIT 1";
    $ketqua = mysqli_query($conn,$truyvan);
    $demdong = mysqli_num_rows($ketqua);
    if($demdong >=1){
        setcookie("USERNAME_CUS", $username, time() + 3600, "/","", false, true);
        $_SESSION['USERNAME_CUS'] = $username;
        header('Location: ../agric/index.php');
    }else {
        $isFail = true;
        
    }
    mysqli_close($conn);
}

function showError(){

    if ($GLOBALS['isFail']) {
        echo "<pre>Sai tên đăng nhập hoặc mật khẩu</pre>";
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

    <title>Agric Shop - Đăng nhập</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/material-kit.css" rel="stylesheet">
    <link href="./assets/css/vertical-nav.css" rel="stylesheet" />

</head>

<body class="login-page ">
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100" style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php"><i class="material-icons">spa</i></a>
            <!-- Search form -->
            <form class="form-inline">
                <div class="form-group has-white" style="padding-left: 200px;" >
                    <input class="form-control" type="text" placeholder="Tìm sản phẩm" style="width:300px;">
                </div>
                <button type="button" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round ml-2" onclick="window.location.href='filter-product.html'">
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
                <ul class="navbar-nav my-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../agric/cart-table.html">
                            <i class="material-icons">shopping_cart</i>
                            Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../agric/signup.html">
                            <i class="material-icons">content_paste</i>
                            Đăng ký
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="page-header header-filter" filter-color="green" style="background-image: url('assets/img/login-bg.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                    <div class="card card-signup">
                        <form class="form" method="POST" action="">
                            <div class="card-header card-header-success text-center">
                                <h4 class="card-title">Đăng nhập</h4>
                            </div>
                            <p class="description text-center"> </p>
                            <div class="card-body">

                                <?php
                                showError();
                                ?>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <input name = "form-username"  type="text" class="form-control" placeholder="User Name...">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input name = "form-password" type="password" class="form-control" placeholder="Password...">
                                </div>
                                <!-- If you want to add a checkbox to this form, uncomment this code

								<div class="checkbox">
									<label>
										<input type="checkbox" name="optionsCheckboxes" checked>
										Subscribe to newsletter
									</label>
								</div> -->
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn" class="btn btn-success btn-link btn-wd btn-lg">Đăng nhập</button>
                                <!-- <a href="#pablo" class="btn btn-success btn-link btn-wd btn-lg">Đăng nhập</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
        <footer class="footer">
            <div class="container">
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
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/bootstrap-material-design.js"></script>

    <!--  Google Maps Plugin  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>

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
</body>

</html>