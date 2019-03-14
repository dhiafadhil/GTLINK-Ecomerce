<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if ( $_SESSION['level']  > 2){

    header ("location:../../home.php");

}

$nama = $_GET['nama_hotel'];
$query = "SELECT * FROM tbl_hotel WHERE nama_hotel = '$nama' ";
$data = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($data)){

    $nama_hotel = $row['nama_hotel'];
    $id_hotel = $row['id_hotel'];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Tambah Barang</title>
</head>
<body class='animsition'>
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="tambah_barang" action="../../model/barang/save_room.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Tambah Room</strong></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Nama Hotel</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_barang" placeholder="<? echo $nama; ?>"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div id="hotelAppend"><div class="row form-group">
                            <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Tipe Room</label>
                            </div>
                            <div class="col-12 col-md-9">
                            <select name="room" class="form-control selectpicker">
                                <option value="">Pilih Fasilitas</option>
                                <option value="standard">STANDARD ROOM</option>
                                <option value="premium">PREMIUM ROOM</option>
                                <option value="dlx">DELUXE ROOM</option>
                                <option value="junior">JUNIOR SUITE ROOM</option>
                                <option value="suite">SUITE ROOM</option>
                                <option value="presidential">PRESIDENTIAL ROOM</option>
                            </select>
                            </div>
                            </div>
                            <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Tipe Bed</label>
                            </div>
                            <div class="col-12 col-md-9">
                            <select name="bed" class="form-control selectpicker">
                                <option value="">Pilih Fasilitas</option>
                                <option value="single">SINGLE ROOM</option>
                                <option value="twin">TWIN ROOM</option>
                                <option value="double">DOUBLE ROOM</option>
                                <option value="family">FAMILY ROOM</option>
                            </select>
                            </div>
                            </div></div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Stock</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" min="0" name="stock" placeholder="Masukkan Stock" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Base Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                                    min="0" name="harga" placeholder="Masukkan Harga"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                                    <div class="col col-md-3">
                                                    <label for="input" class=" form-control-label">Gambar</label>
                                                    </div>
                                                        <div class="col-12 col-md-9">
                                                        <input type="file" id="input" name="gambar[]" multiple="" placeholder="Masukan Gambar" class="form-control" required>
                                                        </div>
                                                        </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm" value="Submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <input type="hidden" name="id_hotel" value="<? echo $id_hotel ?>">
                                </form>
                                <button class="btn btn-danger btn-sm" onclick="javascript:window.history.back();"> Back
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include "../../js/page3.php";?>
</body>
</html>