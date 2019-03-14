<?php
session_start();
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";

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
$querybank = "SELECT * FROM tbl_bank Order By id_bank";
$databank = mysqli_query($conn, $querybank);
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
                        <h3 class="title-3 m-b-30">LIST BANK</h3>
                    <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                        <table class="table table-responsive-data2" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Nama Bank</th>
                                    <th class="text-center">No Rekening</th>
                                    <th class="text-center">Atas Nama</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php while ($rowbank = mysqli_fetch_array($databank)) { ?>
                                <tbody class="table table-borderless table-striped table-earning">
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $no++;; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $rowbank['nama_bank']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $rowbank['no_rekening']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $rowbank['atas_nama']; ?>
                                        </td>
                                        <td class="text-center table-data-feature">
                                            <a class="item" href="../../view/bank/edit_bank.php?id_bank=<?php echo $rowbank['id_bank'];?>">
                                                <i class="zmdi zmdi-edit text-primary"></i>
                                            </a>
                                            <a class="item" href="../../model/bank/delete.php?id_bank=<?php echo $rowbank['id_bank']?>" onclick="return confirm('Are You Sure To Delete This Bank ?')">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </a>
                                        </td>
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
    //KONDISI PENGECEKAN ALERTIFY AKAN DILAKUKAN DISINI
    // alert('Sukses');
<?php
echo echo_validasi();
?> 
});
</script>
</body>
</html>
