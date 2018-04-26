<?php
include_once('config.php');

if (isset($_POST['KEYWORD'])) {
  $sql_search = 'SELECT * FROM AGRICULTURAL WHERE NAME_AGRI LIKE "%'.$_POST['KEYWORD'].'%" LIMIT 20';

  $rs_search = mysqli_query($conn, $sql_search);

  while ($a =  mysqli_fetch_array($rs_search)) {



    echo '<form id="'.$a['ID_AGRI'].'" action="" method="post" >

          <tr>
            <input type="hidden" id="idNS" name="idNS" value="'.$a['ID_AGRI'].'" form="'.$a['ID_AGRI'].'"></input>
            <input type="hidden" id="giaCu" name="giaCu" value="'.$a['PRICE_AGRI'].'" form="'.$a['ID_AGRI'].'"></input>
            <td class="text-center">'.$a['ID_AGRI'].'</td>
            <td>'.$a['NAME_AGRI'].'</td>
            <td>'.$a['DETAIL_AGRI'].'</td>
            <td class="text-right">
              <input class="form-control text-right" type="text" name="gia" value="'.$a['PRICE_AGRI'].'" form="'.$a['ID_AGRI'].'">

            </td>
            <td class="text-center">
              <input class="form-control text-center" type="text" name="sluong" value="'.$a['AMOUNT_AGRI'].'" form="'.$a['ID_AGRI'].'">

            </td>
            <td class="td-actions text-right">
                <button type="submit" rel="tooltip" class="btn btn-success" form="'.$a['ID_AGRI'].'"> Cập nhật
                    <i class="material-icons">edit</i>
                </button>

                <button onclick="xoaNS('.$a['ID_AGRI'].')" type="button" rel="tooltip" class="btn btn-danger" form="'.$a['ID_AGRI'].'"> Xóa
                    <i class="material-icons">delete</i>
                </button>
            </td>
        </tr>

        </form>';

  }


}
?>
