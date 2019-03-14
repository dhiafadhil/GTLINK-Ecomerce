<?php
    include "../config.php";

  $id_room = $_POST['id_room'];
  $id_hotel = $_POST['id_hotel'];
  $stock  = $_POST['stock'];
  $harga  = str_replace(",","",$_POST['harga']);

  $data = "UPDATE tbl_room SET  harga_room='$harga',
                                stock_room='$stock' 
                                WHERE id_room = $id_room";
  $result  = mysqli_query($conn, $data);
    
  if($result){  
  
    echo "Input berhasil";
    
    header('location:../../view/barang/list_room.php?id_hotel='.$id_hotel);
    
  } else {

    echo "Ups Coba Chek Lagi";
  
  }
      mysqli_close($conn);
    ?>