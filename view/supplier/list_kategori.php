<?php
include "../../page3.php";
include "../../model/config.php";

session_start();
if ( $_SESSION['level']  != 1){

    header ("location:../../home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- table -->
<?php
$query = "SELECT * FROM tbl_kategori ORDER BY id_kategori";
$data = mysqli_query($conn, $query);
$no = 1;
    ?>
</head>
<body class="animsition">
    <?php
include "../../menu3.php";
?>
    <!-- END HEADER DESKTOP-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h1 class="title-3 m-b-30">
                                <a href="../../view/supplier/tambah_kategori.php" class="btn btn-primary" data-toogle="button"
                                    style="font-size:10px;">Tambah Kategori</a></h1>
                            <div class="col-md-12">
                                <div class="table-responsive table-data2 m-b-10 p-b-10">
                                    <table class="table table-borderless-data2 " style="font-size:18px;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO</th>
                                                <th class="text-center">Nama Kategori</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <?php while ($row = mysqli_fetch_array($data)){?>
                                        <tbody class="table table-borderless table-striped table-earning">
                                            <tr class="text-center align-center">
                                                <td class="text-center">
                                                    <?php echo $no++;; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row['nama_kategori']; ?>
                                                </td>
                                                    <td class="text-center table-data-center">
                                                    
                                                    <a class="item text-center" href="../../view/supplier/edit_kategori.php?id_kategori=<?php echo $row['id_kategori']?>"
                                                        role="button" title="Edit Kategori">
                                                    <i class="far fa-edit text-primary"></i></a>
                                                    <a class="item" href="../../model/supplier/delete.php?id_kategori=<?php echo $row['id_kategori']?>"
                                                        role="button" title="Delete Kategori">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                    </a>
                                                    </td>
                                                
                                                <input type="hidden" name="id_kategori" value=<?php echo
                                                    $row['id_kategori'];?>>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <!-- END PAGE CONTAINER-->
                        </div>
                        <br>
                        <?php
include "../../js/page3.php";
?>
</body>

</html>
<!-- end document-->