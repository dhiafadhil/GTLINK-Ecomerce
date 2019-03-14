<?php

include "../../page3.php";
include "../../model/config.php";
session_start();

if (empty($_SESSION['level'])){
    header("location:../../view/user/login.php");
}
else if ( $_SESSION['level']  == 2){
    header ("location:../../home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
$id_user = $_SESSION['id_user'];
$id_room = $_GET['id_room'];
$id_hotel = $_GET['id_hotel'];

$queryHotel = "SELECT tbl_hotel.*,
                    tbl_room.id_room,
                    tbl_room.tipe_room,
                    tbl_room.tipe_bed,
                    tbl_room.stock_room,
                    tbl_room.harga_room,
                    tbl_user.nama_user,
                    tbl_kategori.nama_kategori,
                    tbl_kategori.id_kategori
FROM tbl_hotel INNER JOIN tbl_room
                ON tbl_room.id_hotel = tbl_hotel.id_hotel
                INNER JOIN tbl_user
                ON tbl_user.id_user = tbl_hotel.id_user
                INNER JOIN tbl_kategori
                ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
Where tbl_hotel.status = 0 AND tbl_room.id_room  = $id_room ";
$dataHotel = mysqli_query($conn,$queryHotel);

while($data_hotel = mysqli_fetch_array($dataHotel)){

        $id_kategori = $data_hotel['id_kategori'];
        $nama_kategori = $data_hotel['nama_kategori'];
        $nama_user = $data_hotel['nama_user'];
        $id_hotel = $data_hotel['id_hotel'];
        $nama_hotel = $data_hotel['nama_hotel'];
        $room = $data_hotel['tipe_room'];
        $bed = $data_hotel['tipe_bed'];
        $stock_room = $data_hotel['stock_room'];
        $harga_room = $data_hotel['harga_room'];
        $keterangan = $data_hotel['keterangan'];
        $status = $data_hotel['status'];
        $created_at = $data_hotel['created_at'];
        $updated_at = $data_hotel['update_at'];
}

?>
<!-- Title Page-->
<title>Approval</title>
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
                                <form id="update" action="../../model/barang/approval_hotel.php" method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Approval</strong></div>
                                </div>
                                <div class="row form-group p-l-20 ">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Kategori</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="kategori" disabled class="form-control"
                                            value="<?php echo $nama_kategori;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama User</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="id_user" disabled class="form-control"
                                            value="<?php echo $nama_user;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama Barang</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_barang" class="form-control"
                                            value="<?php echo $nama_hotel;?>" disabled>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Keterangan</label>
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
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Status</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea type="textarea" id="text-areainput" name="status" rows="1" class="form-control"
                                            disabled><?php if ($status == 0)
                                                {
                                                echo "Un Publish";
                                                }
                                                else {
                                                    echo "Publish" ;
                                                    } ; ?>  </textarea>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tanggal Pemesanan</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="created_at" class="form-control" value="<?php echo $created_at;?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Principal</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                                        name="principal" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Komisi 1</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                                        name="komisi1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Komisi 2</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" 
                                        name="komisi2" class="form-control" required>
                                    </div>
                                </div>
                                <!-- input id sama tanggal otomatis -->
                                <input type="hidden" name="id_barang" value=<?php echo $id_hotel;?>>
                                <input type="hidden" name="id_user" value=<?php echo $id_user;?>>
                                <input type="hidden" name="created_at" value=<?php echo $created_at?>>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> Approval
                                    </button>
                                    </form>
                                    <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
include "../../js/page3.php";
?>
</html>