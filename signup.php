<?php
#Connect to MySQL
session_start();

include_once("config.php");
$uploadOk = 1;
function uploadImg(){
  //Upload hình ảnh
  $globals['uploadOk'] = 1;
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["fileToUpload"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          $globals['uploadOk'] = 1;
      } else {
          $globals['uploadOk'] = 0;
      }
  }
  // Check if file already exists
  // if (file_exists($target_file)) {
  //     echo "Sorry, file already exists.";
  //     $uploadOk = 0;
  // }

  //Set New File Name
  $timestamp = time();
  $newfilename = $timestamp.(rand(10,99)).$_POST["USERNAME_CUS"].".".$imageFileType;

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {

    echo '<script>
    alert("Lỗi ! File quá lớn. Dung lượng tệp tin phải nhỏ hơn 500kb")
    </script>';
    $globals['uploadOk'] = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {

    echo '<script>
    alert("Lỗi ! Không đúng định dạng tập tin ảnh")
    </script>';
      $globals['uploadOk'] = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($globals['uploadOk'] == 0) {
  // if everything is ok, try to upload file
          return "";
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
          return $newfilename;
      } else {
          return "";
      }
  }
}

//Truy van
  // var_dump($_FILES["fileToUpload"]["name"]);
if(isset($_POST["USERNAME_CUS"]) &&
	isset($_POST["PASSWORD_CUS"]) &&
	isset($_POST["FULLNAME_CUS"]) &&
	isset($_POST["SEX"]) &&
	isset($_POST["BIRTHDAY"])&&
	isset($_POST["TEL_CUS"])&&
	isset($_POST["ADDRESS_CUS"])) {



	$USERNAME_CUS = $_POST["USERNAME_CUS"];
	$PASSWORD_CUS = $_POST["PASSWORD_CUS"];
	$FULLNAME_CUS = $_POST["FULLNAME_CUS"];
	$SEX = $_POST["SEX"];
	$BIRTHDAY = $_POST["BIRTHDAY"];
	$IMG_URL_CUS = uploadImg();
	$TEL_CUS = $_POST["TEL_CUS"];
	$ADDRESS_CUS = $_POST["ADDRESS_CUS"];

  echo $IMG_URL_CUS;
  if (!$IMG_URL_CUS==""){
    $truyvan = "INSERT INTO CUSTOMER VALUES ('".$USERNAME_CUS."','".$PASSWORD_CUS."','".$FULLNAME_CUS."','".$SEX."','".$BIRTHDAY."','".$IMG_URL_CUS."','".$TEL_CUS."','".$ADDRESS_CUS."') ";

    if(mysqli_query($conn,$truyvan)){
    	header("Location: signup_viewSuccess.php");

    }else{
      echo '<script>
      alert("Lỗi ! Tên dăng nhập đã tồn tại")
      </script>';
    }
  }


}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <title>Agric Shop - Đăng ký</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/material-kit.css" rel="stylesheet">
    <link href="./assets/css/vertical-nav.css" rel="stylesheet" />
</head>

