<!-- //Thêm nông sản mới -->
<?php

$uploadOk = 1;
function uploadImgAgri(){
  //Upload hình ảnh
  $globals['uploadOk'] = 1;
  $target_dir = "assets/img_agric/";
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
    alert("Lỗi ! Nông sản đã tồn tại")
    </script>';
      $uploadOk = 0;
  }

  //Set New File Name
  $newfilename = $_POST["name_agri"].".".$imageFileType;

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 100000) {

    echo '<script>
    alert("Lỗi ! File quá lớn. Dung lượng tệp tin phải nhỏ hơn 100kb")
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



if(isset($_POST["loaiNS"]) &&
	isset($_POST["name_agri"]) &&
	isset($_POST["detail_agri"]) &&
	isset($_POST["nameFile"]) &&
	isset($_POST["price_agri"])&&
	isset($_POST["amount_agri"])){

	$loaiNS = $_POST["loaiNS"];
	$name_agri = $_POST["name_agri"];
	$detail_agri = $_POST["detail_agri"];
  $nameFile = uploadImgAgri();
	$price_agri = $_POST["price_agri"];
	$amount_agri = $_POST["amount_agri"];

  if (!$nameFile==""){
    $truyvan = "INSERT INTO AGRICULTURAL (`ID_KIND`, `NAME_AGRI`, `DETAIL_AGRI`, `IMG_URL_AGRI`, `PRICE_AGRI`, `AMOUNT_AGRI`)
     VALUES ('".$loaiNS."','".$name_agri."','".$detail_agri."','".$nameFile."',".$price_agri.",".$amount_agri.") ";

    if(mysqli_query($conn,$truyvan)){

      echo '<script>
      alert("Đã thêm '.$name_agri.'")
      </script>';

    	// header("Location: admin_control.php");

    }else{
      echo '<script>
      alert("Lỗi ! Không thể thêm nông sản")
      </script>';
    }
  }


}
 ?>

<div class="tab-pane fade" id="tab_addAgri">
    <!-- Product insert form -->

    <div class="text-center" style="color: red;" id="viewErrAddAgric">

    </div>
    <form method="post" action="" onsubmit="return checkNullFormAddAgric()" enctype="multipart/form-data">
        <div class="row" >
            <div style="padding-left: 15px;" >
              Chọn Loại nông sản:
            </div>
            <div style="padding-left: 10px;">
                <select id="loaiNS"  name="loaiNS">
                  <option  value="">Chưa chọn loại nông sản</option>
                  <?php

                  $sqlLoaiNS = 'SELECT * FROM KINDS';
                  $rsLoaiNS = mysqli_query($conn, $sqlLoaiNS);
                  while ($rowLoaiNS = mysqli_fetch_array($rsLoaiNS)) {
                    echo '<option value="'.$rowLoaiNS['ID_KIND'].'">'.$rowLoaiNS['NAME_KIND'].'</option>';
                  }

                   ?>


                </select>
            </div>

        </div>

        <div class="form-group has-success">
            <label for="name_agri"></label>
            <input type="text" class="form-control" id="name_agri" name="name_agri" placeholder="Tên nông sản">
        </div>

        <div class="form-group has-success">
                <label for="detail_agri"></label>
                <textarea class="form-control" id="detail_agri" name="detail_agri" rows="3" placeholder="Thông tin"></textarea>
        </div>

        <!-- File uploader -->
        <div class="form-group form-file-upload form-file-multiple has-success">
            <input name="fileToUpload" type="file" multiple="" class="inputFileHidden">
            <div class="input-group">
                <input type="text" id="nameFile" name="nameFile" class="form-control inputFileVisible" placeholder="Upload file...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-success">
                        <i class="material-icons">attach_file</i>
                    </button>
                </span>
            </div>
        </div>

        <div class="form-group has-success">
                <label for="price_agri"></label>
                <input type="number" class="form-control" id="price_agri" name="price_agri" placeholder="Đơn giá (Nhập theo VND)">
        </div>

        <div class="form-group has-success">
                <label for="amount_agri"></label>
                <input type="number" class="form-control" id="amount_agri" name="amount_agri" placeholder="Số lượng (Nhập theo đơn vị gam)">
        </div>

    <br>
        <button type="submit" class="btn btn-success">THÊM</button>
        <button type="reset" class="btn btn-danger">RESET</button>
    </form>
</div>

<script type="text/javascript">

  function checkNullFormAddAgric() {

    var loaiNS = document.getElementById("loaiNS").value;
    var tenNS = document.getElementById("name_agri").value;
    var thongTin = document.getElementById("detail_agri").value;
    var nameFile = document.getElementById("nameFile").value;
    var donGia = document.getElementById("price_agri").value;
    var soLuong = document.getElementById("amount_agri").value;


    switch ("") {
      case loaiNS:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa chọn loại nông sản";
        alert("Bạn chưa chọn loại nông sản");
        return false;
        break;
      case tenNS:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa nhập tên nông sản";
        alert("Bạn chưa nhập tên nông sản");
        return false;
        break;
      case thongTin:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa nhập thông tin nông sản";
        alert("Bạn chưa nhập thông tin nông sản");
        return false;
        break;
      case nameFile:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa chọn ảnh đại diện cho nông sản";
        alert("Bạn chưa chọn ảnh đại diện cho nông sản");
        return false;
        break;
      case donGia:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa nhập đơn giá";
        alert("Bạn chưa nhập đơn giá");
        return false;
        break;
      case soLuong:
        document.getElementById("viewErrAddAgric").innerHTML = "Bạn chưa nhập số lượng nông sản";
        alert("Bạn chưa nhập số lượng nông sản");
        return false;
        break;

      }

    }

</script>
