
<?php
  session_start();
  include "../../function.php";
  include "../config.php";

  $id_bank = $_GET['id_bank'];
  $nama_bank  = $_POST['nama_bank'];
  $atas_nama  = $_POST['atas_nama'];
  $no_rekening  = $_POST['no_rekening'];
  $data = "UPDATE tbl_bank SET nama_bank='$nama_bank',atas_nama='$atas_nama',no_rekening='$no_rekening' WHERE id_bank=$id_bank";
  $result  = mysqli_query($conn, $data);
 

    if ($result) {
        create_validasi(
        "Sukses",
        "Update data berhasil",
        "../../view/bank/list_bank.php");
  
    } else {

      echo "Input gagal";

    }
    
    mysqli_close($conn);
?>