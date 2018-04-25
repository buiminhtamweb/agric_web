<?php
  include_once('config.php');

  if (isset($_POST['idXoa'])) {
  $sql_search = 'DELETE FROM AGRICULTURAL WHERE ID_AGRI = '.$_POST['idXoa'];

  if (mysqli_query($conn, $sql_search)) {
    echo "true";
  };


  }
?>
