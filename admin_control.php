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
                            <i class="material-icons">dashboard</i>
                            Thêm nông sản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_editAgri" role="tab" data-toggle="tab">
                            <i class="material-icons">edit</i>
                            Cập nhật nông sản
                        </a>
                    </li>

                </ul>
                <br>
                <div class="tab-content tab-space">

                    <!-- Tab Duyệt đơn hàng -->
                    <div class="tab-pane fade show active" id="tab_ordering">
                      <div class="container">
                        <div class="text-center">
                            <h2>Danh sách đơn hàng</h2>
                        </div>
                          <div class="card card-nav-tabs" style="width: 100%; ">

                            <div >
                                <h3 class="row" style="padding-left: 50px; font-weight: bold;" >Mã đơn hàng: 00000000</h3>
                                <div class="row" style="padding-left: 50px;">
                                  <h4 >Người mua: Bùi Minh Tâm</h4>
                                  <h4 style="padding-left: 50px;">Số điện thoại: 00000000</h4>
                                </div>
                                <h4 class="row" style="padding-left: 50px;">Địa chỉ giao hàng: CT</h4>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Tên NS</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th class="text-center">Số lượng mua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Tên nông sản</td>
                                        <td class="text-right">50.000 VNĐ</td>
                                        <td class="text-center">1</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div >
                              <h3 class="text-right " style="padding-right: 50px; color: red; ">Tổng đơn hàng: 50000</h3>

                            </div>

                            <button class="btn btn-success" name="button">Duyệt đơn hàng</button>

                          </div>
                      </div>
                    </div>

                    <!-- Đơn hàng đã duyệt -->
                    <div class="tab-pane fade" id="tab_bill">
                        Đơn hàng đã duyệt
                    </div>

                    <div class="tab-pane fade" id="tab_addAgri">
                        <!-- Product insert form -->
                        <form method="" action="">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group has-success">
                                        <label for="id_agri"></label>
                                        <input type="text" class="form-control" id="id_agri" placeholder="Mã nông sản">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group has-success">
                                        <label for="id_kind"></label>
                                        <input type="text" class="form-control" id="id_kind" placeholder="Mã loại">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-success">
                                <label for="name_agri"></label>
                                <input type="text" class="form-control" id="name_agri" placeholder="Tên nông sản">
                            </div>

                            <div class="form-group has-success">
                                    <label for="detail_agri"></label>
                                    <textarea class="form-control" id="detail_agri" rows="3" placeholder="Thông tin"></textarea>
                            </div>

                            <!-- File uploader -->
                            <div class="form-group form-file-upload form-file-multiple has-success">
                                <input type="file" multiple="" class="inputFileHidden">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" placeholder="Upload file...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-success">
                                            <i class="material-icons">attach_file</i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group has-success">
                                    <label for="price_agri"></label>
                                    <input type="text" class="form-control" id="price_agri" placeholder="Đơn giá">
                            </div>

                            <div class="form-group has-success">
                                    <label for="amount_agri"></label>
                                    <input type="number" class="form-control" id="amount_agri" placeholder="Số lượng">
                            </div>

                        <br>
                            <button type="submit" class="btn btn-success">THÊM</button>
                            <button type="reset" class="btn btn-danger">RESET</button>
                        </form>
                    </div>

                    <!-- Chỉnh sửa nông sản -->
                    <div class="tab-pane fade" id="tab_editAgri">
                      <!-- Tìm kiếm nông sản -->
                      <div class="input-group  " style="padding-left: 200px; padding-right: 200px;">
                        <input type="text" class="form-control " id="input_timkiem" placeholder="Nhập tên nông sản">
                        <button type="submit" class="btn btn-success ">Tìm kiếm</button>
                      </div>
                      <!-- View KQ tìm kiếm -->
                      <div class="container">
                          <div class="card card-nav-tabs" style="width: 100%;">
                              <div class="text-center">
                                  <h2>Danh sách nông sản</h2>
                              </div>
                              <table class="table">
                                  <thead>
                                      <tr>

                                          <th class="text-center">ID</th>
                                          <th>Tên NS</th>
                                          <th>Thông tin</th>
                                          <th class="text-right">Đơn giá</th>
                                          <th class="text-center">Số lượng</th>
                                          <th class="text-center">Hình</th>
                                          <th class="text-right">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>

                                          <td class="text-center">1</td>
                                          <td>Tên nông sản</td>
                                          <td>Thông tin nông sản</td>
                                          <td class="text-right">50.000 VNĐ</td>
                                          <td class="text-center">1</td>
                                          <td class="text-center">...</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" class="btn btn-success">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" class="btn btn-danger">
                                                  <i class="material-icons">delete</i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>


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
