<?php
  include "../config.php";

  $id_kategori = $_POST['id_kategori'];
  $nama_kategori  = $_POST['nama_kategori'];

  $mysqli  = "INSERT INTO tbl_kategori (nama_kategori) VALUES ('$nama_kategori')";
  $result  = mysqli_query($conn, $mysqli);

  if ($result) {

    echo "Input berhasil";

    header('location:../../view/supplier/list_kategori.php');

  } else {

    echo "Input gagal";

  }

  mysqli_close($conn);
?>