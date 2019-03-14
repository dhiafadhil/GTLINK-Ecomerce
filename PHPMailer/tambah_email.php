<?php 
include "../../page3.php";
// session_start();
// if ( $_SESSION['level']  != 1){ 
//     header ("location:../../");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Title Page-->
    <title>Tambah Email</title>
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
                                    <form id="tambah_user" action="action.php" method = "POST">
                                        <div class="card">
                                        <div class="card-header">
                                            <strong>Tambah Email</strong></div>
                                                <br>
                                                </div>
                                                
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama</label></div>
                                                    <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="nama" placeholder="Masukkan Nama" class="form-control" required>    
                                                    </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Email</label>
                                                    </div>
                                                        <div class="col-12 col-md-9">
                                                        <input type="email"  name="email" placeholder="Email" class="form-control" required>
                                                        </div>
                                                        </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Subject</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                        <input type="text" id="text-input" name="subject" placeholder="Subject" class="form-control" required>
                                                        </div>
                                                            </div>
                                          
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Pesan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="pesan" id="textarea-input" rows="2" placeholder="" class="form-control" required></textarea>
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
    include "../js/page3.php";
?>;
</body>
</html>
