<?php

include "../config.php";

$id_room = $_GET['id_room'];
$id_hotel = $_GET['id_hotel'];

$data2 = "DELETE FROM tbl_room WHERE id_room = $id_room" ;
$result2  = mysqli_query($conn, $data2);

  if ($result2) {
    $sqli2 = "DELETE FROM tbl_gambar WHERE id_barang = $id_room" ;
    $query2 = mysqli_query($conn, $sqli2);
    $path =  "../../images/".$data['gambar'];
    echo "Delete berhasil";
    header('location:../../view/barang/list_room.php?id_hotel='.$id_hotel);
  } else {
    echo "Delete gagal";
  }
  mysqli_close($conn);
