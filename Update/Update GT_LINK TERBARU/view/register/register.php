<?php
session_start();
include "../../page3.php";
include "../../model/config.php";
include "../../function.php";

$query = "SELECT `name` FROM regencies ORDER BY id";
$data = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap p-b-5">
                    <div class="login-content">
                        <div class="login-logo">
                            <strong><h1>Register</h1></strong>
                        </div>
                        <div class="login-form">
                            <form action="../../model/registrasi/save.php" method="POST">
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
                                            <input type="password" id="password-input" name="pass" placeholder="Password" class="form-control"required>
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
                                        <label for="text-input" class=" form-control-label">Alamat</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="alamat" placeholder="Masukkan Alamat"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3 ">
                                        <label for="text-input" class="form-control-label">Lokasi</label></div>
                                        <div class="col-12 col-md-9">
                                        <select name="lokasi" class="form-control selectpicker">
                                            <option value="">Lokasi</option>
                                            <?php while ($row = mysqli_fetch_array($data)){?>
                                            <option value="<?php echo $row['name']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">No Rek Bank</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="no_bank" min="0" placeholder="Masukkan Nomer Rekening"
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
                                        <label for="text-input" class=" form-control-label">Nama Pemilik</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="atas_nama" placeholder="Atas Nama"
                                            class="form-control" required>
                                    </div>
                                </div>
                           <!--      <div class="g-recaptcha text-center" data-sitekey="6LfbfZUUAAAAACF7eas2-ohbc4JBDcQZQpYHDBam" required>
                                </div> -->
                                <br>
                                <div class="row">
                                    <div class="col md-2"></div>
                                  <div class="col md-4">
                                      <button class="au-btn au-btn--green" type="submit" name="login">sign</button> </div>
                               <div class="col md-4">
                                <button class="au-btn au-btn--blue m-b-20" onclick="history.back();">Back</button></div>
                                 <input type="hidden" name="date" value="<?php echo(date("Y-m-d")); ?>">
                                 
                                  <div class="col md-2"></div>
                                  </div>
                            </form>
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
<script type="text/javascript">
$(document).ready(function(){
    //KONDISI PENGECEKAN ALERTIFY AKAN DILAKUKAN DISINI
    // alert('Sukses');
 <?php
 echo echo_validasi();
 ?> 
});
</script>
</html>