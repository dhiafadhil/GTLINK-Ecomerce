<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if ( $_SESSION['level']  > 2){

    header ("location:../../home.php");

}

$query = "SELECT * FROM tbl_kategori ORDER BY id_kategori";
$data = mysqli_query($conn, $query);
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
                        <form id="tambah_barang" action="../../model/barang/save.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Tambah Barang</strong></div>
                            </div>
                            <?php if ($_SESSION['level'] == 1){?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Supplier</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_user" class="form-control selectpicker" required>
                                        <option value="">Pilih Supplier</option>
                                        <?php
                                            $queryselect = "SELECT id_user,nama_user,level FROM tbl_user WhERE level=2";
                                            $dataselect = mysqli_query($conn, $queryselect);
                                        ?>
                                        <?php while ($rowsupplier = mysqli_fetch_array($dataselect)){ ?>
                                        <option value="<?php echo $rowsupplier['id_user']; ?>">
                                            <?php echo $rowsupplier['nama_user']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                                        <?php } ?>
                            <div class="row form-group" id = "namaproduct">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Nama Product</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_barang" placeholder="Nama Product"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Kategori</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select id ="pilih" name="nama_kategori" class="form-control selectpicker" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php while ($row = mysqli_fetch_array($data)){ ?>
                                        <option value="<?php echo $row['id_kategori']; ?>">
                                            <?php echo $row['nama_kategori']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id ="append"></div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Stock</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input"  min="0" name="stock" placeholder="Masukkan Stock" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="number" class=" form-control-label">Base Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text"  id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                                    min="0" name="harga" placeholder="Masukkan Harga"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea" class=" form-control-label">Keterangan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea id="full-featured" name="keterangan"></textarea>
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
                                </form>
                                <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include "../../js/page3.php";?>

<script type="text/javascript">
$( "#pilih" ).change(function() {
        if ( this.value == 4)
    {
        $("#append").append(
        '<div id="hotelAppend"><div class="row form-group" >'+
        '<div class="col col-md-3">'+
        '<label for="select" class=" form-control-label">Tipe Room</label>'+
        '</div>'+
        '<div class="col-12 col-md-9">'+
        '<select name="room" class="form-control selectpicker">'+
            '<option value="">Pilih Fasilitas</option>'+
            '<option value="standard">STANDARD ROOM</option>'+
            '<option value="premium">PREMIUM ROOM</option>'+
            '<option value="dlx">DELUXE ROOM</option>'+
            '<option value="junior">JUNIOR SUITE ROOM</option>'+
            '<option value="suite">SUITE ROOM</option>'+
            '<option value="presidential">PRESIDENTIAL ROOM</option>'+
            '<option value="family">FAMILY ROOM</option>'+
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="row form-group">'+
        '<div class="col col-md-3">'+
            '<label for="select" class=" form-control-label">Tipe Bed</label>'+
        '</div>'+
        '<div class="col-12 col-md-9">'+
        '<select name="bed" class="form-control selectpicker">'+
            '<option value="">Pilih Fasilitas</option>'+
            '<option value="single">SINGLE </option>'+
            '<option value="twin">TWIN </option>'+
            '<option value="double">DOUBLE </option>'+
        '</select> '+
        '</div>'+
        '</div></div>');
    }
    else if( this.value != 4)
    {
        $("#hotelAppend").remove();
    }
        });
</script>
</body>

</html>