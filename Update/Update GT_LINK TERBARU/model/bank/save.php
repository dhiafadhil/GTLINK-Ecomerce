<?php
   session_start();
  include "../../function.php";
  include "../config.php";

  $id_bank = $_POST['id_bank'];
  $id_profile = $_POST['id_profile'];
  $nama_bank  = $_POST['nama_bank'];
  $atas_nama = $_POST['atas_nama'];
  $no_rekening = $_POST['no_rekening'];

  $mysqli  = "INSERT INTO tbl_bank (id_profile,nama_bank,atas_nama,no_rekening) VALUES ('$id_profile','$nama_bank','$atas_nama','$no_rekening')";
  $result  = mysqli_query($conn, $mysqli);

  if ($result) {
      create_validasi(
        "Sukses",
        "Input data berhasil",
        "../../view/bank/list_bank.php");

  } else {

    echo "Input gagal";

  }

  mysqli_close($conn);
?>