<?php

include "../config.php";


$id_chart = $_GET['id_chart'];

$data = "DELETE FROM tbl_chart WHERE id_chart = $id_chart" ;
$result  = mysqli_query($conn, $data);

$transaksi = "SELECT id_transaksi FROM tbl_detailTransaksi WHERE id_chart = $id_chart";
$resultTransaksi = mysqli_query($conn, $transaksi);

while($row = mysqli_fetch_array($resultTransaksi)){

  $id_transaksi = $row['id_transaksi'];
}

  if ($result == true ) {

    $data2 = "DELETE FROM tbl_detailTransaksi WHERE id_chart = $id_chart" ;
    $result2  = mysqli_query($conn, $data2);
  
    
  } 
  if ($result2 == true){

    $data3 =  "DELETE FROM tbl_transaksi WHERE id_transaksi = $id_transaksi" ;
    $result3  = mysqli_query($conn, $data3);

  }
  if ($result3 == true){

    echo "Delete berhasil";
    header('location:../../view/barang/list_chart.php');

  
  }

  else{
    echo "Delete gagal";
  }
  mysqli_close($conn);
