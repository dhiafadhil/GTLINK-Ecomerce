<?php 
//  if(!isset($_GET['id_user'])){
//      print_r("ada!");
//  }
include "../../page3.php";
include "../../model/config.php";
session_start();
if ( $_SESSION['level']  != 1){

    header ("location:../../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 

<?php



$id_profile = $_GET['id_profile'];

// Fetech user data based on id
$data = mysqli_query($conn, "SELECT * FROM tbl_profile WHERE id_profile = $id_profile");
while($user_data = mysqli_fetch_array($data))
{   
    
    $id_profile = $user_data['id_profile'];
    $logo = $user_data['logo'];
    $nama_profile = $user_data['nama_profile'];

}
?>


    <!-- Title Page-->
    <title>EDIT PROFILE</title>
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
                                        <form id="update" action="../../model/profile/edit.php?id_profile=<?php echo $id_profile; ?>"  method="POST"  enctype="multipart/form-data">   
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <strong>Edit Profile</strong></div>
                                                </div>
                                                    <div class="row form-group p-l-20">
                                                <div class="col col-md-3">
                                                    <label for="input" class=" form-control-label">Logo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="input"  name="logo" class="form-control" value="<img src="../../images/<?php echo $logo;?>">
                                                </div>
                                            </div>
                                            
                                                <div class="row form-group p-l-20 p-l-20">
                                                        <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama Profile</label>
                                                    </div>
                                                        <div class="col-12 col-md-9">
                                                        <input type="text" id="text-input" name="nama_profile" placeholder="Masukan Nama Profile" class="form-control" value="<?php echo $nama_profile;?>" required>
                                                        </div>
                                                        </div>
                                                    <!-- input id sama tanggal otomatis -->
                                                    
                                                            <div class="card-footer text-center" >
                                            <button  type="submit" class="btn btn-primary btn-sm" name="update"  value="update">
                                                <i class="fa fa-dot-circle-o"></i> update
                                            </button>
                                            <a class="btn btn-danger btn-sm text-white" onclick="javascript:window.history.back();"> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </body>
<?php 
include "../../js/page3.php";
?>
</html>



