<?php
    include "../config.php";

    $id_barang = $_GET['id_barang'];
    $id_user  = $_POST['id_user'];
    $id_kategori = $_POST['id_kategori'];
    $nama_barang  = $_POST['nama_barang'];
    $stock  = $_POST['stock'];
    $harga  = str_replace(",","",$_POST['harga']);
    $keterangan  = $_POST['keterangan'];

    if($id_kategori != 4){
      $data = "UPDATE tbl_barang SET  id_kategori='$id_kategori',
                                      nama_barang='$nama_barang',
                                      stock='$stock', 
                                      harga='$harga', 
                                      `keterangan`='$keterangan'
                                      WHERE id_barang = '$id_barang' ";
      $result  = mysqli_query($conn, $data);

      echo "Input berhasil";

      header('location:../../view/barang/list_barang.php');
    } 

    else {

      echo "Ups Coba Chek Lagi";
      
    }
    mysqli_close($conn);
    ?>