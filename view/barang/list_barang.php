<?php
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";

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

$query = "SELECT tbl_barang.*,
                    tbl_user.id_user FROM tbl_barang
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
            WHERE  id_kategori != 4 AND tbl_user.id_user = $id
            GROUP BY tbl_barang.id_barang ASC ";

$data = mysqli_query($conn, $query);

}

if($_SESSION['level'] == 1){

    $query = "SELECT tbl_barang.*,
                    tbl_user.id_user FROM tbl_barang
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
            WHERE  id_kategori != 4
            GROUP BY tbl_barang.id_barang ASC ";

$data = mysqli_query($conn, $query);

}

$no = 1;
?>
</head>

<?php
include "../../menu3.php";
?>
<body class="animsition">
<div class="main-content">
    <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                            LIST BARANG</h3>
                    <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                    <table class="table table-responsive-data2" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php while ($row = mysqli_fetch_array($data)){?>
                        <?php
                            $q = "SELECT nama_kategori FROM tbl_kategori Where id_kategori=$row[id_kategori]";
                            $d = mysqli_query($conn, $q);
                            $x = mysqli_fetch_array($d);
                        ?>
                        <tbody class="table table-borderless table-striped table-earning">
                            <tr>
                                <td class="text-center">
                                    <?php echo $no++;; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $x['nama_kategori']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['nama_barang']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['stock']; ?>
                                </td>
                                <td class="text-center">
                                    <? if (!empty($row['harga'])) {?>
                                    <?php echo number_format($row['harga']);?>
                                    <? } ?>
                                </td>
                                <td class="text-center">
                                <form action="edit_barang.php?id_barang=<?php echo $row['id_barang']?>" method="post" novalidate="novalidate">
                                    <div class="table-data-feature">
                                    <?php if($_SESSION['level'] < 3){?>
                                            <button class="item" title="Edit Barang">
                                                <i class="zmdi zmdi-edit text-primary"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                    <form action="../../model/barang/delete.php?id_barang=<?php echo $row['id_barang']?>" role="button" method="post" novalidate="novalidate">
                                        <button class="item" title="Delete Barang" onclick="return confirm('Are You Sure?')">
                                            <i class="zmdi zmdi-delete text-danger"></i>
                                        </button>
                                    </form>
                                    &nbsp;
                                    </div>
                                <?php } ?>
                                </td>
                                <input type="hidden" name="tanggal" value=<?php echo $row['created_at'];?>>
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
<?php include "../../js/page3.php";?>
<script type="text/javascript">
$(document).ready(function(){
<?php
echo echo_validasi();
?> 
});
</body>
</html>
