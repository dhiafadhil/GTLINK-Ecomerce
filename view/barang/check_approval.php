<?php

include "../../page3.php";
include "../../model/config.php";

session_start();

if (empty($_SESSION['level'])){
    header("location:../../view/user/login.php");
}
if ( $_SESSION['level']  == 2){
    header ("location:../../home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$id_user = $_SESSION['id_user'];
$id = $_GET['id'];

if(isset($id) && empty($id_room)) {

$sqldata = "SELECT tbl_barang.id_user,
                    tbl_user.nama_user,
                    tbl_barang.id_kategori,
                    tbl_barang.id_barang,
                    tbl_barang.nama_barang,
                    tbl_barang.stock,
                    tbl_barang.harga,
                    tbl_barang.keterangan,
                    tbl_barang.status,
                    tbl_barang.created_at,
                    tbl_kategori.id_kategori,
                    tbl_kategori.nama_kategori
FROM tbl_barang
    INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
    INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_barang.id_kategori
    WHERE tbl_barang.id_barang = '$id' AND `status` = 0";
$data = mysqli_query($conn, $sqldata);

while($user_data = mysqli_fetch_array($data)){

    $id_user = $user_data ['id_user'];
    $nama_user = $user_data ['nama_user'];
    $id_kategori = $user_data['id_kategori'];
    $nama_kategori = $user_data['nama_kategori'];
    $id_barang = $user_data['id_barang'];
    $nama_barang = $user_data['nama_barang'];
    $stock = $user_data['stock'];
    $harga = $user_data['harga'];
    $keterangan = $user_data['keterangan'];
    $status = $user_data['status'];
    $created_at = $user_data['created_at'];
    $updated_at = $user_data['updated_at'];

}
}

?>
<title>Approval</title>
</head>
<body class='animsition'>
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 r">
                        <form id="update" action="../../model/barang/approval_confirm.php" method="POST">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Approval</strong>
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
                                    <input type="text" id="text-input" name="nama_barang" class="form-control" value="<?php echo $nama_barang;?>"
                                        disabled>
                                </div>
                            </div>
                            <div class="row form-group p-l-20">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Stock</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" min="0" id="text-input" name="stock" class="form-control"
                                        value="<?php echo $stock;?>"
                                    disabled>
                                </div>
                            </div>
                            <div class="row form-group p-l-20">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Harga</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" min="0" id="text-input" name="harga" class="form-control" value="<?php echo number_format($harga); ?>"
                                        readonly>
                                </div>
                            </div>
                            <div class="row form-group p-l-20">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Keterangan </label>
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
                                    <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" name="principal" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group p-l-20">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Komisi 1</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" name="komisi1" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group p-l-20">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Komisi 2</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" min="0" id="inputku" onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" name="komisi2" class="form-control"
                                        required>
                                </div>
                            </div>
                            <!-- input id sama tanggal otomatis -->
                            <?php if($id_kategori != 4){?>
                            <input type="hidden" name="id_barang" value=<?php echo $id;?>>
                            <? } ?>
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