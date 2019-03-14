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
$id = $_SESSION['id_user'];

if($_SESSION['level'] == 2){

    $query = "SELECT tbl_hotel.id_hotel,
                        tbl_hotel.nama_hotel,
                        tbl_hotel.keterangan,
                        sum(tbl_room.stock_room),
                        tbl_room.id_hotel,
                        tbl_user.id_user
                        FROM tbl_hotel
                        INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
                        INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
                        WHERE tbl_user.id_user = $id
                        GROUP BY tbl_room.id_hotel ";
    $data = mysqli_query($conn, $query);

}

if($_SESSION['level'] == 1){

    $query = "SELECT tbl_hotel.id_hotel,
                        tbl_hotel.nama_hotel,
                        tbl_hotel.keterangan,
                        sum(tbl_room.stock_room),
                        tbl_room.id_hotel,
                        tbl_user.id_user
                        FROM tbl_hotel
                        INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
                        INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
                        GROUP BY tbl_room.id_hotel ";
    $data = mysqli_query($conn, $query);

}

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
                            <h3 class="title-3 m-b-30">
                            List Hotel</h3>
                                <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table class="table table-responsive-data2">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Hotel</th>
                                <th class="text-center">Jumlah Room</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php while ($data_hotel = mysqli_fetch_array($data)){?>
                                <?php
                                $id_hotel = $data_hotel['id_hotel'];
                                $nama_hotel = $data_hotel['nama_hotel'];
                                $keterangan = $data_hotel['keterangan'];
                                ?>
                                <? $sum = "SELECT sum(stock_room) AS stock FROM tbl_room WHERE id_hotel = '$id_hotel' ";
                                    $resultSum = mysqli_query($conn,$sum);
                                    while($r = mysqli_fetch_array($resultSum)){
                                    $stock = $r['stock'];
                                    }
                                ?>
                        <tbody class="table table-borderless table-striped table-earning">
                            <tr>
                                <td class="text-center">
                                    <?php echo $no++;; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $nama_hotel; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $stock; ?>
                                </td>
                                <td class="text-center">
                                    <div class="table-data-feature">
                                        <form action="list_room.php?id_hotel=<?php echo $id_hotel;?>" method="post" novalidate="novalidate">
                                            <button class="item" title="View Hotel">
                                                <i class="zmdi zmdi-eye text-info"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                    <?php if($_SESSION['level'] < 3){ ?>
                                        <form action="edit_hotel.php?id_hotel=<?php echo $id_hotel;?>" method="post" novalidate="novalidate">
                                            <button class="item" title="Edit Hotel">
                                                <i class="zmdi zmdi-edit text-primary"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                        <form action="../../model/barang/delete_hotel.php?id_hotel=<?php echo $id_hotel?>" method="post" novalidate="novalidate">
                                            <button class="item" title="Delete Hotel" onclick="return confirm('Are You Sure?')">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                    </div>
                                <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <div>
    </div>
</div>
<?php include "../../js/page3.php"; ?>
</body>
</html>
