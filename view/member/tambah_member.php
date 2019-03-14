<?php 
include "../../model/config.php";
include "../../page3.php";

session_start();
$lvl = $_SESSION['level'];
if ( $_SESSION['level']  == 2 || $_SESSION['level'] == 5){ 
    header ("location:../../home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title Page-->
    <title>Tambah Member</title>
<?php
$query = "SELECT `name` FROM regencies ORDER BY id";
$data = mysqli_query($conn, $query);

?>
</head>
<!-- Tambah User -->
<body class='animsition'>
<?php 
include "../../menu3.php";
?>
    <!-- END HEADER DESKTOP-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="tambah_user" action="../../model/member/save.php" method="POST">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>Tambah Member</strong>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Username</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="username" placeholder="Masukkan Username"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="password-input" class=" form-control-label">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="password" id="password-input" name="pass" placeholder="Password" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Nama</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nama_user" placeholder="Masukkan Nama"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" id="email-input" name="email" placeholder="Masukkan Email"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Level</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="level" id="select" class="form-control" required>
                                    <?php if ($lvl == 1){ ?>
                                            <option value="0">Pilih Level</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Supplier</option>
                                            <option value="3">GT Branch</option>
                                            <option value="4">GT Agent</option>
                                            <option value="5">GT User</option>
                                        <?php } ?>
                                        <?php if ($lvl == 3){ ?>
                                            <option value="0">Pilih Level</option>
                                            <option value="4">GT Agent</option>
                                            <option value="5">GT User</option>
                                        <?php } ?>
                                        <?php if ($lvl == 4){ ?>
                                            <option value="0">Pilih Level</option>
                                            <option value="5">GT User</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Alamat</label>
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
                                    <textarea id="full-featured" name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3 ">
                                    <label for="text-input" class="form-control-label">Lokasi</label></div>
                                    <div class="col-12 col-md-9">
                                    <select name="lokasi" class="js-select2 au-select-dark">
                                        <option value="">Lokasi</option>
                                        <?php while ($row = mysqli_fetch_array($data)){?>
                                        <option value="<?php echo $row['name']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                        
                                        <?php } ?>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">No Rek Bank</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="no_bank" placeholder="Masukkan Nomer Rekening"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Nama Bank</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="nm_bank" placeholder="Masukkan Nama Bank"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Atas Nama</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="atas_nama" placeholder="Nama Pemilik Rekening"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm" value="Submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                            </div>
                    </form>
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
?>;
</body>

</html>