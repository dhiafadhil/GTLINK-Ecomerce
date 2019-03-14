
<?php
  include "../config.php";
  session_start();

  $id_transaksi  =  $_POST['id_transaksi'];
  $idChart = $_POST['id_chart'];
  $pcs = $_POST['pcs'];
  $id_barang = $_POST['id_barang'];
  $stock = $_POST['stock'];
  $stockBarang = $stock - $pcs;
  $nama_pemesan = $_POST['nama_pemesan'];
  $no_telp = $_POST['no_telp'];
  
  $data = "UPDATE tbl_transaksi SET `status` = 1 WHERE id_transaksi = '$id_transaksi' ";
  $result  = mysqli_query($conn, $data);

  $dataEmail = "SELECT tbl_transaksi.id_user,
                        tbl_user.email
                        FROM tbl_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user 
                WHERE tbl_transaksi.id_transaksi = '$id_transaksi'";
  $resultEmail = mysqli_query($conn,$dataEmail);

  while($row = mysqli_fetch_array($resultEmail)){
    
    $email = $row['email'];
  
  }
  if ($result) {
    
    $data2 = "DELETE FROM tbl_chart WHERE id_chart= '$idChart'";
    $result2 = mysqli_query($conn,$data2);
    
    $data3 = "UPDATE tbl_barang SET stock = '$stockBarang' WHERE id_barang = '$id_barang'";
    $result3  = mysqli_query($conn, $data3);


    include "../../laporan-pdf.php";
    
    echo "Input berhasil";

    header('location:../../view/barang/list_chart.php');

  } 
  else {

    echo "Input gagal";
    
  }
  mysqli_close($conn);

?>

