<?php
session_start();
include "../../function.php";
include "../config.php";

$id = $_GET['id'];

$data = "DELETE FROM tbl_user WHERE id_user =$id" ;
$result  = mysqli_query($conn, $data);

  if ($result) {
  	create_validasi (
  	"Sukses",
    "Delete berhasil",
    "../../view/user/list_user.php");
    
  } else {
  
    echo "Delete gagal";
    
  }
  clearstatcache();
  mysqli_close($conn);
?>