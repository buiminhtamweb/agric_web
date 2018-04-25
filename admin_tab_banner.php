<!-- cập nhật banner -->
<?php

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
  $newfilename = $_POST["BANNER"].".".$imageFileType;

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
if(isset($_POST["BANNER"])) {

	$BANNER = $_POST["BANNER"];


  echo $IMG_URL_CUS;
  if (!$IMG_URL_CUS==""){
    $truyvan = "INSERT INTO BANNER VALUES ('".$BANNER."') ";

    if(mysqli_query($conn,$truyvan)){
      echo '<script>
      alert("Đã cập nhật banner quảng cáo thành công")
      </script>';

    }else{
      echo '<script>
      alert("Lỗi ! Tên banner quảng cáo trùng")
      </script>';
    }
  }


}

//Lấy dữ liệu BANNER
$sql_banner = 'SELECT BANNER
FROM BANNER';

$rs_banner = mysqli_query($conn,$sql_banner);
 ?>

<div class="tab-pane fade" id="tab_banner">
  <!-- View KQ tìm kiếm -->
  <div class="container">
      <div  style="width: 100%;">
          <div class="text-center">
              <h2>Danh sách banner quảng cáo</h2>
          </div>
          <?php

          //Kiểm tra đã dăng nhập chưa
          if (isset($_COOKIE['ID_USER'])) {

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
