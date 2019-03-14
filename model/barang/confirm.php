
<?php
  include "../config.php";
  session_start();

  $id_chart = $_POST['id_chart'];
  $id_user  =  $_SESSION['id_user'];
  $id_barang = $_POST['id_barang'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $pcs = $_POST['pcs'];
  $nama= $_POST['nama_barang'] ;
  $total = $_POST['total'];
  $kategori = $_POST['nama_kategori'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $no_invoice = $_POST['no_invoice'];
  $nama_pemesan = $_POST['nama_pemesan'];
  $no_telp = $_POST['no_telp'];

$queryBarang = "SELECT stock FROM tbl_barang WHERE id_barang = '$id_barang'";
$resultBarang = mysqli_query($conn,$queryBarang);
$getStock = mysqli_fetch_assoc($resultBarang);

if($resultBarang){

  if($getStock['stock'] < $pcs){

  $_SESSION['stock'] = '<div class ="row">
                  <div class="col-sm-12">
                  <h4 class="text-left title-2">
                      <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="font-size:13px">
                          <span class="badge badge-pill badge-danger">Attention</span>
                              Maaf,Stock Tidak Mencukupi :(
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">×
                              </button>
                              </div>
                          </h4>
                      </div>
                      </div>';
                      header('location:../../view/barang/listChart_user.php'); 
  } else {

  $data = "UPDATE tbl_chart SET `status` = 1 WHERE id_chart = '$id_chart'";
  $result  = mysqli_query($conn, $data);

  }
}


if ($result ==  TRUE ) {
    $mysqli  = "INSERT INTO tbl_transaksi 
                            (no_invoice,
                            id_user,
                            nama,
                            total_bayar) 
                VALUES ('$no_invoice',
                        '$id_user',
                        '$nama',
                        '$total')";
    $result2 = mysqli_query($conn,$mysqli);
  }
  
  if ($result2) {
  $insert = "SELECT id_transaksi FROM tbl_transaksi WHERE id_user = $id_user";
  
  $insertResult = mysqli_query($conn,$insert);
  
  while ($r = mysqli_fetch_array($insertResult))

  {

    $id_transaksi = $r['id_transaksi'];

  }

    $mysqli2  = "INSERT INTO tbl_detailTransaksi 
                              (id_transaksi,
                                id_chart,
                                id_barang,
                                harga,
                                pcs,
                                kategori,
                                start_tanggal,
                                end_tanggal,
                                nama_pemesan,
                                no_hp) 
                VALUES ('$id_transaksi',
                        '$id_chart',
                        '$id_barang',
                        '$harga',
                        '$pcs',
                        '$kategori',
                        '$start',
                        '$end',
                        '$nama_pemesan',
                        '$no_telp')";
    $result3 = mysqli_query($conn,$mysqli2);
    header('location:../../view/barang/listChart_user.php');
} else {
    echo "Input gagal";
}
mysqli_close($conn);
  
?>
