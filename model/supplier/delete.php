<?php

include "../config.php";

$id_kategori = $_GET['id_kategori'];

$data = "DELETE FROM tbl_kategori WHERE id_kategori =$id_kategori" ;
$result  = mysqli_query($conn, $data);

  if ($result) {

    echo "Delete berhasil";
    header('location:../../view/supplier/list_kategori.php');

  } else {

    echo "Delete gagal";

  }

  mysqli_close($conn);

