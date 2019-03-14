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
$id_bank = $_GET['id_bank'];

// Fetech user data based on id
$databank = mysqli_query($conn, "SELECT * FROM tbl_bank WHERE id_bank = $id_bank");

while($user_data = mysqli_fetch_array($databank))
{       
    $id_bank = $user_data['id_bank'];
    $id_profile = $user_data['id_profile'];
    $nama_bank = $user_data['nama_bank'];
    $atas_nama = $user_data['atas_nama'];
    $no_rekening = $user_data['no_rekening'];
}
?>

<!-- Title Page-->
<title>EDIT PROFILE</title>
</head>
<body>
<!-- edit user -->
<body class='animsition'>
<?php include "../../menu3.php";?>
<!-- form -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 r">
                    <form id="update" action="../../model/bank/edit.php?id_bank=<?php echo $id_bank; ?>"  method="POST">  
                        <div class="card">
                            <div class="card-header text-center">
                                <strong>Edit List Bank</strong></div>
                                    </div>
                                    <div class="row form-group p-l-20 p-l-20">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Nama Bank</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="nama_bank" placeholder="Masukan Nama Bank" class="form-control" value="<?php echo $nama_bank;?>" required>
                                        </div>
                                    </div>
                                    <div class="row form-group p-l-20 p-l-20">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">A/N</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="atas_nama" placeholder="Masukan Nama Bank" class="form-control" value="<?php echo $atas_nama;?>" required>
                                        </div>
                                    </div>
                                    <div class="row form-group p-l-20 p-l-20">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">No Rekening</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="no_rekening" placeholder="Masukan No Rekening" class="form-control" value="<?php echo $no_rekening;?>" required>
                                        </div>
                                    </div>
                                    <!-- input id sama tanggal otomatis -->                                        
                                <div class="card-footer text-center" >
                                    <button  type="submit" class="btn btn-primary btn-sm" name="update"  value="update">
                                            <i class="fa fa-dot-circle-o"></i> update
                                    </button>
                                    <button  class="btn btn-danger btn-sm" onclick="javascript:window.history.back();"> Back</button>                            
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </body>
<?php include "../../js/page3.php";?>
</html>