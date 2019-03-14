<?php
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

<!-- table -->
<?php
$query = "SELECT * FROM tbl_profile";
$data = mysqli_query($conn, $query);
$count = mysqli_num_rows($data);
$no = 1;

?>
</head>

<body class="animsition">
<?php
include "../../menu3.php";
?> 

<div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                            LIST PROFILE
                            </h3>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 text-center">
                                <?php if($count ==  NULL){ ?>
                                <a class="item" href="tambah_profile.php"><i class="fas fa-users text-dark"></i></a>&nbsp;Add Profile
                                <?php } ?>
                                </div>
                            </div>
                            <div class="container-fluid">
                            <table class="table table-responsive-data2">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">Logo</th>
                                        <th class="text-center">Nama Profile</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <?php while ($row = mysqli_fetch_array($data)){?>
                                    <tbody>
                                    <tr> 
                                        <td class="text-center"><?php echo $no++;; ?> </td>
                                        <td class="text-center">
                                            <?php  if (!empty($row['logo']) && file_exists('../../images/'.$row['logo'])) { ?>
                                                <img src="../../images/<?php echo $row['logo']; ?>" width="50px" height="50px" border="0">
                                            <?php } else { ?>
                                                <img src="../../images/no_image.png" width="50px" height="50px" border="0"/>
                                            <?php } ?> 
                                            <td class="text-center"><?php echo $row['nama_profile']; ?></td>
                                            <td class="text-center table-data-feature">
                                            <a class="item" href="../../view/profile/edit_profile.php?id_profile=<?php echo $row['id_profile'];?>">
                                                <i class="zmdi zmdi-edit text-primary">
                                                </i>
                                            </a>
                                            <a class="item" id="confirmation" href="../../model/profile/delete.php?id_profile=<?php echo $row['id_profile']?>">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </a>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>               
        </div>
    </div>
<br>

<?php
include "../../js/page3.php";
?> 
<script type="text/javascript">
    $('#confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
</body>
</html>
<!-- end document-->