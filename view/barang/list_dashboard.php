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

$nama_kategori = $_POST['nama_kategori'];
$lokasi = @$_POST['lokasi'];
$level = $_SESSION['level'];
$harga = @$_POST['harga'] ? explode("-", $_POST['harga']) : '';

if (empty($lokasi) && !empty($nama_kategori)){

    $query_barang = "SELECT tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_barang.*,
                            tbl_kategori.id_kategori,
                            tbl_kategori.nama_kategori,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_barang INNER JOIN tbl_user
    ON tbl_user.id_user = tbl_barang.id_user
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
    INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0
    GROUP BY tbl_barang.id_barang";

    $queryHotel = "SELECT tbl_hotel.*,
                        tbl_room.id_room,
                        tbl_room.tipe_room,
                        tbl_room.tipe_bed,
                        tbl_room.stock_room,
                        tbl_room.harga_room,
                        tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_user.alamat,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.id_kategori,
                        tbl_user.lokasi,
                        tbl_komisi.principal,
                        tbl_komisi.komisi1,
                        tbl_komisi.komisi2
    FROM tbl_hotel
    INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
    INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND  tbl_hotel.status = 1 GROUP BY tbl_hotel.id_hotel";
}

else if (!empty($lokasi) && !empty($nama_kategori)){

    $query_barang = "SELECT tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_barang.*,
                            tbl_kategori.id_kategori,
                            tbl_kategori.nama_kategori,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_barang INNER JOIN tbl_user
    ON tbl_user.id_user = tbl_barang.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND tbl_user.lokasi  like '%$lokasi%'
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0
    GROUP BY tbl_barang.id_barang";

    $queryHotel = "SELECT tbl_hotel.*,
                    tbl_room.id_room,
                    tbl_room.tipe_room,
                    tbl_room.tipe_bed,
                    tbl_room.stock_room,
                    tbl_room.harga_room,
                    tbl_user.nama_user,
                    tbl_user.lokasi,
                    tbl_user.alamat,
                    tbl_kategori.nama_kategori,
                    tbl_kategori.id_kategori,
                    tbl_user.lokasi,
                    tbl_komisi.principal,
                    tbl_komisi.komisi1,
                    tbl_komisi.komisi2
    FROM tbl_hotel
        INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND tbl_user.lokasi like '%$lokasi%'
    AND  tbl_hotel.status = 1
    AND tbl_room.stock_room != 0
    GROUP BY tbl_hotel.id_hotel";
}

else if(!empty($nama_barang) || empty($harga) && empty($nama_kategori))  {

    $nama_kategori = $_POST['nama_kategori'];
    $nama_barang = $_POST['nama_barang'];

    // $escsearch = mysqli_real_escape_string($conn, $nama_kategori,$lokasi);
    $query_barang = "SELECT tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_barang.id_kategori,
                            tbl_barang.*,
                            tbl_kategori.id_kategori,
                            tbl_kategori.nama_kategori,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_barang INNER JOIN tbl_user
    ON tbl_user.id_user = tbl_barang.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND tbl_user.lokasi Like '%$lokasi%'
    AND tbl_barang.nama_barang like '%$nama_barang%'
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0 GROUP BY tbl_barang.id_barang";

    $queryHotel = "SELECT tbl_hotel.*,
                            tbl_room.id_room,
                            tbl_room.tipe_room,
                            tbl_room.tipe_bed,
                            tbl_room.stock_room,
                            tbl_room.harga_room,
                            tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_kategori.nama_kategori,
                            tbl_kategori.id_kategori,
                            tbl_user.lokasi,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_hotel
        INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND tbl_user.lokasi like '%$lokasi%'
    AND tbl_hotel.nama_hotel Like '%$nama_barang%'
    AND  tbl_hotel.status = 1
    AND tbl_room.stock_room != 0
    GROUP BY tbl_hotel.id_hotel";

    }

else if(!empty($nama_barang)){

    $query_barang = "SELECT tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_user.alamat,
                        tbl_barang.*,
                        tbl_kategori.id_kategori,
                        tbl_kategori.nama_kategori,
                        tbl_komisi.principal,
                        tbl_komisi.komisi1,
                        tbl_komisi.komisi2
    FROM tbl_barang INNER JOIN tbl_user
    ON tbl_user.id_user = tbl_barang.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_nama.nama_barang like '%$nama_barang%'
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0
    GROUP BY tbl_barang.id_barang";
}

else if(!empty($nama_barang) && !emtpy($nama_kategori="Hotel")){

    $queryHotel = "SELECT tbl_hotel.*,
                        tbl_room.id_room,
                        tbl_room.tipe_room,
                        tbl_room.tipe_bed,
                        tbl_room.stock_room,
                        tbl_room.harga_room,
                        tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_user.alamat,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.id_kategori,
                        tbl_user.lokasi,
                        tbl_komisi.principal,
                        tbl_komisi.komisi1,
                        tbl_komisi.komisi2
    FROM tbl_hotel
        INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
    WHERE tbl_kategori.nama_kategori like '%$nama_kategori%'
    AND  tbl_hotel.status = 1
    GROUP BY tbl_hotel.id_hotel";
    }

    else if(!empty($nama_barang) && !emtpy($nama_kategori != "Hotel")){

    $query_barang = "SELECT tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_user.alamat,
                        tbl_barang.*,
                        tbl_kategori.id_kategori,
                        tbl_kategori.nama_kategori,
                        tbl_komisi.principal,
                        tbl_komisi.komisi1,
                        tbl_komisi.komisi2
    FROM tbl_barang INNER JOIN tbl_user
    ON tbl_user.id_user = tbl_barang.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_nama.nama_barang like '%$nama_barang%'
    AND tbl_kategori.nama_kateogir like '%$nama_kategori%'
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0
    GROUP BY tbl_barang.id_barang";
        }

