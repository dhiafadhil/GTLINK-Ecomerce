<?php 
include "../../page3.php";
session_start();
if ( $_SESSION['level']  != 1){ 
    header ("location:../../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Title Page-->
    <title>Tambah Kategori</title>
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
                        <div class="row p-l-">
                                <div class="col-lg-12 ">
                                    <form id="tambah_kategori" action="../../model/supplier/save.php" method = "POST">
                                        <div class="card-header text-center">
                                            <strong>Tambah Kategori</strong></div>
                                            <br>
                                                <div class="row form-group p-l-20 p-l-20">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nama Kategori</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nama_kategori" placeholder="Masukan Nama Kategori"
                                            class="form-control" required>
                                    </div>
                                </div>
                                                        <div class="card-footer text-center" >
                                        <button  type="submit" class="btn btn-primary btn-sm"  value="Submit">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button  class="btn btn-danger btn-sm" onclick="javascript:window.history.back();"> Back
                                            </button>
                                            </div>
                                        </div>
                                        </form>
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
