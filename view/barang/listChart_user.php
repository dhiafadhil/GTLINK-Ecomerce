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
$id_user = $_SESSION['id_user'];
$level = $_SESSION['level'];

//barang
$query = "SELECT tbl_chart.*,
                tbl_kategori.nama_kategori,
                tbl_kategori.id_kategori,
                tbl_barang.nama_barang,
                tbl_barang.harga,
                tbl_user.lokasi,
                tbl_komisi.principal,
                tbl_komisi.komisi1,
                tbl_komisi.komisi2
FROM tbl_chart
    INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_chart.id_barang
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_chart.id_user
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
    INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
WHERE  tbl_chart.status = 0 AND tbl_chart.id_user = $id_user
GROUP BY tbl_chart.id_chart";
$data  = mysqli_query($conn, $query);

//hotel
$query2 = "SELECT tbl_chart.*,
                    tbl_kategori.nama_kategori,
                    tbl_hotel.id_kategori,
                    tbl_hotel.id_hotel,
                    tbl_hotel.nama_hotel,
                    tbl_user.lokasi,
                    tbl_komisi.principal,
                    tbl_komisi.komisi1,
                    tbl_komisi.komisi2,
                    tbl_room.id_room,
                    tbl_room.tipe_room,
                    tbl_room.harga_room
FROM tbl_chart
    INNER JOIN tbl_room ON tbl_room.id_room = tbl_chart.id_barang
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_chart.id_user
    INNER JOIN tbl_hotel ON tbl_room.id_hotel = tbl_hotel.id_hotel
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
    INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
    WHERE  tbl_chart.status = 0 AND tbl_chart.id_user = $id_user
GROUP BY tbl_chart.id_chart" ;
$data2  = mysqli_query($conn, $query2);

//pembeda
$querykategori = "SELECT tbl_kategori.id_kategori FROM tbl_kategori
        INNER JOIN tbl_hotel ON tbl_hotel.id_kategori = tbl_kategori.id_kategori";
$dataKat = mysqli_query($conn,$querykategori);
$Kat = "";
while  ($kat = mysqli_fetch_array($dataKat)){

    $Kat = $kat['id_kategori'];
}

$date = date('dmY');
$dataHitung = mysqli_query($conn, $query);
$hitung = mysqli_num_rows($dataHitung);
$no=1;

