<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if ( $_SESSION['level']  > 2){

    header ("location:../../home.php");

}

$id = $_GET['id_room'];

$query = "SELECT * FROM  tbl_room WHERE id_room = '$id' GROUP BY tbl_room.id_room";
$data = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tambah Barang</title>
</head>
<body class='animsition'>
<?php
include "../../menu3.php";
?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="tambah_barang" action="../../model/barang/edit_room.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Edit Room</strong></div>
                            </div>
                            <?while($row = mysqli_fetch_array($data)){ ?>

                                <?php
                                    $id_hotel = $row['id_hotel'];
                                    $tipe_room = $row['tipe_room'];
                                    $tipe_bed = $row['tipe_bed'];
                                    $stock = $row['stock_room'];
                                    $harga = $row['harga_room'];
                                ?>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tipe Room</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="tipe_room" placeholder="<?php echo $tipe_room; ?>" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tipe Bed</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="tipe_bed" placeholder="<?php echo $tipe_bed; ?>" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="input" class=" form-control-label">Gambar</label>
                                </div>
                                <div class="col-12 col-md-9">Edit Gambar  &nbsp;
                                    <a class="fas fa-images text-dark" href="../gambar/list_gambar.php?id_room=<?php echo $id;?>&tipe_room=<?php echo $tipe_room;?>"></a>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Stock</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" min="0" name="stock" value="<?php echo $stock; ?>" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Base Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" 
                                    min="0" name="harga" placeholder="Masukkan Harga" min="0" name="harga" value="<?php echo number_format($harga); ?>"
                                        class="form-control" required>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm" value="Submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                    <input type="hidden" name="id_room" value="<? echo $id; ?>">
                                    <input type="hidden" name="id_hotel" value="<? echo $id_hotel; ?>">
                                </form>
                                <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
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