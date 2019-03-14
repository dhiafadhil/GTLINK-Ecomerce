<?php 
//  if(!isset($_GET['id_user'])){
//      print_r("ada!");
//  }
include "../../page3.php";
include "../../model/config.php";
session_start();
if ( $_SESSION['level']  != 1){
    header ("location:../../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$id_kategori = $_GET['id_kategori'];
// Fetech user data based on id
$data = mysqli_query($conn, "SELECT * FROM tbl_kategori WHERE id_kategori = $id_kategori");
while($user_data = mysqli_fetch_array($data))
{
    $nama_kategori = $user_data['nama_kategori'];
}
?>
    <!-- Title Page-->
    <title>EDIT KATEGORI</title>
</head>
<body>
    <!-- edit user -->
<body class='animsition'>
<?php 
include "../../menu3.php";
?>

        <!-- form -->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 r">
                            <form id="update" action="../../model/supplier/edit.php" method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Edit Kategori</strong></div>
                                </div>
                                <div class="row form-group p-l-20 p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama Kategori</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_kategori" placeholder="Masukan Nama Kategori"
                                            class="form-control" value="<?php echo $nama_kategori;?>" required>
                                    </div>
                                </div>
                                <!-- input id sama tanggal otomatis -->
                                <input type="hidden" name="id_kategori" value=<?php echo $id_kategori;?>>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> update
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="javascript:window.history.back();">
                                        Back
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </body>
    <?php 
include "../../js/page3.php";
?>

</html>