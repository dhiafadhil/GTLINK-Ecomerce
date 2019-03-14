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
$id = $_GET['id'];

$sqldata = "SELECT i.id_user,
            i.id_child,
            i.username,
            i.email,
            i.nama_user,
            i.level,
            i.lokasi,
            i.status_user,
            u.username
        From tbl_user i
        LEFT JOIN tbl_user u ON u.id_user = i.id_child
        Where i.id_user = '$id' AND i.status_user = 0";
$data = mysqli_query($conn, $sqldata);

while($user_data = mysqli_fetch_array($data)){

    $id_user = $user_data ['id_user'];
    $username1 = $user_data[2];
    $email1 = $user_data['email'];
    $nama_user = $user_data['nama_user'];
    $lokasi = $user_data['lokasi'];
    $top_user = $user_data['username'];
    $level = $user_data['level'];
    $status = $user_data['status'];


}
?>
    <title>Approval</title>

</head>
    <body class='animsition'>
        <?php
            include "../../menu3.php";
        ?>
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 r">
                            <form id="update" action="../../model/user/approval_confirm.php" method="POST">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong>Approval User</strong>
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">User Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="username" class="form-control"
                                            value="<?php echo $username1;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama User</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_user" class="form-control"
                                            value="<?php echo $nama_user;?>">
                                    </div>
                                </div>
                                  <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="text-input" name="email" class="form-control"
                                            value="<?php echo $email1;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Lokasi</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="lokasi" class="form-control" value="<?php echo $lokasi;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Top User</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="username" class="form-control" value="<?php echo $top_user;?>">
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Level</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="level" class="form-control" value="<?php echo $level;?>" >
                                    </div>
                                </div>
                                <div class="row form-group p-l-20">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Status</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea type="textarea" id="text-areainput" name="status" rows="1" class="form-control"><?php if ($status == 0)
                                                {
                                                echo "Un Publish";
                                                }
                                                else {
                                                    echo "Publish" ;
                                                    } ; ?>  </textarea>
                                    </div>
                                </div>
                        
                                <input type="hidden" name="id_user" value=<?php echo $id_user;?>>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-sm" name="update" value="update">
                                        <i class="fa fa-dot-circle-o"></i> Approval
                                    </button>
                            </form>
                            <button class="btn btn-danger btn-sm" onclick="javascript:window.history.back();">
                            Back
                            </button>
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