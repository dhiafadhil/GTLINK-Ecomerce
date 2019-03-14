<?php
session_start();
include "../../function.php";
include "../config.php";

$id_bank = $_GET['id_bank'];

$data = "DELETE FROM tbl_bank WHERE id_bank =$id_bank" ;
$result  = mysqli_query($conn, $data);

  if ($result) {
  	create_validasi(
    "Sukses",
    "Delete berhasil",
    "../../view/bank/list_bank.php");

  } else {

    echo "Delete gagal";

  }

  mysqli_close($conn);

?>