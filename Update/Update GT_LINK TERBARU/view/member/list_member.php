<?php
session_start();
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";

if ( $_SESSION['level']  == 2 || $_SESSION['level'] == 5){

    header ("location:../../home.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- table -->
<?php
$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM tbl_user WHERE id_child = $id_user And status_user=1 ";
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
    <!-- END HEADER DESKTOP-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
    <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h1 class="title-3 m-b-30">
                               
                            <a href="../../view/member/tambah_member.php" class="btn btn-primary" data-toogle="button"
                                style="font-size:10px;">Tambah Member</a></h1>
                            <!-- <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--light rs-select2--sm">
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="table-data__tool">
                                    
                                </div>
                            </div> -->
                            <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table class="table table-responsive-data2">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">level</th>
                                <th class="text-center" value="">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php while ($row = mysqli_fetch_array($data)){?>
                        <tbody class="table table-borderless table-striped table-earning">
                            <tr>
                                <td class="text-center">
                                    <?php echo $no++;; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['username']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['nama_user']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['email']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['lokasi']; ?>
                                </td>
                                <td class="text-center">
                                    <?php  $lvl =$row['level'] ;
                                                if($lvl==1){
                                                    echo "Admin";
                                                } else if ($lvl==2){
                                                    echo "Supplier";
                                                } else if ($lvl==3){
                                                    echo "GT Branch";
                                                } else if ($lvl==4){
                                                    echo "GT Agent";
                                                } else {
                                                    echo "GT User";
                                                }
                                                ;?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['created_at']; ?>
                                </td>
                                <td class="text-center table-data-feature">

                                                        <a class="item" title="Edit User" href="../../view/member/edit_member.php?id=<?php echo $row['id_user']?>">
                                                            <i class="zmdi zmdi-edit text-primary"></i>
                                                        </a>  
                                                        <a class="item" title="Delete User" href="../../model/member/delete.php?id=<?php echo $row['id_user']?>"role="button">
                                                            <i class="zmdi zmdi-delete text-danger"></i>
                                                        </a>                                             
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
                            </div>  
                                                </div>    
            <!-- END PAGE CONTAINER-->
        <?php
include "../../js/page3.php";
?>
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

<!-- end document-->