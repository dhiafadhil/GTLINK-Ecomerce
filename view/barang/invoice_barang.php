
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

$query = "SELECT    tbl_barang.id_barang,
                    tbl_barang.nama_barang,
                    tbl_barang.harga,
                    tbl_barang.id_kategori,
                    tbl_detailTransaksi.kategori,
                    tbl_detailTransaksi.pcs,
                    tbl_detailTransaksi.nama_pemesan,
                    tbl_detailTransaksi.no_hp,
                    tbl_chart.jumlah,
                    tbl_chart.start_tanggal,
                    tbl_chart.end_tanggal,
                    tbl_transaksi.status,
                    tbl_transaksi.no_invoice,
                    tbl_barang.stock,
                    tbl_chart.total,
                    tbl_chart.id_chart,
                    tbl_transaksi.id_transaksi
FROM tbl_detailTransaksi
        INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_detailTransaksi.id_barang
        INNER JOIN tbl_chart ON tbl_chart.id_chart = tbl_detailTransaksi.id_chart
        INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
        WHERE tbl_transaksi.status = 0 AND tbl_chart.id_chart = $id 
        GROUP BY tbl_transaksi.no_invoice";
$data  = mysqli_query($conn, $query);

while ($rowStatus = mysqli_fetch_array($data)){

    $idChart = $rowStatus['id_chart'];
    $nama_barang = $rowStatus['nama_barang'];
    $nama_kategori = $rowStatus['kategori'];
    $harga = $rowStatus['harga'];
    $total_bayar = $rowStatus['total'];
    $jumlah = $rowStatus['jumlah'];
    $pcs = $rowStatus['pcs'];
    $start = $rowStatus['start_tanggal'];
    $end = $rowStatus['end_tanggal'];
    $status = $rowStatus['status'];
    $no_invoice = $rowStatus['no_invoice'];
    $id_transaksi = $rowStatus['id_transaksi'];
    $kategori = $rowStatus['id_kategori'];
    $stock = $rowStatus['stock'];
    $id_barang = $rowStatus['id_barang'];
    $nama_pemesan = $rowStatus['nama_pemesan'];
    $no_telp = $rowStatus['no_hp'];

}

$no=1;
$date = date('dmY');
$date2 = date('l,d-m-Y');

?>
</head>
<body class="animsition">

<?php if($stock > $pcs){
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
                                                <h3 class="text-left title-2">
                                                    <h3 class="text-right title-2"><?php echo $date2;?></h3>
                                                    <?php if($stock < $pcs){ 
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
                                                </h3>
                                            </div>
                                            <hr>
                                            <form action="../../model/barang/invoice_barang.php" method="post" novalidate="novalidate">
                                                <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                                    <table class="table table-responsive-data2" style="font-size:15.5px;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Nama</th>
                                                                <th class="text-center">Kategori</th>
                                                                <th class="text-center">Quantitiy</th>
                                                                <th class="text-center">Tanggal Booking</th>
                                                                <th class="text-center">Nama Pemesan</th>
                                                                <th class="text-center">No Telp</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="tr-shadow">
                                                                <td class="text-center">
                                                            <?php echo $no++;; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $nama_barang; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $nama_kategori; ?>
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
                                                    <input type="hidden" name="stock" value=<?php echo $stock;?>>
                                                    <input type="hidden" name="id_barang" value=<?php echo $id_barang;?>>
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
    </div>
<?php
include "../../js/page3.php";
?>
</body>
</html>
<?php
mysqli_close($conn);
?>