else if (isset($harga)) {

    $query_barang = "SELECT tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_barang.id_kategori,
                            tbl_barang.*,
                            tbl_kategori.id_kategori,
                            tbl_kategori.nama_kategori,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_barang
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
    WHERE tbl_barang.harga BETWEEN $harga[0] AND $harga[1]
    AND tbl_barang.status = 1 AND tbl_barang.stock != 0 GROUP BY tbl_barang.id_barang";

    $queryHotel = "SELECT tbl_hotel.*,
                            tbl_room.id_room,
                            tbl_room.tipe_room,
                            tbl_room.tipe_bed,
                            tbl_room.stock_room,
                            tbl_room.harga_room,
                            tbl_user.nama_user,
                            tbl_user.lokasi,
                            tbl_user.alamat,
                            tbl_kategori.nama_kategori,
                            tbl_kategori.id_kategori,
                            tbl_user.lokasi,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,
                            tbl_komisi.komisi2
    FROM tbl_hotel INNER JOIN tbl_room
        ON tbl_room.id_hotel = tbl_hotel.id_hotel INNER JOIN tbl_user
        ON tbl_user.id_user = tbl_hotel.id_user INNER JOIN tbl_kategori
        ON tbl_kategori.id_kategori = tbl_hotel.id_kategori INNER JOIN tbl_komisi
        ON tbl_komisi.id_barang = tbl_hotel.id_hotel
        WHERE tbl_room.harga_room BETWEEN $harga[0] AND $harga[1]
    AND  tbl_hotel.status = 1
    AND tbl_room.stock_room != 0 GROUP BY tbl_hotel.id_hotel";
}

$data_barang = mysqli_query($conn,$query_barang);
$dataHotel = mysqli_query($conn,$queryHotel);
$countBarang = mysqli_num_rows($data_barang);
$countHotel = mysqli_num_rows($dataHotel);
$no=1;

?>

</head>
<body class="animsition">
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-home"></i></i>GT LINK 
                            </h3>
                            <?php if($countBarang > 0){?>
                            <div id="barang" class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table id="table" class="table table-responsive-data2" style="font-size:15.5px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($data_barang)) { ?>
                                            <?php   $id_barangg = $row['id_barang'];
                                                        $alamat = $row['alamat'];
                                                        $lokasi = $row['lokasi'];
                                                        $principal_room = $row['principal'];
                                                        $komisi_room = $row['komisi1'];
                                                        $komisi2_room = $row['komisi2'];
                                                        $harga = $row['harga'];
                                                    if($nama_kategori != "Hotel"){
                                                        if($level == 3){
                                                        $harga = $harga + $principal_room;
                                                        } else if($level == 4){
                                                        $harga = $harga + $principal_room + $komisi_room;
                                                        }else if($level == 5){
                                                        $harga = $harga + $principal_room + $komisi_room + $komisi2_room;
                                                        }
                                                    }
                                                ?>
                                            <tr class="text-center">
                                            <td class="text-center">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['nama_kategori'] ; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['nama_barang']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['stock']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php  echo number_format($harga); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo "$alamat, $lokasi"  ?>
                                            </td>
                                            <td class="text-center table-data-feature ">
                                                <a class="item" href="view_chart.php?id_barang=<?php echo $id_barangg; ?>"
                                                    title="Look For Add To Cart">
                                                <i class="fas fa-cart-plus text-success"></i>
                                                </a>
                                            </td>
                                            <?php }?>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        <? } ?>
                            <?php if($countBarang == 0 && $countHotel > 0 ){?>
                            <div id="hotel" class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table id="table" class="table table-responsive-data2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Hotel</th>
                                                <th class="text-center">Lokasi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr>
                            <?php while($data_hotel = mysqli_fetch_array($dataHotel)){ ?>
                                <?php if($data_hotel == 0){ echo "MAAF BARANG TIDAK TERSEDIA";}?>
                                            <?php
                                                    $id_hotel = $data_hotel['id_hotel'];
                                                    $id_room = $data_hotel['id_room'];
                                                    $room = $data_hotel['tipe_room'];
                                                    $bed = $data_hotel['tipe_bed'];
                                                    $stock_room = $data_hotel['stock_room'];
                                                    $harga_room = $data_hotel['harga_room'];
                                                    $nama_hotel = $data_hotel['nama_hotel'];
                                                    $lokasi_hotel = $data_hotel['lokasi'];
                                                    $alamat_hotel = $data_hotel['alamat'];
                                                    $principal_room = $data_hotel['principal'];
                                                    $komisi_room = $data_hotel['komisi1'];
                                                    $komisi2_room = $data_hotel['komisi2'];
                                                if($nama_kategori == "Hotel"){
                                                    if($level == 3){
                                                    $harga_room = $harga_room + $principal_room;
                                                    } else if($level == 4){
                                                    $harga_room = $harga_room + $principal_room + $komisi_room;
                                                    }else if($level == 5){
                                                    $harga_room = $harga_room + $principal_room + $komisi_room + $komisi2_room;
                                                    }
                                                }
                                            ?>
                                            <td class="text-center">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $nama_hotel; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo  "$alamat_hotel, $lokasi_hotel"  ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-data-feature">
                                                    <form action="viewChart_hotel.php?id_hotel=<?php echo $id_hotel;?>" method="post" novalidate="novalidate">
                                                        <button class="item"  data-placement="top" title="View Room">
                                                            <i class="zmdi zmdi-eye text-success"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="modal fade bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="margin-top:12%">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="../../images/profil-lisa-blackpink.jpg" id="imagepreview" >
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "../../js/page3.php";?>
<script type="text/javascript">
$(document).ready(function() {

$('#search').show();
})
</script>
</body>
</html>
