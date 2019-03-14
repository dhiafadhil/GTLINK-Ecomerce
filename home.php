<?php
include "page1.php";
include "model/config.php";
session_start();

if (empty($_SESSION['level'])){
    
    header("location:view/user/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- table -->
<?php   

$id = $_SESSION['id_user'];
$email = $_SESSION['email'];

$stockTerjual = 0;
$total_transaksi = 0;
$estimasi = 0;

$sqldata = "SELECT tbl_barang.id_user, tbl_user.nama_user,tbl_user.lokasi,tbl_barang.id_kategori,tbl_barang.id_barang, tbl_barang.nama_barang, tbl_barang.stock, tbl_barang.harga, tbl_barang.keterangan,tbl_barang.status,tbl_barang.created_at, tbl_barang.updated_at,tbl_kategori.id_kategori,tbl_kategori.nama_kategori
FROM tbl_barang INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori";
$data = mysqli_query($conn, $sqldata);
$no =1;

$sqlKat = "SELECT nama_kategori FROM tbl_kategori ORDER BY id_kategori";
$dataKat = mysqli_query($conn,$sqlKat);

$sqlLok = "SELECT name FROM regencies ORDER BY id";
$dataLok = mysqli_query($conn,$sqlLok);

$query = "SELECT * FROM
            (SELECT tbl_detailTransaksi.id_barang,
                                    tbl_detailTransaksi.created_at,
                                    tbl_detailTransaksi.pcs as terjual,
                                    tbl_detailTransaksi.start_tanggal as mulai,
                                    tbl_detailTransaksi.end_tanggal as selesai,
                                    tbl_hotel.nama_hotel as nama_produk,
                                    tbl_user.id_user,
                                    tbl_user.level,
                                    tbl_user.username,
                                    tbl_transaksi.id_transaksi,
                                    tbl_transaksi.total_bayar,
                                    tbl_room.stock_room as stock,
                                    tbl_room.harga_room as harga
                FROM `tbl_detailTransaksi`
                    INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
                    INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
                    INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
                    INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
                GROUP BY tbl_transaksi.id_transaksi
                UNION ALL
                SELECT detail.id_barang,
                                        detail.created_at,
                                        detail.pcs as terjual,
                                        detail.start_tanggal as mulai,
                                        detail.end_tanggal as selesai,
                                        tbl_barang.nama_barang,
                                        tbl_user.id_user,
                                        tbl_user.level,
                                        tbl_user.username,
                                        tbl_transaksi.id_transaksi,
                                        tbl_transaksi.total_bayar,
                                        tbl_barang.stock as stock,
                                        tbl_barang.harga as harga
                FROM `tbl_detailTransaksi` as detail
                    INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                    INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                    INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
                    GROUP BY tbl_transaksi.id_transaksi ) AS a 
                    WHERE a.id_user = $id ORDER BY a.id_transaksi DESC
                    ";

$result = mysqli_query($conn,$query);
$harga = "";
while ($rowReport = mysqli_fetch_array($result)){

    $terjual = $rowReport['terjual'];
    $stockTerjual += $rowReport['terjual'];
    $harga = $rowReport['harga'];
    $mulai = date('d',strtotime($rowReport['mulai'])); 
    $selesai = date('d',strtotime($rowReport['selesai']));
    $estimasi = $selesai - $mulai;

    if($estimasi == 0){
        $estimasi = 1;
    }

    $total = $harga * $estimasi * $terjual ;
    $total_transaksi += $total;

}

$no = 1;
$tanggal = date('M');
?>
</head>
<body class="animsition">
    <?php
include "menu1.php";

?>
    <!-- END HEADER DESKTOP-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-home"></i></i>DASHBOARD</h3>
                                <?php if($_SESSION['level'] != 2) { ?>
                                <div class="row m-b-45">
                                    <div class="col-sm-2 pl-5">
                                        <form action="view/barang/list_dashboard.php" method="post"> 
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border ">
                                            <select class="js-select2 au-select-dark" name="nama_kategori" required>
                                                <option value="">Kategori</option>
                                                <?php while ($rowKategori = mysqli_fetch_array($dataKat)){ ?>
                                                <option value="<?php echo $rowKategori['nama_kategori']; ?>">
                                                    <?php echo $rowKategori['nama_kategori']; ?>
                                                    <?php } ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6 p-r-100">
                                            <div class="rs-select2--dark rs-select2--sm rs-select2--border w-100">
                                                    <select class="js-example-basic-single"   name = "lokasi" >
                                                        <option value="0">Lokasi</option>
                                                        <?php while ($rowLokasi = mysqli_fetch_array($dataLok)){ ?>
                                                        <option value="<?php echo $rowLokasi['name']; ?>">
                                                            <?php echo $rowLokasi['name']; ?>
                                                            <?php } ?>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>     
                                                </div>  
                                            </div> 
                                        <div class="col-sm-4"></div>
                                    </div> 
                                <div class="user-data__footer">
                                    <button class="au-btn au-btn-load" type="submit">Search</button>
                                        </form>
                                </div>
                                <?php } ?>
                                <?php if($_SESSION['level'] == 2) { ?>
                                        <section class="statistic2 text-center p-t-10">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="statistic__item statistic__item--orange p-t-50">
                                                            <h2 class="number"><?php echo $stockTerjual;?></h2>
                                                            <h2 class="desc">items sold</h2>
                                                            <div class="icon">
                                                                <i class="zmdi zmdi-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-sm-6">
                                                    <div class="statistic__item statistic__item--green  p-t-50">
                                                        <h2 class="number">Rp.<?php  echo number_format($total_transaksi);?></h2>
                                                            <h3 class="desc">Total Earing</h3>
                                                            <div class="icon">
                                                                <i class="zmdi zmdi-money"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
include "js/page1.php";
?>

<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</body>
</html>
<!-- end document-->
<?php 
mysqli_close($conn);
?>