<body class="signup-page ">
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent bg-success" color-on-scroll="100"
        style="min-width: 1024px;">
        <div class="container">
            <a class="navbar-brand" href="../agric/index.php">
                <i class="material-icons">spa</i>
            </a>
            <!-- Search form -->
            <form class="form-inline">
                <div class="form-group has-white" style="padding-left: 200px;">
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
                        <a class="nav-link" href="../agric/login.html">
                            <i class="material-icons">account_circle</i>
                            Đăng nhập
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="page-header header-filter" filter-color="green" style="background-image: url('assets/img/signup-bg.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                    <div class="card card-signup">
                        <h2 class="card-title text-center">Đăng ký</h2>
                        <div class="card-body">
                          <?php
                          if ($uploadOk==0) {
                            echo "Lỗi Upload hình ảnh ! Lưu ý: Tệp tin hình ảnh phải dưới 500Kb";
                          }
                           ?>
                          <p class="text-center" id = "showError" style="color:red;"></p>
                          <!-- From Nhập thông tin -->
                            <form name="formInfo" enctype="multipart/form-data" action="" onsubmit="return validateForm()" method="POST">
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="text-left">
                                            <h4> Thông tin tài khoản </h4>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Tên tài khoản"
                                                name="USERNAME_CUS" onfocusout="checkUsername()">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" placeholder="Mật khẩu" class="form-control" name="PASSWORD_CUS"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5 mr-auto">
                                        <div class="text-left">
                                            <h4> Thông tin cá nhân </h4>
                                        </div>

                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">create</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Họ tên đầy đủ" name="FULLNAME_CUS">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">wc</i>
                                                </span>
                                                <select class="form-control" name="SEX">
                                                    <option>Giới tính</option>
                                                    <option value='Nam'>Nam</option>
                                                    <option value='Nữ'>Nữ</option>
                                                    <option value='Khác'>Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">event</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Ngày sinh: 2000-31-12" name="BIRTHDAY"/>
                                            </div>
                                        </div>
                                        <div class="form-group form-file-upload form-file-simple has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">portrait</i>
                                                </span>
                                                <input type="text" class="form-control inputFileVisible" placeholder="Ảnh đại diện..." name="IMG_URL_CUS">
                                                <input type="file" class="inputFileHidden" name="fileToUpload" id="fileToUpload">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Số điện thoại" name="TEL_CUS">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">location_city</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Địa chỉ" name="ADDRESS_CUS">
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="check" name="checkBox">
                                                <span class="form-check-sign">
                                                    <span class="check"> </span>
                                                </span>
                                                Tôi xin xác nhận thông tin trên
                                                <font style="color: #4CAF50">hoàn toàn Chính chủ.</font>
                                            </label>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-round" name="submit">ĐĂNG KÝ</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!-- javascript for init -->
    <!-- JavaScript -->
    <script>

    function validateForm() {
        var userName = document.forms["formInfo"]["USERNAME_CUS"].value;
        var pass = document.forms["formInfo"]["PASSWORD_CUS"].value;
        var fullname = document.forms["formInfo"]["FULLNAME_CUS"].value;
        var sex = document.forms["formInfo"]["SEX"].value;
        var birthday = document.forms["formInfo"]["BIRTHDAY"].value;
        var file = document.forms["formInfo"]["fileToUpload"].value;
        var tel = document.forms["formInfo"]["TEL_CUS"].value;
        var address = document.forms["formInfo"]["ADDRESS_CUS"].value;
        var check = document.forms["formInfo"]["checkBox"].checked;






        //Kiểm tra tên đăng nhập và mật khảu
        switch ("") {
          case userName:
            document.getElementById("showError").innerHTML = "Bạn chưa nhập tên đăng nhập!";
            alert("Bạn chưa nhập tên đăng nhập!");
            return false;
            break;
          case pass:
            document.getElementById("showError").innerHTML = "Bạn chưa nhập mật khẩu!";
            alert("Bạn chưa nhập mật khẩu!");
            return false;
            break;
          }

          //Kiểm tra mật khẩu
          if (pass.length<5) {
            document.getElementById("showError").innerHTML = "Mật khẩu phải dài từ 5 ký tự";
            alert("Mật khẩu phải dài từ 5 ký tự");
            return false;
          }

          //Kiểm tra gioi tinh
          if (sex=="Giới tính"){
            document.getElementById("showError").innerHTML = "Bạn chưa chọn giới tính";
            alert("Bạn chưa chọn giới tính");
            return false;
          }


        //Kiem tra các trường còn lại
        switch ("") {
          case fullname:
            document.getElementById("showError").innerHTML = "Bạn chưa nhập họ tên!";
            alert("Bạn chưa nhập họ tên!");
            return false;
            break;
          case birthday:
            document.getElementById("showError").innerHTML = "Bạn chưa chọn ngày sinh!";
            alert("Bạn chưa chọn ngày sinh!");
            return false;
            break;
          case file:
            document.getElementById("showError").innerHTML = "Bạn chưa chọn ảnh đại diện!";
            alert("Bạn chưa chọn ảnh đại diện!");
            return false;
            break;
          case tel:
            document.getElementById("showError").innerHTML = "Bạn chưa nhập số điện thoại!";
            alert("Bạn chưa nhập số điện thoại!");
            return false;
            break;
          case address:
            document.getElementById("showError").innerHTML = "Bạn chưa nhập địa chỉ!";
            alert("Bạn chưa nhập địa chỉ!");
            return false;
            break;
        }

        //Kiểm tra Ngày sinh hợp lệ
        function isValidDate(s) {
          var bits = s.split('-');
          var d = new Date(bits[0], bits[1] - 1, bits[2]);
          return d && (d.getMonth() + 1) == bits[1];
        }
        if (!isValidDate(birthday)) {
          document.getElementById("showError").innerHTML = "Ngày nhập vào chưa hợp lệ";
          alert("Ngày nhập vào chưa hợp lệ");
        }

        //Kiểm tra đã tick check chưa
        if (!check) {
          document.getElementById("showError").innerHTML = "Bạn chưa xác nhận thông tin là sự thật";
          alert("Bạn chưa xác nhận thông tin là sự thật");
          return false;
        }





    }



    function checkUsername(){
      //Kiểm tra USer name có tồn tại hay không
      var userName = document.forms["formInfo"]["USERNAME_CUS"].value;
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "true") {
              document.getElementById("showError").innerHTML = "Tên đăng nhập đã có người sử dụng";
              alert("Tên đăng nhập đã có người sử dụng");
            }else {
              document.getElementById("showError").innerHTML = "";
            }
          }
      };
      xmlhttp.open("POST", "android/signin_checkUserName.php" , true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send('USERNAME_CUS='+userName);
    }

        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    </script>

</body>

</html>
