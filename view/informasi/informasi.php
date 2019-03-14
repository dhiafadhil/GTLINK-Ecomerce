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
<!-- table -->

</head>
<body class="animsition">
<?php
include "../../menu3.php";

?>
<!-- END HEADER DESKTOP-->
<!-- MAIN CONTENT-->
<div class="main-content">
    <!--  <div class="section__content section__content--p30"> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-data m-b-40">
                        <h3 class="title-3 m-b-30">
                            <i class="fas fa-bullhorn"></i>payment information</h3>
                            <hr>
                                    <?php
                                    $nama_bank = [];
                                    $queryprofile = "SELECT nama_bank,atas_nama,no_rekening FROM tbl_bank INNER JOIN tbl_profile ON tbl_profile.id_profile = tbl_bank.id_profile";
                                    $dataprofile = mysqli_query($conn, $queryprofile);
                                ?>
                                    <?php while ($rowprofile = mysqli_fetch_array($dataprofile)) { 
                                            $nama_bank = $rowprofile[0];
                                        ?>
                            <table>
                                <tr>
                                    <?php if($nama_bank == "Mandiri") { ?>
                                    <td width="300" align="center">
                                        <img src="../../images/mandiri.png" width="180px">
                                    </td>
                                <?php } ?>
                                <?php if ($nama_bank == "BRI") { ?>
                                        <td width="300" align="center">
                                        <img src="../../images/bri.png" width="180px">
                                    </td>
                                    <?php } ?>
                                    <td>
                                    <h2><?php echo $rowprofile['nama_bank']; ?></h2>
                                        No Rekening : <?php echo $rowprofile['no_rekening']; ?> <br>
                                        A/N  : <?php echo $rowprofile['atas_nama']; ?>
                                    </td>
                                </tr>
                            </table>
                                        <?php } ?>
                            <div class="user-data__footer">
                            
                            
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
include "../../js/page3.php";
?>
</body>
</html>
<!-- end document-->
<?php 
mysqli_close($conn);
?>