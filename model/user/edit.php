
<?php
    session_start();
    include "../../function.php";
    include "../config.php";

    $id = $_POST['id_user'];
    $username  = $_POST['username'];
    $nama_user  =$_POST['nama_user'];
    $email  = $_POST['email'];
    $level  = $_POST['level'];
    $alamat  = $_POST['alamat'];
    $lokasi = $_POST['lokasi'];
    $no_bank  = $_POST['no_bank'];
    $nm_bank  = $_POST['nm_bank'];
    
    
    if( $_POST['pass'] != null ) {
      
      $pass  = md5($_POST['pass']);

      $data = "UPDATE tbl_user SET username='$username', 
                                  `password`='$pass', 
                                  nama_user='$nama_user', 
                                  email='$email', 
                                  `level`='$level', 
                                  alamat='$alamat', 
                                  lokasi='$lokasi', 
                                  no_bank='$no_bank', 
                                  nm_bank='$nm_bank' 
              WHERE id_user = $id";

    } 
    else {

    $data = "UPDATE tbl_user SET username='$username', 
                                  nama_user='$nama_user', 
                                  email='$email', 
                                  `level`='$level', 
                                  alamat='$alamat', 
                                  lokasi='$lokasi', 
                                  no_bank='$no_bank', 
                                  nm_bank='$nm_bank' 
              WHERE id_user = $id";
    }        
    $result  = mysqli_query($conn, $data);

    if ($result) {
    create_validasi(
    "Sukses",
    "Edit user berhasil",
    "../../view/user/list_user.php");

    } else {

    echo "Input gagal";

    }
clearstatcache();
  mysqli_close($conn);
  
  ?>