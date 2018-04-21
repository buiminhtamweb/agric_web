<?php
#Connect to MySQL
include_once("config.php");

#Select entry from DB
$sql = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI DESC";
$rs = mysqli_query($conn,$sql) or die(mysqli_error());
?>
<meta charset="utf-8">

<!doctype html>
<html lang="en">

<?php
#Only run PHP SQL Insert if the Submit button was clicked
if (isset($_POST['submit'])){
    #Updated database list after submit when refresh page
    header('Location: '.$_SERVER['REQUEST_URI']);
    #SQL Insert
    $sql_is = "insert into AGRICULTURAL values('"
    . $_POST["ID_AGRI"] . "','"
    . $_POST["ID_KIND"] . "','"
    . $_POST["NAME_AGRI"] . "','"
    . $_POST["DETAIL_AGRI"] . "','"
    . $_POST["IMG_URL_AGRI"] . "',"
    . $_POST["PRICE_AGRI"] . ","
    . $_POST["AMOUNT_AGRI"] . ")";

    $rs_is = mysqli_query($conn,$sql_is) or die(mysqli_error());
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Insert Test</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">

</head>

<body style="background-color: #3B3E45;">
    <!-- Navigation bar -->
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
                <i class="material-icons">spa</i>
            </a>

            <!-- <form class="form-inline">
                <div class="form-group has-white" style="padding-left: 200px;">
                    <input class="form-control" type="text" placeholder="Tìm sản phẩm" style="width:300px;">
                </div>
                <button type="button" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round ml-2" onclick="window.location.href='filter-product.html'">
                    <i class="material-icons">search</i>
                </button>
            </form> -->

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
                        <a class="nav-link" href="../agric/index.php">
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
                        <h1 class="title">Insert Test Php</h1>
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
                        <a class="nav-link active" href="#tab-sp" role="tab" data-toggle="tab">
                            <i class="material-icons">dashboard</i>
                            QL Sảm phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-user" role="tab" data-toggle="tab">
                            <i class="material-icons">group</i>
                            QL Người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#tab-order" role="tab" data-toggle="tab">
                            <i class="material-icons">list</i>
                            QL Đơn hàng
                        </a>
                    </li>
                </ul>
                <br>
                <div class="tab-content tab-space">
                    <div class="tab-pane fade show active" id="tab-sp">
                        <!-- Product insert form -->
                        <!-- "?php $_SESSION['PHP_SELF'];?" To run PHP function inside html page -->
                        <form enctype="multipart/form-data" method="post" action="">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group has-success">
                                        <label for="id_agri"></label>
                                        <input type="text" class="form-control" id="id_agri" placeholder="Mã nông sản" name="ID_AGRI">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group has-success">
                                        <label for="id_kind"></label>
                                        <input type="text" class="form-control" id="id_kind" placeholder="Mã loại" name="ID_KIND">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group has-success">
                                <label for="name_agri"></label>
                                <input type="text" class="form-control" id="name_agri" placeholder="Tên nông sản" name="NAME_AGRI">
                            </div>

                            <div class="form-group has-success">
                                    <label for="detail_agri"></label>
                                    <textarea class="form-control" id="detail_agri" rows="3" placeholder="Thông tin" name="DETAIL_AGRI"></textarea>
                            </div>

                            <!-- File uploader -->
                            <div class="form-group form-file-upload form-file-multiple has-success">
                                <input type="file" multiple="" class="inputFileHidden">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" placeholder="Upload file..." name="IMG_URL_AGRI">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-success">
                                            <i class="material-icons">attach_file</i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group has-success">
                                    <label for="price_agri"></label>
                                    <input type="text" class="form-control" id="price_agri" placeholder="Đơn giá" name="PRICE_AGRI">
                            </div>

                            <div class="form-group has-success">
                                    <label for="amount_agri"></label>
                                    <input type="number" class="form-control" id="amount_agri" placeholder="Số lượng" name="AMOUNT_AGRI">
                            </div>

                        <br>
                            <button type="submit" class="btn btn-success" name="submit">THÊM</button>
                            <button type="reset" class="btn btn-danger" name="rest">RESET</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab-user">
                        Tab Quản lý người dùng
                    </div>
                    <div class="tab-pane fade" id="tab-order">
                        Tab Quản lý đơn hàng
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" style="background-color: #3B3E45;">
        <div class="container">
        <div class="card card-nav-tabs" style="width:105%; ">
                <div class="card-header card-header-success text-center">
                <table class='table'>
                    <thead>
                        <tr>
                            <th class='text-left' style='color:white;'>#</th>
                            <th class='text-left' style='color:white;'>#</th>
                            <th class='text-left' style='color:white;'>Tên nông sản</th>
                            <th class='text-left' style='color:white; width:200px;'>Thông tin</th>
                            <th class='text-right' style='color:white;'>Đơn giá</th>
                            <th class='text-right' style='color:white;'>Số lượng</th>
                            <th class='text-right' style='color:white;'>Hình</th>
                            <th class='text-right' style='color:white;'>Chức năng</th>
                        </tr>
                    </thead>
                </table>
                </div>
                <div class="container" style="overflow-y:scroll; height:800px;">             
                <table class='table'>
                <!-- PHP Product list select -->
                <?php
                while ($row = mysqli_fetch_array($rs)) {
                echo "    <tbody>";
                echo "        <tr>
                            <td class='text-right' style='width:10px;'>".$row['ID_AGRI']."</td>".
                            "<td class='text-right' style='width:30px;'>".$row['ID_KIND']."</td>".
                            "<td style='width:220px;'>".$row['NAME_AGRI']."</td>".
                            "<td style='width:230px;'>".$row['DETAIL_AGRI']."</td>".
                            "<td class='text-center' style='width:120px;'>".$row['PRICE_AGRI']."</td>".
                            "<td class='text-center' style='width:90px;'>".$row['AMOUNT_AGRI']."</td>".
                            "<td class='text-center' style='width:130px;'><img style='width:90px; height='90px;' src='assets/img_agric/".$row['IMG_URL_AGRI']."'></td>";
                echo "       <td class='text-right' style='width:90px;'>"
                                ."<button type='button' rel='tooltip' class='btn btn-success btn-fab btn-fab-mini btn-round'>"
                                    ."<i class='material-icons'>edit</i>"
                                ."</button>"
                                ." <button type='button' rel='tooltip' class='btn btn-danger btn-fab btn-fab-mini btn-round'>"
                                    ."<i class='material-icons'>delete</i>"
                                ."</button>"
                            ."</td>"
                        ."</tr>";
                echo "    </tbody>";
                }
                ?>

                </table>
                </div>    
            </div>
        </div>
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

    <!-- Modal Popup -->
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
    </script>
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