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
$level = $_SESSION['level'];
$id = $_SESSION['id_user'];

//barang
$query ="SELECT tbl_barang.nama_barang,
                tbl_detailTransaksi.harga,
                tbl_detailTransaksi.pcs,
                tbl_detailTransaksi.kategori,
                tbl_detailTransaksi.start_tanggal,
                tbl_detailTransaksi.end_tanggal,
                tbl_detailTransaksi.kategori,
                tbl_transaksi.id_transaksi AS id, 
                tbl_transaksi.status,
                tbl_transaksi.no_invoice,
                tbl_transaksi.total_bayar,
                tbl_user.nama_user,
                tbl_user.lokasi,
                tbl_chart.id_chart
FROM tbl_detailTransaksi
    INNER JOIN tbl_barang ON tbl_detailTransaksi.id_barang = tbl_barang.id_barang
    INNER JOIN tbl_transaksi on tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
    INNER JOIN tbl_chart ON tbl_chart.id_barang = tbl_detailTransaksi.id_barang
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user 
WHERE tbl_transaksi.status = 0 GROUP BY tbl_transaksi.id_transaksi";
$data  = mysqli_query($conn, $query);

//hotel
$queryHotel = "SELECT  tbl_hotel.nama_hotel,
                        tbl_hotel.id_kategori,
                        tbl_detailTransaksi.kategori,
                        tbl_detailTransaksi.harga,
                        tbl_detailTransaksi.start_tanggal,
                        tbl_detailTransaksi.end_tanggal,
                        tbl_transaksi.status,
                        tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_chart.jumlah,
                        tbl_chart.start_tanggal,
                        tbl_chart.end_tanggal,
                        tbl_chart.pcs,
                        tbl_chart.total,
                        tbl_chart.id_user,
                        tbl_chart.id_chart,
                        tbl_room.id_room
            FROM tbl_detailTransaksi
                INNER JOIN tbl_room ON tbl_detailTransaksi.id_barang = tbl_room.id_room
                INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
                INNER join tbl_chart ON tbl_chart.id_chart = tbl_detailTransaksi.id_chart
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
                WHERE tbl_transaksi.status = 0 GROUP BY tbl_transaksi.id_transaksi";
$dataHotel  = mysqli_query($conn, $queryHotel);

//pembeda
$querykategori = "SELECT tbl_kategori.id_kategori FROM tbl_kategori
        INNER JOIN tbl_barang ON tbl_barang.id_kategori = tbl_kategori.id_kategori
        INNER JOIN tbl_chart ON tbl_chart.id_barang = tbl_barang.id_barang";
$dataKat = mysqli_query($conn,$querykategori);

while($kat = mysqli_fetch_array($dataKat)){

    $k = $kat['id_kategori'];

}

$dataHitung = mysqli_query($conn, $query);
$hitung = mysqli_fetch_assoc($dataHitung);
$no=1;
$no2=1;
$statuss = 0;

