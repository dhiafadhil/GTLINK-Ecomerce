<?php 
 include "../../page3.php";
 include "../../model/config.php";
session_start();
if ( $_SESSION['level']  != 1){ 
    header ("location:../../");
}

?>

<head>
<?php
$queryProfile = "SELECT * FROM tbl_profile";
$resultProfile = mysqli_query($conn,$queryProfile);

$count = mysqli_num_rows($resultProfile);

if($count == TRUE){
    header('location:list_profile.php');
}
?> 

</head>

<!DOCTYPE html>
<html lang="en">
<!-- Tambah User -->
<title>Tambah Profile</title>
<body class='animsition'>
    <?php 
include "../../menu3.php";
?>

    <!-- END HEADER DESKTOP-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Tambah Profile</strong></div>
                            </div>
                            <form action="../../model/profile/save.php" method="POST" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Logo</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="text-input" name="logo" multiple="" placeholder="Masukan Logo"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Nama Profile</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_profile" placeholder="Nama Profile"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm" value="Submit">
                                    <i class="fa fa-dot-circle-o"></i>Submit
                                </button>
                                <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                            </div>
                        </form>
                    </div>
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
</body>

</html>