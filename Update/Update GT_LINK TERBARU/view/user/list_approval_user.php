<?php
session_start();
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";
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

$query = "SELECT 
            i.id_user,
            i.id_child,
            i.username,
            i.email,
            i.nama_user,
            i.level,
            i.lokasi,
            i.status_user,
            u.username
        From tbl_user i
        LEFT JOIN tbl_user u ON u.id_user = i.id_child
        Where i.status_user = 0";
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
                            <h1 class="title-3 m-b-30">List Approval User</h1>
                        <div class="table table-responsive-data2 p-l-20 p-r-20" >
                        <table class="table table-responsive-data2" id="table" method="POST">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Top User</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_array($data)){ ?>
                            <?php
                            $id_user = $row['id_user'];
                            $username = $row[2];
                            ?>
                        <tr>
                                <td class="text-center">
                                    <?php echo $no++;; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $username;?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['nama_user']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['lokasi']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row['username']; ?>
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
                                    <?php if ($row['status'] == 0){
                                        echo "Un Approve" ; } ?>
                                </td>
                                <td class="text-center">
                                    <div class="table-data-feature">
                                        <a class="item" href="check_approval_user.php?id=<?php echo $id_user;?>" title="Approv"role="button">
                                        <i class="fas fa-check text-success">
                                        </i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                             <input type="hidden" name="email" value=<?php echo $row['email'];?>>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</html>
<!-- end document-->