?>
</head>
<body class="animsition">
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <?php if ($level = 1) { ?>
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                            
                            <?php if(isset($_SESSION['stock']))
                                {
                                echo $_SESSION['stock']; 
                                unset($_SESSION['stock']);
                                }
                                ?>
                                <i class="fas fa-chart-bar"></i></i>Cart</h3>
                            <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table class="table table-responsive-data2" style="font-size:15.5px;" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($data)) {
                                        $startChart = $row['start_tanggal'];
                                        $endChart = $row['end_tanggal'];
                                        $pcsChart = $row['pcs'];
                                        $totalChart = $row['total_bayar'];
                                    ?>
                                    <tr class="tr-shadow">
                                            <td class="text-center">
                                                <?php echo $no++;; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['kategori'] ;?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['nama_user']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['nama_barang']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $pcsChart; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo "$startChart - $endChart"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php  echo number_format($row['harga']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['lokasi']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo number_format($totalChart); ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-data-feature">
                                                    <a class="item" href="invoice_barang.php?id=<?php echo $row['id_chart']; ?>" title="Check"role="button"><i  class="fas fa-check text-success"></i></a>
                                                    <a class="item" id="confirmation" href="../../model/barang/delete_transaksi.php?id_chart=<?php echo $row['id_chart'];?>" title="Denied"role="button"><i class="fas fa-trash text-danger"></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php }  ?>
                                    <? if($k = 4)?>
                                    <?php while ($row2 = mysqli_fetch_array($dataHotel)) { ?>
                                    <?php
                                            $id_kategori = $row2['id_kategori'];
                                            $startChart = $row2['start_tanggal'];
                                            $endChart = $row2['end_tanggal'];
                                            $pcsChart = $row2['pcs'];
                                            $jumlahHari = $row2['jumlah'];
                                            $totalChart = $row2['total'];
                                            $id_room = $row2['id_room'];
                                            $harga_room = $row2['harga'];
                                    ?>
                                    <tr>
                                            <td class="text-center">
                                                <?php echo $no++;; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row2['kategori'] ;?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row2['nama_user']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row2['nama_hotel']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $pcsChart; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo "$startChart - $endChart"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php  echo number_format($harga_room); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row2['lokasi']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo number_format($totalChart); ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-data-feature">
                                                    <a class="item" href="invoice_hotel.php?id=<?php echo $row2['id_chart']; ?>&id_room=<?php echo $id_room; ?>" title="Check"role="button"><i class="fas fa-check text-success"></i></a>
                                                    <a class="item" id="confirmation" href="../../model/barang/delete_transaksi.php?id_chart=<?php echo $row2['id_chart'];?>" title="Denied"role="button"><i class="fas fa-trash text-danger"></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php }  ?>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        <tr class="spacer"></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

$queryStatus = "SELECT tbl_barang.nama_barang,
                        tbl_detailTransaksi.harga,
                        tbl_detailTransaksi.pcs,
                        tbl_detailTransaksi.kategori,
                        tbl_detailTransaksi.start_tanggal,
                        tbl_detailTransaksi.end_tanggal,
                        tbl_detailTransaksi.kategori,
                        tbl_transaksi.status,
                        tbl_transaksi.no_invoice,
                        tbl_transaksi.total_bayar,
                        tbl_transaksi.id_transaksi,
                        tbl_user.nama_user
FROM tbl_detailTransaksi
    INNER JOIN tbl_barang ON tbl_detailTransaksi.id_barang = tbl_barang.id_barang
    INNER JOIN tbl_transaksi on tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user GROUP BY tbl_transaksi.id_transaksi ASC";
$dataStatus  = mysqli_query($conn,$queryStatus);

$queryStatus2 = "SELECT tbl_hotel.nama_hotel,
                        tbl_room.tipe_room,
                        tbl_room.tipe_bed,
                        tbl_detailTransaksi.harga,
                        tbl_detailTransaksi.pcs,
                        tbl_detailTransaksi.kategori,
                        tbl_detailTransaksi.start_tanggal,
                        tbl_detailTransaksi.end_tanggal,
                        tbl_transaksi.status,
                        tbl_transaksi.total_bayar,
                        tbl_transaksi.no_invoice,
                        tbl_user.nama_user
FROM tbl_detailTransaksi
            INNER JOIN tbl_room ON tbl_detailTransaksi.id_barang = tbl_room.id_room
            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
            INNER JOIN tbl_transaksi ON tbl_detailTransaksi.id_transaksi = tbl_transaksi.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
            ORDER BY tbl_transaksi.id_transaksi ASC";
$dataStatus2  = mysqli_query($conn,$queryStatus2);

$querykategori = "SELECT tbl_kategori.id_kategori FROM tbl_kategori
        INNER JOIN tbl_hotel ON tbl_hotel.id_kategori = tbl_kategori.id_kategori";
$dataKat = mysqli_query($conn,$querykategori);

$Kat = "";
while  ($kat = mysqli_fetch_array($dataKat)){

    $Kat = $kat['id_kategori'];

}

$no=1;
$no_invoice = " ";
?>
<div class="section__content section__content--p30">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="user-data m-b-40">
                <h3 class="title-3 m-b-30">
                    <i class="fas fa-chart-bar"></i>Detail Transaksi</i></h3>
    <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
        <table class="table table-responsive-data2"  id="table">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">No Invoice</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Tanggal Booking</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Stats</th>
                </tr>
            </thead>
            <tbody>
            <? while ($rowStatus = mysqli_fetch_array($dataStatus)){ ?>
                        <?php $nama_barang = $rowStatus['nama_barang'];
                        $nama_kategori = $rowStatus['kategori'];
                        $nama_user = $rowStatus['nama_user'];
                        $pcs = $rowStatus['pcs'];
                        $harga = $rowStatus['harga'];
                        $start = $rowStatus['start_tanggal'];
                        $end = $rowStatus['end_tanggal'];
                        $statuss = $rowStatus['status'];
                        $total_bayar = $rowStatus['total_bayar'];
                        $no_invoice = $rowStatus['no_invoice'];?>
                <tr class="tr-shadow">
                    <td class="text-center">
                        <?php echo $no++;; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $no_invoice ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $nama_user ; ?>
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
                        <?php echo number_format($total_bayar); ; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($statuss == 0) {
                            echo "Proccessed";
                        } else if ($statuss == 1){
                            echo "Validated"; }
                            else if ($statuss == 3){
                                echo "Denied"; }
                            ?>
                    </td>
                <input type="hidden" name="total_bayar" value=<?php echo $total_bayar;?>>
                </tr>
                <?php } ?>
                    </tbody>
                </table>
                        </div>
                    <tr class="spacer"></tr>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="user-data m-b-40">
    <h3 class="title-3 m-b-30">
        <i class="fas fa-chart-bar"></i></i>Detail Transaksi Hotel</h3>
    <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
        <table class="table table-responsive-data2" id="table">
        <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">No Invoice</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Room</th>
                    <th class="text-center">Bed</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Tanggal Booking</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Stats</th>
                </tr>
        </thead>
        <tbody>
                <?php if($Kat == 4){?>
                <? while ($rowStatus = mysqli_fetch_array($dataStatus2)){ ?>
                <?php
                        $nama_barang = $rowStatus['nama_hotel'];
                        $nama_kategori = $rowStatus['kategori'];
                        $nama_user = $rowStatus['nama_user'];
                        $pcs = $rowStatus['pcs'];
                        $room = $rowStatus['tipe_room'];
                        $bed = $rowStatus['tipe_bed'];
                        $harga = $rowStatus['harga'];
                        $start = $rowStatus['start_tanggal'];
                        $end = $rowStatus['end_tanggal'];
                        $statuss = $rowStatus['status'];
                        $total_bayar = $rowStatus['total_bayar'];
                        $no_invoice = $rowStatus['no_invoice'];
                ?>
                <tr class="tr-shadow">
                    <td class="text-center">
                        <?php echo $no2++;; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $no_invoice ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $nama_user ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $nama_barang ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $room ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $bed ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $pcs ; ?>
                    </td>
                    <td class="text-center">
                        <?php echo "$start - $end"; ?>
                    </td>
                    <td class="text-center">
                        <?php echo number_format($total_bayar); ; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($statuss == 0) {
                            echo "Proccessed";
                        } else if ($statuss == 1){
                            echo "Validated"; }
                            else if ($statuss == 3){
                                echo "Denied"; }
                            ?>
                    </td>
                </tr>
                    <input type="hidden" name="total_bayar" value=<?php echo $total_bayar;?>>
                <?php } ?>
                <?php } ?>
                </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<?php include "../../js/page3.php";?>
<script type="text/javascript">
$("#confirmation").click(function(){
        return confirm('Are you sure?');
    });
</script>
</body>
</html>
<?php
mysqli_close($conn);
?>