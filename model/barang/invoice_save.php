
<?php
  include "../config.php";
  session_start();

  $id_transaksi  =  $_POST['id_transaksi'];
  $idChart = $_POST['id_chart'];
  $pcs = $_POST['pcs'];
  $id_room = $_POST['id_room'];
  $stock_room = $_POST['stock_room'];
  $stock = $stock_room - $pcs;
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
    
    $data3 = "UPDATE tbl_room SET stock_room = '$stock' WHERE id_room = $id_room";
    $result3  = mysqli_query($conn, $data3);

    include "../../laporan-pdf.php";

    header('location:../../home.php');
  } 

  else {

    echo "Input gagal";
    
  }
  mysqli_close($conn);

?>

