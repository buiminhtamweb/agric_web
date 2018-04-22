<!-- Tab Duyệt đơn hàng -->
<?php

if (isset($_POST['ID_ORDERING'])) {

}


  $sql_ordering = 'SELECT o.ID_ORDER, o.DATE_ORDER , o.TOTAL_ORDER
    FROM ORDERS as o
    LEFT JOIN bill as b ON o.ID_ORDER = b.ID_ORDER
    WHERE b.ID_ORDER IS NULL
    AND o.USERNAME_CUS = "'.$_SESSION['USERNAME_CUS'].'"
    ORDER BY o.DATE_ORDER DESC';

  $rs_ordering = mysqli_query($conn,$sql_ordering);


   ?>

  <div class="tab-pane fade show active" id="tab_ordering">
    <div class="container">
      <div class="text-center">
          <h2>Danh sách đơn hàng</h2>
      </div>

      <?php

      //Kiểm tra đã dăng nhập chưa
      if (isset($_COOKIE['USERNAME_CUS'])) {

        while ($row = mysqli_fetch_array($rs_ordering))
        {
          $sqlNS_HD = "SELECT ao.ID_AGRI ,a.NAME_AGRI , ao.NUM_OF_AGRI, ao.CURRENT_PRICE
        	FROM AGRI_ORDER as ao
          JOIN AGRICULTURAL a ON a.ID_AGRI=ao.ID_AGRI
        	WHERE ao.ID_ORDER = '" . $row['ID_ORDER'] . "'";

          $rs_ns_hd = mysqli_query($conn,$sqlNS_HD);


          echo '<div class="card card-nav-tabs" style="width: 100%; ">
            <div >
                <h3 class="row" style="padding-left: 50px; font-weight: bold;" >Mã đơn hàng: '.$row['ID_ORDER'].'</h3>
                <h4 class="row" style="padding-left: 50px;">Ngày mua: '.$row['DATE_ORDER'].'</h4>

            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Tên NS</th>
                        <th class="text-right">Đơn giá</th>
                        <th class="text-center">Số lượng mua</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';
                while ($row_ns_hd = mysqli_fetch_array($rs_ns_hd))
                {

                  //Tính thành tiền
                  $thanhTien = $row_ns_hd['NUM_OF_AGRI']*$row_ns_hd['CURRENT_PRICE']/1000;

                  //Qui đổi số lượng mua
                  if ($row_ns_hd['NUM_OF_AGRI']>1000) {
                    $slMua = $row_ns_hd['NUM_OF_AGRI']/1000+ "Kg";
                  }else {
                    $slMua = $row_ns_hd['NUM_OF_AGRI']+ "g";
                  }


                echo '<tr>
                    <td class="text-center">'.$row_ns_hd['ID_AGRI'].'</td>
                    <td>'.$row_ns_hd['NAME_AGRI'].'</td>
                    <td class="text-center">'.$row_ns_hd['CURRENT_PRICE'].' VNĐ</td>
                    <td class="text-center">'.$row_ns_hd['NUM_OF_AGRI'].'</td>
                    <td class="text-center">'.$thanhTien.' VND</td>
                </tr>';

                  }
            echo '</tbody>
                </table>
                <div >
                  <h3 class="text-right " style="padding-right: 50px; color: red; ">Tổng đơn hàng: '.$row['TOTAL_ORDER'].'</h3>

                </div>

                <div>
                  <form class="text-right " action="" method="post">
                    <button type="submit" class="btn btn-success" name="ID_ORDERING" value="'.$row['ID_ORDER'].'">Hủy đơn hàng</button>
                  </form>
                </div>

          </div>';


        }
      }

       ?>
    </div>
  </div>
