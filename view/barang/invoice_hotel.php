
<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if (empty($_SESSION['level'])){

header("location:../../view/user/login.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

// ini untuk isi data
$id = $_GET['id'];

$query2 = "SELECT   tbl_detailTransaksi.harga,
                    tbl_detailTransaksi.kategori,
                    tbl_detailTransaksi.start_tanggal,
                    tbl_detailTransaksi.end_tanggal,
                    tbl_detailTransaksi.kategori,
                    tbl_detailTransaksi.nama_pemesan,
                    tbl_detailTransaksi.no_hp,
                    tbl_hotel.nama_hotel,
                    tbl_transaksi.total_bayar,
                    tbl_transaksi.status,
                    tbl_kategori.id_kategori,
                    tbl_user.nama_user,
                    tbl_user.lokasi,
                    tbl_detailTransaksi.id_transaksi,
                    tbl_chart.total,
                    tbl_chart.id_chart,
                    tbl_chart.jumlah,
                    tbl_chart.pcs,
                    tbl_transaksi.no_invoice,
                    tbl_room.stock_room,
                    tbl_room.id_room
FROM tbl_detailTransaksi
    INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
    INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
    INNER JOIN tbl_transaksi ON tbl_detailTransaksi.id_transaksi = tbl_transaksi.id_transaksi
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
    INNER JOIN tbl_chart ON tbl_detailTransaksi.id_chart = tbl_chart.id_chart
WHERE tbl_transaksi.status = 0 AND tbl_chart.id_chart = $id
    GROUP BY tbl_transaksi.id_transaksi";
$data2  = mysqli_query($conn, $query2);

while ($rowStatus2 = mysqli_fetch_array($data2)){

    $idChart = $rowStatus2['id_chart'];
    $nama_user = $rowStatus2['nama_user'];
    $nama_barang = $rowStatus2['nama_hotel'];
    $nama_kategori = $rowStatus2['kategori'];
    $harga = $rowStatus2['harga'];
    $total_bayar = $rowStatus2['total'];
    $jumlah = $rowStatus2['jumlah'];
    $pcs = $rowStatus2['pcs'];
    $start = $rowStatus2['start_tanggal'];
    $end = $rowStatus2['end_tanggal'];
    $status = $rowStatus2['status'];
    $no_invoice = $rowStatus2['no_invoice'];
    $id_transaksi = $rowStatus2['id_transaksi'];
    $kategori = $rowStatus2['id_kategori'];
    $id_room = $rowStatus2['id_room'];
    $stock_room = $rowStatus2['stock_room'];
    $nama_pemesan = $rowStatus2['nama_pemesan'];
    $no_telp = $rowStatus2['no_hp'];

    $_SESSION['stock'] = $stock_room;
}

$no=1;
$date = date('dmY');
$date2 = date('l,d-m-Y');
?>
</head>
<body class="animsition">
<?php
if($stock_room >= $pcs){ 
    include "../../menu3.php";
}
?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Invoice</strong>
                                        <small> Gt Link</small>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                    <h3 class="text-right title-2"><?php echo $date2;?> </h3>
                                                        <?php if($stock_room < $pcs){ 
                                                            $_SESSION['stock'] = '<div class ="row">
                                                        <div class="col-sm-12">
                                                        <h4 class="text-left title-2">
                                                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="font-size:13px">
                                                                <span class="badge badge-pill badge-danger">Attention</span>
                                                                    Stock Tidak Mencukupi, Silahkan Hubungi Supplier  
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×
                                                                    </button>
                                                                    </div>
                                                                </h4>
                                                            </div>
                                                            </div>';
                                                            header('location:list_chart.php'); } ?>
                                            </div>
                                            <form action="../../model/barang/invoice_save.php" method="post" novalidate="novalidate">
                                                <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                                    <table class="table table-responsive-data2" style="font-size:15.5px;">
                                                    <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Nama</th>
                                                                <th class="text-center">Kategori</th>
                                                                <th class="text-center">Quantity</th>
                                                                <th class="text-center">Booking</th>
                                                                <th class="text-center">Pemesan</th>
                                                                <th class="text-center">No Telp</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="tr-shadow">
                                                                <td class="text-center">
                                                            <?php echo $no++;; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $nama_barang ; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $nama_kategori ; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $pcs ; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo "$start - $end"; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo "$nama_pemesan"; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo "$no_telp"; ?>
                                                            </td>
                                                            </tr>
                                                            <tr class="spacer"></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="keterangan" class="keterangan">No Invoice</label>
                                                            <h3 class="text-left title-2"><?php echo $no_invoice; ?></h3>
                                                                </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="total_invoice" class="total_invoice">Total
                                                                </label>
                                                                <h3 class="text-left title-2"><?php echo number_format($total_bayar)?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div> 
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                        <i class="fas fa-check"></i>&nbsp;
                                                        <span id="payment-button-amount"></span>Confirm</span>
                                                    </button>
                                                    
                                                    <input type="hidden" name="id_chart" value=<?php echo $idChart;?>>
                                                    <input type="hidden" name="total" value=<?php echo $total_bayar;?>>
                                                    <input type="hidden" name="status" value=<?php echo $status;?>>
                                                    <input type="hidden" name="id_transaksi" value=<?php echo $id_transaksi;?>>
                                                    <input type="hidden" name="pcs" value=<?php echo $pcs;?>>
                                                    <input type="hidden" name="stock_room" value=<?php echo $stock_room;?>>
                                                    <input type="hidden" name="id_room" value=<?php echo $id_room;?>>
                                                    <input type="hidden" name="nama_pemesan" value=<?php echo $nama_pemesan;?>>
                                                    <input type="hidden" name="no_telp" value=<?php echo $no_telp;?>>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "../../js/page3.php";
?>
</body>
</html>
<?php
mysqli_close($conn);
?>