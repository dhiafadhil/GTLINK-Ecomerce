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
$id_hotel = $_GET['id_hotel'];

if (!empty($id_hotel)){

    // DATA UNTUK HOTEL
    $dataHotel = mysqli_query($conn, "SELECT tbl_hotel.id_kategori,
                                        tbl_hotel.nama_hotel,
                                        tbl_hotel.id_user,
                                        tbl_hotel.keterangan,
                                        tbl_hotel.status,
                                        tbl_hotel.id_kategori,
                                        tbl_room.harga_room,
                                        tbl_room.stock_room,
                                        tbl_kategori.id_kategori,
                                        tbl_kategori.nama_kategori
    FROM tbl_hotel INNER JOIN tbl_room
                    ON tbl_hotel.id_hotel = tbl_room.id_hotel
                    INNER JOIN tbl_kategori
                    ON tbl_hotel.id_kategori = tbl_kategori.id_kategori
                    WHERE tbl_hotel.id_hotel = '$id_hotel'  ");

    while($user_data = mysqli_fetch_array($dataHotel)){

        $iduser_hotel = $user_data['id_user'];
        $kategori = $user_data['id_kategori'];
        $nama_kategori = $user_data['nama_kategori'];
        $nama_hotel = $user_data['nama_hotel'];
        $stock_room = $user_data['stock_room'];
        $harga_room = $user_data['harga_room'];
        $keterangan_hotel = $user_data['keterangan'];

}
// END DATA HOTEL
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
                        <div class="col-lg-12 r">
                            <form id="update" action="../../model/barang/edit_hotel.php?id_hotel=<?php echo $id_hotel; ?>"
                                method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Edit Barang</strong></div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_hotel"
                                        class="form-control" value="<?php echo $nama_hotel;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20 ">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Kategori</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_kategori"
                                        class="form-control" value="<?php echo $nama_kategori;?>" disabled>
                                    </div>
                                </div>
                                <div id ="append"></div>
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
                                    <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                                    <input type="hidden" name="id_kategori" value=<?php echo $kategori; ?>>
                                    <input type="hidden" name="id_user" value=<?php echo $iduser_hotel;?>>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php ?>
        </div>
    </body>
<?php
include "../../js/page3.php";
?>
</html>