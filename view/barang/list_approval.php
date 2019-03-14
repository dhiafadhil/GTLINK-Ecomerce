<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if (empty($_SESSION['level'])){

    header("location:../../view/user/login.php");

}

    else if ( $_SESSION['level']  == 2){

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

$query = "SELECT tbl_barang.id_user,
            tbl_user.nama_user,
            tbl_barang.id_kategori,
            tbl_barang.id_barang,
            tbl_barang.nama_barang,
            tbl_barang.keterangan,
            tbl_barang.status,
            tbl_barang.stock,
            tbl_barang.harga,
            tbl_barang.created_at
FROM tbl_barang INNER JOIN tbl_user
            ON tbl_user.id_user = tbl_barang.id_user INNER JOIN tbl_kategori
            ON tbl_kategori.id_kategori = tbl_barang.id_kategori
            WHERE tbl_barang.status = 0  ";
$data = mysqli_query($conn, $query );
$no = 1;
?>

</head>
<body class="animsition">
<?php
include "../../menu3.php";
?>
    <div class="main-content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h1 class="title-3 m-b-30">List Barang</h1>
                        <div class="table table-responsive-data2 p-l-20 p-r-20" >
                        <table class="table table-responsive-data2" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_array($data)){ ?>
                        <?php
                        $brg = $row['id_barang'];
                        ?>
                        <tr>
                                <td class="text-center">
                                    <?php echo $no++;; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['nama_user'];?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['nama_barang']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['stock']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo number_format($row['harga']); ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 0){
                                        echo "Un Publish" ; } ?>
                                </td>
                                <td class="text-center">
                                    <div class="table-data-feature">
                                        <a class="item" href="check_approval.php?id=<?php echo $brg;?>" title="Approv"role="button">
                                        <i class="fas fa-check text-success">
                                        </i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

$queryHotel = "SELECT tbl_hotel.*,
                tbl_room.id_room,
                tbl_room.tipe_room,
                tbl_room.tipe_bed,
                tbl_room.stock_room,
                tbl_room.harga_room,
                tbl_user.nama_user
FROM tbl_hotel INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
Where tbl_hotel.status = 0 GROUP BY tbl_hotel.id_hotel";
$dataHotel = mysqli_query($conn,$queryHotel);
$no2 = 1;
?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h1 class="title-3 m-b-30">List Hotel</h1>
                            <div class="table table-responsive-data2 p-l-20 p-r-20" >
                                <table class="table table-responsive-data2" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <!-- Hotel -->
                        <?php while ($r = mysqli_fetch_array($dataHotel)){?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $no2++; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $r['nama_user'];?>
                                </td>
                                <td class="text-center">
                                    <?php echo $r['nama_hotel']; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($r['status'] == 0){
                                        echo "Un Publish" ; } ?>
                                </td>
                                <td class="text-center table-data-feature">
                                <a class="item" href="view_room.php?id_hotel=<?php echo $r['id_hotel'];?>&id_room=<?php echo $r['id_room'];?>" title="View Room"
                                    role="button">
                                    <i class="fas fa-eye text-info"></i>
                                </a>
                                </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
        <?php
include "../../js/page3.php";
?>
</body>
</html>
<!-- end document-->