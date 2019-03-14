<?php
include "../../page3.php";
include "../../model/config.php";

session_start();
if (empty($_SESSION['level'])){

    header("location:../../view/user/login.php");

}
else if ( $_SESSION['level']  > 2){

    header ("location:../../home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

$id = $_GET['id_hotel'];
$query = "SELECT nama_hotel FROM tbl_hotel WHERE id_hotel = '$id' ";
$data = mysqli_query($conn, $query);

$query2 = "SELECT tbl_room.id_room,
                    tbl_room.tipe_room,
                    tbl_room.tipe_bed,
                    tbl_room.stock_room,
                    tbl_room.harga_room,
                    tbl_hotel.keterangan,
                    tbl_hotel.id_hotel
            FROM tbl_room
            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
            WHERE tbl_room.id_hotel = '$id' ";
$data2 = mysqli_query($conn,$query2);
$no = 1;
?>
</head>
<?php include "../../menu3.php"; ?>
<body class="animsition">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                        <?php while ($data_nama = mysqli_fetch_array($data)){?>
                            <? $nama_hotel =  $data_nama['nama_hotel'];?>
                            <h3 class="title-3 m-b-30">
                            List <? echo $nama_hotel ?> </h3>
                        <? } ?>
                        <h2 class="title-5 m-b-30 m-r-30 text-right">
                        <a class="fas fa-plus text-dark" href="tambah_room.php?nama_hotel=<?php echo $nama_hotel;?>" role="button" title="Add Room" style="font-size:15px"> Add Room</a>
                        </h2>
                                <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                    <table class="table table-responsive-data2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO</th>
                                                <th class="text-center">Tipe Room</th>
                                                <th class="text-center">Tipe Bed</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <?php while ($data_hotel = mysqli_fetch_array($data2)){?>
                                                <?php
                                                $id_room = $data_hotel['id_room'];
                                                $id_hotel = $data_hotel['id_hotel'];
                                                $room = $data_hotel['tipe_room'];
                                                $bed = $data_hotel['tipe_bed'];
                                                $stock_room = $data_hotel['stock_room'];
                                                $harga_room = $data_hotel['harga_room'];
                                                ?>
                                        <tbody class="table table-borderless table-striped table-earning">
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $no++;; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $room; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $bed; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $stock_room;?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo number_format($harga_room);?>
                                                </td>
                                                <td class="text-center">
                                                <?php if($_SESSION['level'] < 3){ ?>
                                                    <div class="table-data-feature">
                                                        <form action="edit_room.php?id_room=<?php echo $id_room;?>&id_hotel=<?php echo $id_hotel;?>" method="post" novalidate="novalidate">
                                                            <button class="item"  data-placement="bottom" title="Edit Room">
                                                                <i class="zmdi zmdi-edit text-primary"></i>
                                                            </button>
                                                        </form>
                                                        &nbsp;
                                                        <form action="../../model/barang/delete_room.php?id_room=<?php echo $id_room?>&id_hotel=<?php echo $id_hotel;?>" role="button" method="post" novalidate="novalidate">
                                                            <button class="item"  data-placement="bottom" title="Delete Room" onclick="return confirm('Are You Sure?')">
                                                                <i class="zmdi zmdi-delete text-danger"></i>
                                                            </button>
                                                        </form>
                                                        </div>
                                                </td>
                                                <?php } ?>
                                            </tr>
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
<?php include "../../js/page3.php";?>
</body>
</html>
