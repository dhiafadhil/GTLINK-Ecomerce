<?php
//  if(!isset($_GET['id_user'])){
//      print_r("ada!");
//  }
include "../../page3.php";
include "../../model/config.php";
session_start();
if ( $_SESSION['level']  != 1){

    header ("location:../../home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT tbl_user.*,regencies.name FROM tbl_user
                            INNER JOIN regencies ON
                            tbl_user.lokasi = regencies.name WHERE id_user = $id");
$datalokasi = mysqli_query($conn, "SELECT regencies.name FROM regencies ORDER BY id");

while($user_data = mysqli_fetch_array($data))
{
    $user_name = $user_data['username'];
    $pass = $user_data['password'];
    $nama_user = $user_data['nama_user'];
    $email = $user_data['email'];
    $level = $user_data['level'];
    $alamat = $user_data['alamat'];
    $tanggal = $user_data['created_at'];
    $no_bank = $user_data['no_bank'];
    $lokasi = $user_data['lokasi'];
    $nm_bank = $user_data['nm_bank'];
}
?>
    <!-- Title Page-->
    <title>EDIT USER</title>
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
                            <form id="update" action="../../model/user/edit.php" method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Edit User</strong></div>
                                </div>
                                <div class="row form-group p-l-20 ">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Username</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="username" placeholder="Masukkan Username"
                                            class="form-control" value="<?php echo $user_name;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20 p-l-20">
                                    <div class="col col-md-3">
                                        <label for="password-input" class=" form-control-label">Password</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="password-input" name="pass" placeholder="Password"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_user" placeholder="Masukkan Nama"
                                            class="form-control" value="<?php echo $nama_user;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="email-input" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="email-input" name="email" placeholder="Masukkan Email"
                                            class="form-control" value="<?php echo $email;?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Level</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="level" id="select" class="form-control" required>
                                            <?php
                                                            if($level == 1){
                                                                echo '<option value="'.$level.'">Admin</option>';
                                                            }
                                                            else if ($level == 2){
                                                                echo '<option value="'.$level.'">Supplier</option>';
                                                            } else if ($level == 3){
                                                                echo '<option value="'.$level.'">GT Branch</option>';
                                                            } else if ($level == 4){
                                                                echo '<option value="'.$level.'">GT Agent</option>';
                                                            } else {
                                                                echo "GT User";
                                                            }
                                            ?>
                                            <option value="1">Admin</option>
                                            <option value="2">Supplier</option>
                                            <option value="3">GT Branch</option>
                                            <option value="4">GT Agent</option>
                                            <option value="5">GT User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="date_create" class=" form-control-label">Tanggal</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date-$tanggal" id="date-create" name="createdadd" class="form-control"
                                            value="<?php echo $tanggal;?>" disabled>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Alamat</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea type="textarea" name="alamat" id="full-featured" rows="3" class="form-control"
                                            required><?php echo $alamat;?></textarea>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                <div class="col col-md-3 ">
                                    <label for="text-input" class=" form-control-label">Lokasi</label></div>
                                    <div class="col-12 col-md-9">
                                    <select name="lokasi" class="js-example-basic-single">
                                        <option value="<?php echo $lokasi; ?>"><?php echo $lokasi; ?></option>
                                        <?php while ($row = mysqli_fetch_array($datalokasi)){?>
                                        <option value="<?php echo $row['name']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">No Rek Bank</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input"  min="0" name="no_bank" placeholder="Masukkan Nomer Rekening"
                                            class="form-control" value="<?php echo $no_bank; ?>" required>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama Bank</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nm_bank" placeholder="Masukkan Nama Bank"
                                            class="form-control" value="<?php echo $nm_bank; ?>" required>
                                    </div>
                                </div>
                                <!-- input id sama tanggal otomatis -->
                                <input type="hidden" name="id_user" value=<?php echo $id;?>>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> update
                                    </button>
                                    <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    <?php
include "../../js/page3.php";
?>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</body>
</html>