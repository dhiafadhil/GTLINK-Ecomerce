<?php
session_start();
  include "../../function.php";
  include "../config.php";

  $username  = $_POST['username'];
  $pass  = md5($_POST['pass']);
  $nama_user  = $_POST['nama_user'];
  $email  = $_POST['email'];
  $level  = $_POST['level'];
  $alamat  = $_POST['alamat'];
  $lokasi = $_POST['lokasi'];
  $no_bank  = $_POST['no_bank'];
  $nm_bank  = $_POST['nm_bank'];
  $atas_nama = $_POST['atas_nama'];
  $status = 1;

  if($_SESSION['level']==1){

  $user_check= mysqli_num_rows(mysqli_query($conn, "SELECT username FROM tbl_user WHERE username='$username'"));

  $email_check = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM tbl_user WHERE email='$email'"));

        if($user_check > 0) {

            echo "<script>alert('Maaf username telah digunakan');history.go(-1)</script>";

          } else if ($email_check > 0) {

                echo "<script>alert('Maaf email telah digunakan');history.go(-1)</script>";

          } else {

  $mysqli  = "INSERT INTO tbl_user
                          (username,
                          `password`,
                          nama_user,
                          email,
                          `level`,
                          alamat,
                          lokasi,
                          no_bank,
                          nm_bank,
                          status_user,
                          atas_nama)
                VALUES ('$username',
                        '$pass',
                        '$nama_user',
                        '$email',
                        '$level',
                        '$alamat',
                        '$lokasi',
                        '$no_bank',
                        '$nm_bank',
                        '$status',
                        '$atas_nama')";

  $result  = mysqli_query($conn, $mysqli);

  if ($result) {
    create_validasi(
    "Sukses",
    "Input user berhasil",
    "../../view/user/list_user.php");

  } else {
    create_validasi(
    "Gagal",
    "Input ulang ajah lagi",
    "../../view/user/tambah_user.php");
  }

  clearstatcache();
  mysqli_close($conn);
    
  }
} else {
  $user_check= mysqli_num_rows(mysqli_query($conn, "SELECT username FROM tbl_user WHERE username='$username'"));

  $email_check = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM tbl_user WHERE email='$email'"));
        if($user_check > 0) {

            echo "<script>alert('Maaf username telah digunakan');history.go(-1)</script>";

          } else if ($email_check > 0) {

                echo "<script>alert('Maaf email telah digunakan');history.go(-1)</script>";

          } else {

  $mysqli  = "INSERT INTO tbl_user
                          (username,
                          `password`,
                          nama_user,
                          email,
                          `level`,
                          alamat,
                          lokasi,
                          no_bank,
                          nm_bank,
                          atas_nama)
                VALUES ('$username',
                        '$pass',
                        '$nama_user',
                        '$email',
                        '$level',
                        '$alamat',
                        '$lokasi',
                        '$no_bank',
                        '$nm_bank',
                        '$atas_nama')";

  $result  = mysqli_query($conn, $mysqli);
}
}


?>