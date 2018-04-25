<?php
#Connect to MySQL
$conn = mysql_connect("127.0.0.1","root","") or die(mysql_error());
mysql_set_charset($conn, 'utf8');
#Connect to DB
$db = mysql_select_db("agri_db", $conn) or die(mysql_error());
#Select entry from table
$sql = "SELECT * FROM agricultural,kinds WHERE agricultural.ID_KIND = kinds.ID_KIND Order by ID_AGRI";
$rs = mysql_query($sql, $conn) or die(mysql_error());

// $sql_cv = "SELECT * FROM huy_nuong_chucvu";
// $sql_dv = "SELECT * FROM huy_nuong_donvi";
// $rs_cv = mysql_query($sql_cv, $conn) or die(mysql_error());
// $rs_dv = mysql_query($sql_dv, $conn) or die(mysql_error());

?>
<meta charset="utf-8">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Product List</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/material-kit.css" rel="stylesheet">

</head>

<body style="background-color: #3B3E45;">
    <!-- Navigation bar -->
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg bg-success"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
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
                        <h1 class="title">Test List php</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="section" style="background-color: #3B3E45;">
        <div class="container">
            <div class="card card-nav-tabs" style="width: 100%;">
                <div class="card-header card-header-success text-center">
                    <h4>Danh sách nông sản</h4>
                </div>
                <div class="container">
                <table class='table'>
                    <thead>
                        <tr>
                            <th class='text-center'>#</th>
                            <th class='text-center'>#</th>
                            <th>Tên nông sản</th>
                            <th>Thông tin</th>
                            <th class='text-right'>Đơn giá</th>
                            <th class='text-center'>Số lượng</th>
                            <th class='text-center'>Hình</th>
                            <th class='text-right'>Actions</th>
                        </tr>
                    </thead>
                <?php
                while ($row = mysql_fetch_array($rs)) {
                echo "    <tbody>";
                echo "        <tr>
                            <td class='text-center'>".$row['ID_AGRI']."</td>".
                            "<td class='text-center'>".$row['ID_KIND']."</td>".
                            "<td>".$row['NAME_AGRI']."</td>".
                            "<td>".$row['DETAIL_AGRI']."</td>".
                            "<td class='text-right'>".$row['PRICE_AGRI']."</td>".
                            "<td class='text-center'>".$row['AMOUNT_AGRI']."</td>".
                            "<td class='text-center'>".$row['IMG_URL_AGRI']."</td>";
                echo "       <td class='td-actions text-right'>"
                                ."<button type='button' rel='tooltip' class='btn btn-success'>"
                                    ."<i class='material-icons'>edit</i>"
                                ."</button>"
                                ."<button type='button' rel='tooltip' class='btn btn-danger'>"
                                    ."<i class='material-icons'>close</i>"
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

    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/bootstrap-material-design.js"></script>

    <!-- Plugin for Select -->
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>

    <!-- Plugin for Fileupload -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>

    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="assets/js/material-kit.js?v=2.0.0"></script>

</body>
</html>