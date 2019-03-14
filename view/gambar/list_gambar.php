<?php
include "../../page3.php";
include "../../model/config.php";

session_start();
if ( $_SESSION['level']  > 2 ){

    header ("location:../../home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- table -->
    <?php

$tipe = $_GET['tipe_room'];
$id = $_GET['id_room'];

if(isset($id)){
$query = "SELECT * FROM tbl_room  WHERE id_room  = $id";
$data = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($data)){
        
        $id_room = $row['id_room'];
    
}

}
else if(empty($id)){


}
$no = 1;

    ?>

</head>

<body class="animsition">
    <?php
include "../../menu3.php";
?>

    <!-- END HEADER DESKTOP-->

    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                List Gambar Tipe Room
                                <?php echo $tipe; ?>
                            </h3>
                            <div class="table-responsive table-responsive-data2 m-b-10 p-b-10 p-l-20 p-r-20">
                                <table class="table table-responsive-data2" style="font-size:14">
                                    <thead>
                                        <tr class="">
                                            <th class="text-center">NO</th>
                                            <th class="text-center">Gambar</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $img = "SELECT * FROM tbl_gambar WHERE id_barang = $id";
                                        $imgResult = mysqli_query($conn,$img);
                                        ?>
                                    <?php
                                                while ($rowImg = mysqli_fetch_array($imgResult)){
                                                
                                                $id_gambar = $rowImg['id_gambar'];
                                            ?>
                                    <tbody class="table table-borderless table-striped table-earning">
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++;; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php  if (!empty($rowImg['gambar']) && file_exists('../../images/'.$rowImg['gambar'])) { ?>
                                                <img src="../../images/<?php echo $rowImg['gambar']; ?>" width="64px"
                                                    height="64px" border="0">
                                                <?php } else { ?>
                                                <img src="../../images/no_image.png" width="64px" height="64px" border="0" />
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" id="confirmation" href="../../model/gambar/delete.php?id_gambar=<?php echo $id_gambar;?>&id_room=<?php echo $id;?>" role="button"
                                                    style="font-size:10px; padding-top:1.5px;">Delete</a></td>
                                        </tr>
                                    </tbody>
                                    <?php
                                            }
                                        ?>
                                </table>
                                <tr class="spacer"></tr>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                    </div>
                                    <div class="col-12 col-md-4 text-center mt-3 mb-3">Add Gambar
                                        <form action="../../model/gambar/edit.php?id_room=<?php echo $id_room; ?>"
                                            method="POST" enctype="multipart/form-data">
                                            <input type="file" id="input" name="gambar[]" multiple="" placeholder="Masukan Gambar"
                                                class="form-control" required>
                                            <br>
                                            <div class="table-data-feature">
                                                <button id="payment-button" type="submit" class="btn btn-sm btn-info btn-block">
                                                    Upload
                                                </button>
                                        </form>
                                    </div>
                                    <br>
                                    <div class="table-data-feature">
                                    <form action="../barang/edit_room.php?id_room=<?php echo $id_room; ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <button id="payment-button" type="submit" class="btn btn-sm btn-danger btn-block">&nbsp;Back
                                        </button>
                                    </form>
                                </div>
                                </div>
                                <div class="col col-md-4">
                                    <label for="input" class=" form-control-label"></label>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <tr class="spacer"></tr>
                            </div>
                        </div>
                        <!-- END PAGE CONTAINER-->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
include "../../js/page3.php";
?>
<script type="text/javascript">
$("#confirmation").click(function(){
        return confirm('Are you sure?');
    });
</script>
</body>

</html>
<!-- end document-->