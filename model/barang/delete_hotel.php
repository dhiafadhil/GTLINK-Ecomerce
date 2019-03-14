<?php
// include database connection file
include "../config.php";
// Get id from URL to delete that user
$id_hotel = $_GET['id_hotel'];
// Delete user row from table based on given id
$querySelectIdHotel = "SELECT id_room FROM tbl_room WHERE id_hotel = '$id_hotel'";
$resutSelect = mysqli_query($conn,$querySelectIdHotel);

while($row = mysqli_fetch_array($resutSelect)){

  $id_room = $row['id_room'];
}
$data = "DELETE FROM tbl_hotel WHERE id_hotel = '$id_hotel'" ;
$result  = mysqli_query($conn, $data);

  if ($result) {

    $data2 = "DELETE FROM tbl_room WHERE id_hotel = '$id_hotel'" ;
    $result2  = mysqli_query($conn, $data2);

    $data3 = "DELETE FROM tbl_gambar WHERE id_barang = $id_room ";
    $result3  = mysqli_query($conn, $data3);
    $path =  "../../images/".$data;
    
   if (file_exists($path)) {
    @unlink($path);
   INPUT_GET['id_gambar'];
    
  
  }
  echo "Delete berhasil";
  header('location:../../view/barang/list_hotel.php');
}
  else {
    echo "Delete gagal";
  }
  mysqli_close($conn);
