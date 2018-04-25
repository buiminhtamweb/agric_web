<?php

if (!isset($_COOKIE['ID_USER'])) {
  header("Location: admin_login.php");
}

if (isset($_POST['gia'])&&$_POST['giaCu']) {
  $sql_upGia = 'UPDATE AGRICULTURAL SET PRICE_AGRI = '.$_POST['gia'].' WHERE ID_AGRI = '.$_POST['idNS'];
  $sql_ghiLSCapNhat = 'INSERT INTO AGRICULTURAL(`ID_USER`, `ID_AGRI`, `OLD_PRICE`)
  VALUES ("'.$_SESSION['ID_USER'].'",'.$_POST['idNS'].','.$_POST['giaCu'].')';

  if (mysqli_query($conn, $sql_search)) {
      echo '<script>
      alert("Giá Nông sản đã được cập nhật")
      </script>';
  };
}


if (isset($_POST['sluong'])) {
  $sql_upSLuong = 'UPDATE AGRICULTURAL SET AMOUNT_AGRI = '.$_POST['sluong'].' WHERE ID_AGRI = '.$_POST['idNS'];
  if (mysqli_query($conn, $sql_upSLuong)) {
    echo '<script>
    alert("Số lượng Nông sản đã được cập nhật")
    </script>';
  };
}

 ?>

<!-- Chỉnh sửa nông sản -->
<div class="tab-pane fade" id="tab_editAgri">
  <!-- Tìm kiếm nông sản -->
  <div class="input-group" style="padding-left: 200px; padding-right: 200px;">
    <input type="text" class="form-control" id="inputTimkiem" value="" placeholder="Nhập tên nông sản">
    <button class="btn btn-success " onclick="timKiemNS()">Tìm kiếm</button>
  </div>
  <!-- View KQ tìm kiếm -->
  <div class="container">
      <div class="card card-nav-tabs" style="width: 100%;">
          <div class="text-center">
              <h2>Kết quả tìm kiếm</h2>
          </div>
          <table class="table">
              <thead>
                  <tr>

                      <th class="text-center">ID</th>
                      <th>Tên NS</th>
                      <th>Thông tin</th>
                      <th class="text-right">Đơn giá (VND)</th>
                      <th class="text-center">Số lượng trong kho (gam)</th>
                      <th class="text-right">Actions</th>
                  </tr>
              </thead>
              <tbody id="result_search">


              </tbody>
          </table>
      </div>
  </div>
</div>

<script>

function timKiemNS() {
  // alert("aaaaaaaaaaa");
  var inputTimkiem = document.getElementById('inputTimkiem').value;

  if (inputTimkiem!="") {
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "") {
            document.getElementById("result_search").innerHTML = "Không tìm thấy nông sản!"
          }else {
            document.getElementById("result_search").innerHTML = this.responseText;
          }
        }
    };
    xmlhttp1.open("POST", "admin_tab_editAgri_search.php", true);
    xmlhttp1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp1.send("MAIN=0&KEYWORD="+inputTimkiem);
  }else {
    document.getElementById("result_search").innerHTML = "Bạn chưa nhập từ khóa tìm kiếm"
  }

}



function xoaNS(idXoa) {
  // alert("aaaaaaaaaaa");
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "true") {

            alert("Đã xóa "+idXoa);
            timKiemNS();
          }else {
            alert("Lỗi !");
          }
        }
    };
    xmlhttp1.open("POST", "admin_tab_editAgri_delete.php", true);
    xmlhttp1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp1.send("&idXoa="+idXoa);


}

</script>