?>
</head>
<body class="animsition">
<?php include "../../menu3.php"; ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
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
                                    <?php function random($len){
                                                        $result = "";
                                                        $chars = "00011122233344455566677788899";
                                                        $charArray = str_split($chars);
                                                        for($i = 0; $i < $len; $i++){
                                                            $randItem = array_rand($charArray);
                                                            $result .= "".$charArray[$randItem];
                                                        }
                                                        return $result;
                                                    }
                                                    $invoice1 = random(4);
                                                    $invoice = mt_rand(100,999);
                                    ?>
                                    <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                        <table id="table" class="table table-responsive-data2" style="font-size:15.5px;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Hari</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Lokasi</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($data)) { 
                                                $status = $row['status'];
                                                $totall = $row['total'];
                                                $id_kategori = $row['id_kategori'];
                                                $kategori = $row['nama_kategori'] ;
                                                $nama = $row['nama_barang'];
                                                $harga = $row['harga'];
                                                $id_chart = $row['id_chart'];
                                                $jumlah = $row['jumlah'];
                                                $start = $row['start_tanggal'];
                                                $end = $row['end_tanggal'];
                                                $id_barang = $row['id_barang'];;
                                                $pcs = $row['pcs'];
                                                $principal = $row['principal'];
                                                $komisi = $row['komisi1'];
                                                $komisi2 = $row['komisi2'];
                                                $nama_pemesan = $row['nama_pemesan'];
                                                $no_telp = $row['no_hp'];
                                                if($level == 3){
                                                    $harga = $harga + $principal;
                                                } else if($level == 4){
                                                    $harga = $harga + $principal + $komisi;
                                                } else if($level == 5){
                                                    $harga = $harga + $principal + $komisi + $komisi2;
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center"><?php echo $nama; ?></td>
                                                    <td class="text-center"><?php echo $pcs; ?></td>
                                                    <td class="text-center"><?php echo $jumlah;?></td>
                                                    <td class="text-center"><?php  echo number_format($harga); ?></td>
                                                    <td class="text-center"><?php echo $row['lokasi']; ?></td>
                                                    <td class="text-center"><?php  echo number_format($totall); ?></td>
                                                    <td class="text-center">
                                                        <div class="table-data-feature">
                                                            <form action="../../model/barang/confirm.php" method="post" novalidate="novalidate">
                                                                
                                                                <input type="hidden" name="no_invoice"
                                                        value=<?php
                                                        if($level == 2 OR $level == 1){ echo "GT"; }
                                                        else if ($level==3){ echo "GB" ; }
                                                        else if ($level==4){ echo "GA"; }
                                                        else if ($level==5){ echo "GU" ; }
                                                        echo $id_kategori.$id_user.$date.$invoice1; ?>>
                                                        <input type="hidden" id="totalHarga" name="total" value="<?php echo $totall;?>">
                                                        <input type="hidden" name="nama_barang" value=<?php echo $nama;?>>
                                                        <input type="hidden" name="jumlah" value=<?php echo $jumlah;?>>
                                                        <input type="hidden" name="id_chart" value=<?php echo $id_chart;?>>
                                                        <input type="hidden" name="nama_kategori" value=<?php echo $kategori;?>>
                                                        <input type="hidden" name="start" value=<?php echo $start;?>>
                                                        <input type="hidden" name="end" value=<?php echo $end;?>>
                                                        <input type="hidden" id="hargaBarang"name="harga" value="<?php echo $harga;?>">
                                                        <input type="hidden" name="id_barang" value=<?php echo $id_barang;?>>
                                                        <input type="hidden" name="date" value=<?php echo $date;?>>
                                                        <input type="hidden" id="pcsBarang" name="pcs" value="<?php echo $pcs;?>">
                                                        <input type="hidden" name="nama_pemesan" value=<?php echo $nama_pemesan;?>>
                                                        <input type="hidden" name="no_telp" value=<?php echo $no_telp;?>>
                                                        <button class="item" id="tombolBarang" title="Check" type="submit" value="Submit">
                                                        <i class="fas fa-check text-success"></i>
                                                        </button>
                                                    </form>
                                                        <a class="item" id="confirmation" href="../../model/barang/delete_chart.php?id=<?php echo $row['id_chart'];?>">
                                                            <i class="zmdi zmdi-delete text-danger"></i></a>
                                                    </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php while ($row2 = mysqli_fetch_array($data2)) { ?>
                                            <?php
                                                    $status = $row2['status'];
                                                    $totall = $row2['total'];
                                                    $id_kategori = $row2['id_kategori'];
                                                    $kategori = $row2['nama_kategori'] ;
                                                    $nama = $row2['nama_hotel'];
                                                    $id_chart = $row2['id_chart'];
                                                    $jumlah = $row2['jumlah'];
                                                    $start = $row2['start_tanggal'];
                                                    $end = $row2['end_tanggal'];
                                                    $id_room = $row2['id_room'];
                                                    $pcs = $row2['pcs'];
                                                    $harga_room = $row2['harga_room'];
                                                    $principal = $row2['principal'];
                                                    $komisi = $row2['komisi1'];
                                                    $komisi2 = $row2['komisi2'];
                                                    $nama_pemesan = $row2['nama_pemesan'];
                                                    $no_telp = $row2['no_hp'];
                                                    if($level == 3){
                                                    $harga_room = $harga_room + $principal;
                                                    } else if($level == 4){
                                                    $harga_room = $harga_room + $principal + $komisi;
                                                    }else if($level == 5){
                                                    $harga_room = $harga_room + $principal + $komisi + $komisi2;
                                                    } ?>
                                            <tr class="tr-shadow">
                                                <td class="text-center">
                                                    <?php echo $no++;; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $nama; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $pcs; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $jumlah; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo number_format($harga_room); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row2['lokasi']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo number_format($totall); ?> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="table-data-feature">
                                                        <form action="../../model/barang/confirm_hotel.php" method="post" novalidate="novalidate">
                                                            <input type="hidden" id="invoice" name="no_invoice" value="<?php
                                                            if($level == 2 OR $level == 1){
                                                                echo "GT"; }
                                                                else if ($level==3){
                                                                    echo "GB" ; }
                                                                    else if
                                                            ($level== 4){ echo "GA" ; }
                                                            else if ($level== 5){ echo "GU"
                                                            ; } ?><?php echo $id_kategori.$id_user.$date.$invoice1; ?>">
                                                            <input type="hidden" id="total" name="total" value="<?php echo $totall;?>">
                                                            <input type="hidden" name="nama_barang" value="<?php echo $nama;?>">
                                                            <input type="hidden" name="jumlah" value="<?php echo $jumlah;?>">
                                                            <input type="hidden" name="id_chart" value="<?php echo $id_chart;?>">
                                                            <input type="hidden" name="nama_kategori" value="<?php echo $kategori;?>">
                                                            <input type="hidden" name="start" value="<?php echo $start;?>">
                                                            <input type="hidden" name="end" value=<?php echo $end;?>>
                                                            <input type="hidden" id="harga" name="harga" value="<?php echo $harga_room;?>">
                                                            <input type="hidden" name="id_barang" value="<?php echo $id_room;?>">
                                                            <input type="hidden" name="date" value="<?php echo $date;?>">
                                                            <input type="hidden" id="pcsHotel" name="pcs" value="<?php echo $pcs;?>">
                                                            <input type="hidden" name="nama_pemesan" value="<?php echo $nama_pemesan;?>">
                                                            <input type="hidden" name="no_telp" value="<?php echo $no_telp;?>">
                                                            <button class="item" id="tombolHotel" title="Check" type="submit" value="Submit" >
                                                                <i class="fas fa-check text-success"></i>
                                                            </button>
                                                        </form>
                                                <a class="item" id="confirmation" href="../../model/barang/delete_chart.php?id=<?php echo $row2['id_chart'];?>">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
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
<?php
$query = "SELECT tbl_barang.nama_barang,
                    tbl_detailTransaksi.harga,
                    tbl_detailTransaksi.pcs,
                    tbl_detailTransaksi.kategori,
                    tbl_detailTransaksi.start_tanggal,
                    tbl_detailTransaksi.end_tanggal,
                    tbl_detailTransaksi.kategori,
                    tbl_transaksi.status,
                    tbl_transaksi.no_invoice,
                    tbl_transaksi.total_bayar,
                tbl_transaksi.id_transaksi
FROM tbl_detailTransaksi
    INNER JOIN tbl_barang ON tbl_detailTransaksi.id_barang = tbl_barang.id_barang
    INNER JOIN tbl_transaksi on tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
WHERE tbl_transaksi.id_user = $id_user Group BY tbl_detailTransaksi.id_transaksi";
$dataStatus  = mysqli_query($conn,$query);

$query2 = "SELECT tbl_hotel.nama_hotel,
                    tbl_room.tipe_room,
                    tbl_room.tipe_bed,
                    tbl_detailTransaksi.harga,
                    tbl_detailTransaksi.pcs,
                    tbl_detailTransaksi.kategori,
                    tbl_detailTransaksi.start_tanggal,
                    tbl_detailTransaksi.end_tanggal,
                    tbl_transaksi.status,
                    tbl_transaksi.total_bayar,
                    tbl_transaksi.no_invoice
FROM tbl_detailTransaksi
    INNER JOIN tbl_room ON tbl_detailTransaksi.id_barang = tbl_room.id_room
    INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
    INNER JOIN tbl_transaksi ON tbl_detailTransaksi.id_transaksi = tbl_transaksi.id_transaksi
WHERE tbl_transaksi.id_user = $id_user GROUP BY tbl_transaksi.id_transaksi";
$dataStatus2  = mysqli_query($conn,$query2);
$no=1;
$no_invoice = " ";

?>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-chart-bar"></i></i>Detail Transaksi</h3>
                            <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table id="table" class="table table-responsive-data2" style="font-size:15.5px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">No Invoice</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Tanggal Booking</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Stats</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <? while ($rowStatus = mysqli_fetch_array($dataStatus)){ ?>
                                                <?php $nama_kategori = $rowStatus['kategori'];
                                                        $nama_barang = $rowStatus['nama_barang'];
                                                        $pcs = $rowStatus['pcs'];
                                                        $harga = $rowStatus['harga'];
                                                        $start = $rowStatus['start_tanggal'];
                                                        $end = $rowStatus['end_tanggal'];
                                                        $statuss = $rowStatus['status'];
                                                        $total_bayar = $rowStatus['total_bayar'];
                                                        $no_invoice = $rowStatus['no_invoice'];?>
                                    <tr>
                                    <td class="text-center">
                                        <?php echo $no++;; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($statuss == 1){ ?>
                                        <?php echo $no_invoice ; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $nama_barang ; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $pcs ; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo "$start - $end"; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($total_bayar) ; ?>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-chart-bar"></i></i>Detail Transaksi</h3>
                            <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table id="table" class="table table-responsive-data2" style="font-size:15.5px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">No Invoice</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Room</th>
                                            <th class="text-center">Bed</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Tanggal Booking</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Stats</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($Kat = 4){ ?>
                                        <? while ($rowStatus2 = mysqli_fetch_array($dataStatus2)){ ?>
                                                <?php $nama_kategori = $rowStatus2['kategori'];
                                                        $nama_barang = $rowStatus2['nama_hotel'];
                                                        $pcs = $rowStatus2['pcs'];
                                                        $room = $rowStatus2['tipe_room'];
                                                        $bed = $rowStatus2['tipe_bed'];
                                                        $harga = $rowStatus2['harga'];
                                                        $start = $rowStatus2['start_tanggal'];
                                                        $end = $rowStatus2['end_tanggal'];
                                                        $statuss = $rowStatus2['status'];
                                                        $total_bayar = $rowStatus2['total_bayar'];
                                                        $no_invoice = $rowStatus2['no_invoice'];?>
                                            <td class="text-center">
                                                <?php echo $no++;; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($statuss == 1){ ?>
                                                <?php echo $no_invoice ; ?>
                                                <?php } ?>
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
                                                <?php echo number_format($total_bayar) ; ?>
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
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../js/page3.php";?>
<script type="text/javascript">

$("#tombolBarang").click(function(){

$("#totalBarang").val("<?php echo $totall;?>");
$("#hargaBarang").val("<?php echo $harga;?>");
$("#pcsBarang").val("<?php echo $pcs?>");

});

$("#tombolHotel").click(function(){

    $("#total").val("<?php echo $totall;?>");
    $("#harga").val("<?php echo $harga_room;?>");
    $("#pcsHotel").val("<?php echo $pcs;?>");

});

$("#confirmation").click(function(){
        return confirm('Are you sure?');
    });

</script>
</body>
</html>
<?php mysqli_close($conn); ?>