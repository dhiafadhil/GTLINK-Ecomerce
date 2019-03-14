<?php
    include "../config.php";

    $id_hotel = $_GET['id_hotel'];
    $id_user  = $_POST['id_user'];
    $nama_hotel = $_POST['nama_hotel'];
    $id_kategori = $_POST['id_kategori'];
    $keterangan  = $_POST['keterangan'];
    $status = 0;
    $updated_at= date('Y-m-d');

  if($id_kategori == 4  ){
    $dataH = "UPDATE tbl_hotel SET id_kategori='$id_kategori',
                                    id_user='$id_user',
                                    nama_hotel='$nama_hotel',
                                    keterangan = '$keterangan'
                                    WHERE id_hotel = '$id_hotel'";
    $result  = mysqli_query($conn, $dataH);
    
    header('location:../../view/barang/list_hotel.php');
  } 
  else {
        echo "Ups Coba Chek Lagi";
  }
      mysqli_close($conn);
    ?>