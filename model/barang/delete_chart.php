<?php
include "../config.php";
$id = $_GET['id'];

$data = "DELETE FROM tbl_chart WHERE id_chart = $id" ;
$result  = mysqli_query($conn, $data);

  if ($result) {
    echo "Delete berhasil";
    
    header('location:../../view/barang/listChart_user.php');
    
  } else {
    echo "Delete gagal";
  }
  mysqli_close($conn);
