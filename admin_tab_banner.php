<!-- cập nhật banner -->
<?php
if (!isset($_COOKIE['ID_USER'])) {
  header("Location: admin_login.php");
}


$uploadOk = 1;
function uploadImg(){
  //Upload hình ảnh
  $globals['uploadOk'] = 1;
  $target_dir = "assets/img_banner/";
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
  if (file_exists($target_file)) {
    echo '<script>
    alert("Lỗi ! Tên banner quảng cáo trùng")
    </script>';
      $uploadOk = 0;
  }
  //Set New File Name
  $newfilename = $_POST["NAME_BANNER"].".".$imageFileType;

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 1000000) {

    echo '<script>
    alert("Lỗi ! File quá lớn. Dung lượng tệp tin phải nhỏ hơn 1Mb")
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
if(isset($_POST["NAME_BANNER"])) {

	$BANNER = uploadImg();;
  // echo $IMG_URL_CUS;
  if (!$BANNER==""){
    $truyvan = "INSERT INTO BANNER VALUES ('".$BANNER."') ";

    if(mysqli_query($conn,$truyvan)){
      echo '<script>
      alert("Đã thêm banner '.$BANNER.' thành công");
      </script>';

    }else{
      echo '<script>
      alert("Lỗi ! Tên banner quảng cáo trùng");
      </script>';
    }
  }
}

//-------------------------Xoa BANNER--------------------------
if (isset($_POST['DELETE_BANNER'])) {
  $sql_delbanner = 'DELETE FROM `BANNER` WHERE BANNER ="'.$_POST['DELETE_BANNER'].'"';
  if(mysqli_query($conn,$sql_delbanner)){
    unlink('assets/img_banner/'.$_POST['DELETE_BANNER']);
    echo '<script>
    alert("Đã Xóa banner '.$_POST['DELETE_BANNER'].'");
    </script>';

  }else{
    echo '<script>
    alert("Lỗi ! Không xóa được '.$_POST['DELETE_BANNER'].'");
    </script>';
  }
}



 ?>

<div class="tab-pane fade" id="tab_banner">
  <!-- View banner -->
  <div class="container">
    <div class="themBanner">

      <div class="text-center" style="color: red;" id="viewErrBanner">

      </div>
      <form onsubmit="return checkNullFormBanner()" action="" method="post" enctype="multipart/form-data">
      <div class="form-group form-file-upload form-file-multiple has-success">
          <input type="file" multiple="" class="inputFileHidden" name="fileToUpload">
          <div class="input-group">
              <input id="fileToUpload" type="text" class="form-control inputFileVisible" placeholder="Upload file...">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-fab btn-round btn-success">
                      <i class="material-icons">attach_file</i>
                  </button>
              </span>
          </div>
      </div>

      <div class="form-group has-success">
        <input id="NAME_BANNER" class="form-control" type="text" name="NAME_BANNER" value="" placeholder="Nhập tên tập tin ...">
      </div>
      <button type="submit" class="btn btn-success">THÊM</button>
    </form>

    </div>
      <div class="text-center">
          <h2>Danh sách banner quảng cáo</h2>
      </div>

      <div class="text-center" id="showLog">

      </div>

      <div  style="width: 100%;" id="viewBanner">
        <?php
        //Kiểm tra đã dăng nhập chưa
        //Lấy dữ liệu BANNER
        if (isset($_COOKIE['ID_USER'])) {
          $sql_banner = 'SELECT BANNER FROM BANNER';
          $rs_banner = mysqli_query($conn,$sql_banner);
          while ($row = mysqli_fetch_array($rs_banner))
          {

            echo '<div class="card card-nav-tabs" style="width: 100%; ">
              <div >
                  <h3 class="row" style="padding-left: 50px; font-weight: bold;" >Tên banner: '.$row['BANNER'].'</h3>
                  <img class="row" style="padding-left: 50px;" src="assets/img_banner/'.$row['BANNER'].'" alt="'.$row['BANNER'].'">
              </div>';

              echo '<div>
                    <form class="text-center " action="" method="post">
                      <button type="submit" class="btn btn-success" name="DELETE_BANNER" value="'.$row['BANNER'].'">Xóa banner</button>
                    </form>
                  </div>
            </div>';


          }
        }

        ?>
      </div>
  </div>
</div>

<script type="text/javascript">
function checkNullFormBanner() {
  var file = document.getElementById("fileToUpload").value;
  var nameFile = document.getElementById("NAME_BANNER").value;
  switch ("") {
    case file:
      document.getElementById("viewErrBanner").innerHTML = "Bạn chưa chọn banner";
      alert("Bạn chưa chọn banner");
      return false;
      break;
    case nameFile:
      document.getElementById("viewErrBanner").innerHTML = "Bạn chưa nhập tên banner";
      alert("Bạn chưa nhập tên banner");
      return false;
      break;

    }

  }
</script>
