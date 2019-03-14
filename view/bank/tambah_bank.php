<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if ( $_SESSION['level']  > 2){
    header ("location:../../home.php");
}

$query = "SELECT * FROM tbl_kategori ORDER BY id_kategori";
$data = mysqli_query($conn, $query);

$id_profile = [];
$queryprofile = "SELECT id_profile FROM tbl_profile";
$dataprofile = mysqli_query($conn, $queryprofile);

while ($rowprofile = mysqli_fetch_array($dataprofile)) {
    $id_profile = $rowprofile;
}
    echo $id_profile[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Bank</title>
</head>
<body class='animsition'>
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="tambah_bank" action="../../model/bank/save.php" method="POST">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Add Bank</strong></div>
                            </div>
                            <div class="row form-group" id = "namabank">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Nama Bank</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_bank" placeholder="Nama Bank"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text" class=" form-control-label">A/N</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="atas_nama" placeholder="Atas Nama"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text" class=" form-control-label">No Rekening</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="no_rekening" placeholder="Masukkan No Rekening"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm" value="Submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <input type="hidden" name="id_profile" value="<?php echo $id_profile[0];?>"">
                                </form>
                                <a class="btn btn-danger btn-sm" onclick="javascript:window.history.back();"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include "../../js/page3.php";?>
</body>

</html>