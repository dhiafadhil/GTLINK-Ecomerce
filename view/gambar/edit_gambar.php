<?php 
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



$id_gambar = $_GET['id_gambar'];

// Fetech user data based on id
$data = mysqli_query($conn, "SELECT * FROM tbl_gambar WHERE id_gambar = $id_gambar");
while($user_data = mysqli_fetch_array($data))
{   
    
    $id_gambar = $user_data['id_gambar'];
    $id_barang = $user_data['id_barang'];
    $gambar = $user_data['gambar'];
}
?>


    <!-- Title Page-->
    <title>EDIT GAMBAR</title>
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
                                        <form id="update" action="../../model/gambar/edit.php?id_gambar=<?php echo $id_gambar; ?>"  method = "POST"  enctype="multipart/form-data">   
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <strong>Edit Gambar</strong></div>
                                                </div>
                                                    <div class="row form-group p-l-20">
                                                    <div class="col col-md-3">
                                                        <label for="input" class=" form-control-label">Gambar</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" id="input"  name="gambar" class="form-control" value="<img src="../../images/<?php echo $gambar;?>"" >
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_room" value="<?php echo $id_barang;?>"> 
                                                        <!-- input id sama tanggal otomatis -->
                                                        
                                                            <div class="card-footer text-center" >
                                            <button  type="submit" class="btn btn-primary btn-sm" name="update"  value="update">
                                                <i class="fa fa-dot-circle-o"></i> update
                                            </button>
                                            <button  class="btn btn-danger btn-sm" onclick="javascript:window.history.back();"> Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </body>
<?php include "../../js/page3.php";?>
</html>



