//Thêm nông sản mới
<?php
//
// $uploadOk = 1;
// function uploadImg(){
//   //Upload hình ảnh
//   $globals['uploadOk'] = 1;
//   $target_dir = "assets/img_cus/";
//   $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//
//   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//   // Check if image file is a actual image or fake image
//   if(isset($_POST["fileToUpload"])) {
//       $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//       if($check !== false) {
//           $globals['uploadOk'] = 1;
//       } else {
//           $globals['uploadOk'] = 0;
//       }
//   }
//   // Check if file already exists
//   if (file_exists($target_file)) {
//       echo "Sorry, file already exists.";
//       $uploadOk = 0;
//   }
//
//   //Set New File Name
//   $timestamp = time();
//   $newfilename = $timestamp.(rand(10,99)).$_POST["USERNAME_CUS"].".".$imageFileType;
//
//   // Check file size
//   if ($_FILES["fileToUpload"]["size"] > 500000) {
//
//     echo '<script>
//     alert("Lỗi ! File quá lớn. Dung lượng tệp tin phải nhỏ hơn 500kb")
//     </script>';
//     $globals['uploadOk'] = 0;
//   }
//   // Allow certain file formats
//   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//   && $imageFileType != "gif" ) {
//
//     echo '<script>
//     alert("Lỗi ! Không đúng định dạng tập tin ảnh")
//     </script>';
//       $globals['uploadOk'] = 0;
//   }
//   // Check if $uploadOk is set to 0 by an error
//   if ($globals['uploadOk'] == 0) {
//   // if everything is ok, try to upload file
//           return "";
//   } else {
//       if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
//           return $newfilename;
//       } else {
//           return "";
//       }
//   }
// }
//
// //Truy van
//   // var_dump($_FILES["fileToUpload"]["name"]);
// if(isset($_POST["USERNAME_CUS"]) &&
// 	isset($_POST["PASSWORD_CUS"]) &&
// 	isset($_POST["FULLNAME_CUS"]) &&
// 	isset($_POST["SEX"]) &&
// 	isset($_POST["BIRTHDAY"])&&
// 	isset($_POST["TEL_CUS"])&&
// 	isset($_POST["ADDRESS_CUS"])) {
//
//
//
// 	$USERNAME_CUS = $_POST["USERNAME_CUS"];
// 	$PASSWORD_CUS = $_POST["PASSWORD_CUS"];
// 	$FULLNAME_CUS = $_POST["FULLNAME_CUS"];
// 	$SEX = $_POST["SEX"];
// 	$BIRTHDAY = $_POST["BIRTHDAY"];
// 	$IMG_URL_CUS = uploadImg();
// 	$TEL_CUS = $_POST["TEL_CUS"];
// 	$ADDRESS_CUS = $_POST["ADDRESS_CUS"];
//
//   echo $IMG_URL_CUS;
//   if (!$IMG_URL_CUS==""){
//     $truyvan = "INSERT INTO CUSTOMER VALUES ('".$USERNAME_CUS."','".$PASSWORD_CUS."','".$FULLNAME_CUS."','".$SEX."','".$BIRTHDAY."','".$IMG_URL_CUS."','".$TEL_CUS."','".$ADDRESS_CUS."') ";
//
//     if(mysqli_query($conn,$truyvan)){
//     	header("Location: signup_viewSuccess.php");
//
//     }else{
//       echo '<script>
//       alert("Lỗi ! Tên dăng nhập đã tồn tại")
//       </script>';
//     }
//   }
//
//
// }
 ?>

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
