<?php

include "../config.php";

$id_barang = $_GET['id_barang'];

$data = "DELETE FROM tbl_barang WHERE id_barang = '$id_barang' " ;
$result  = mysqli_query($conn, $data);

  if ($result) {
      
    $data3 = "DELETE FROM tbl_gambar WHERE id_barang = '$id_barang'";
    $result3  = mysqli_query($conn, $data3);
    echo "Delete berhasil";
    header('location:../../view/barang/list_barang.php');
  } else {
    echo "Delete gagal";
  }
  mysqli_close($conn);
