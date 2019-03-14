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

    $id_barang = $_GET['id_barang'];

    if(!empty($id_barang)){

    $data = mysqli_query($conn,"SELECT tbl_barang.id_user,
                                            tbl_barang.id_kategori,
                                            tbl_barang.nama_barang,
                                            tbl_barang.harga,
                                            tbl_barang.stock,
                                            tbl_barang.keterangan,
                                            tbl_barang.status,
                                            tbl_kategori.nama_kategori
    FROM tbl_barang
            INNER JOIN tbl_kategori ON tbl_barang.id_kategori = tbl_kategori.id_kategori
            WHERE tbl_barang.id_barang = '$id_barang' ");

    while($data1 = mysqli_fetch_array($data)){

        $kategori = $data1['id_kategori'];
        $nama_kategoriBarang = $data1['nama_kategori'];
        $id_user = $data1['id_user'];
        $nama_barang = $data1['nama_barang'];
        $stock = $data1['stock'];
        $harga = $data1['harga'];
        $keterangan = $data1['keterangan'];
        $status = $data1['status'];

}

}

?>
    <!-- Title Page-->
    <title>EDIT BARANG</title>
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
                    <?php if($kategori == 4){ ?>
                        <div class="col-lg-12 r">
                            <form id="update" action="../../model/barang/edit_hotel.php?id_hotel=<?php echo $id_hotel; ?>"
                                method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Edit Barang</strong></div>
                                </div>
                                <div class="row form-group p-l-20 ">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Kategori</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id ="pilih" name="id_kategori" required class="form-control selectpicker" >
                                            <option value="<?php echo $kategori; ?>"><?php echo $nama_kategori; ?></option>
                                            </select>
                                    </div>
                                </div>
                                <div id ="append"></div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_barang"
                                        class="form-control" value="<?php echo $nama_hotel;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Stock</label>
                                    </div>
                                    <div class="col-12 col-md-9"  id="stock_append">
                                        <input type="text" id="text-input" name="stock_room" placeholder="Masukkan stock"
                                            class="form-control" value="<?php echo $stock_room;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Best Price</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" 
                                        name="harga_room" placeholder="Masukkan Harga"
                                            class="form-control" value="<?php echo $harga_room; ?>" required>
                                    </div>
                                </div>

                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Keterangan</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <script src="../../vendor/tinymce/tinymce.min.js"></script>
                                        <script>tinymce.init({ selector: 'textarea#full-featured',
                                                                height: 350,
                                                                theme : 'silver',
                                                                plugins : 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
                                                                toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                                                                });
                                                                </script>
                                    <textarea id="full-featured" name="keterangan"><? echo $keterangan_hotel?></textarea>
                                    </div>
                                </div>
                                <!-- input id sama tanggal otomatis -->
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> update
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="javascript:window.history.back();">
                                        Back
                                    </button>
                                    <input type="hidden" name="id_kategori" value=<?php echo $kategori; ?>>
                                    <input type="hidden" name="id_user" value=<?php echo $iduser_hotel;?>>
                        </div>
                    </form>
                    <?php }?>
                    </div>
                    <?php if($kategori != 4) {?>
                    <div class="col-lg-12 r">
                            <form id="update" action="../../model/barang/edit.php?id_barang=<?php echo $id_barang; ?>"
                                method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Edit Barang</strong></div>
                                </div>
                                <div class="row form-group p-l-20 ">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Kategori</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id ="pilih" name="id_kategori" class="form-control selectpicker" required>
                                            <option>Pilih Kategori</option>
                                            <option value="<?php echo $kategori_barang; ?>" ><?php echo $nama_kategoriBarang; ?></option>
                                            </select>
                                    </div>
                                </div>
                                <div id ="append"></div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_barang" placeholder="Masukan Nama Barang"
                                            class="form-control" value="<?php echo $nama_barang;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Stock</label>
                                    </div>
                                    <div class="col-12 col-md-9"  id="stock_append">
                                        <input type="number" id="text-input"  min="0" name="stock" placeholder="Masukkan stock"
                                            class="form-control" value="<?php echo $stock; ?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Best Price</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  min="0" name="harga" placeholder="Masukkan Harga"
                                            class="form-control" value="<?php echo number_format($harga);?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                                    <div class="col col-md-3">
                                                    <label for="input" class=" form-control-label">Gambar</label>
                                                    </div>
                                                        <div class="col-12 col-md-9">Edit Gambar  &nbsp;
                                                        <a class="fas fa-images text-dark" href="../gambar/list_gambarBarang.php?id_barang=<?php echo $id_barang;?>">
                                                        </a>
                                                        </div>
                                    </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Keterangan</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <script src="../../vendor/tinymce/tinymce.min.js"></script>
                                        <script>tinymce.init({ selector: 'textarea#full-featured',
                                                                height: 350,
                                                                theme : 'silver',
                                                                plugins : 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
                                                                toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                                                                });
                                                                </script>
                                    <textarea id="full-featured" name="keterangan"><? echo $keterangan?></textarea>
                                    </div>
                                </div>
                                <!-- input id sama tanggal otomatis -->
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> update
                                    </button>
                                    <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                                    <input type="hidden" name="id_kategori" value=<?php echo $kategori; ?>>
                                    <input type="hidden" name="id_user" value=<?php echo $id_user;?>>
                                </div>
                            </form>
                        <?php }?>
                    </div>
                </div>
            <?php ?>
        </div>
    </body>
    <?php
include "../../js/page3.php";
?>
<script type="text/javascript">
    $( "#pilih" ).change(function() {
        if ( this.value == 4)
    {
        $("#append").append('<div id="hotelAppend"><div class="row form-group p-l-20" >'+
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
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="row form-group p-l-20">'+
        '<div class="col col-md-3">'+
            '<label for="select" class=" form-control-label">Tipe Bed</label>'+
        '</div>'+
        '<div class="col-12 col-md-9">'+
        '<select name="bed" class="form-control selectpicker">'+
            '<option value="">Pilih Fasilitas</option>'+
            '<option value="single">SINGLE ROOM</option>'+
            '<option value="twin">TWIN ROOM</option>'+
            '<option value="double">DOUBLE ROOM</option>'+
            '<option value="family">FAMILY ROOM</option>'+
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
</html>