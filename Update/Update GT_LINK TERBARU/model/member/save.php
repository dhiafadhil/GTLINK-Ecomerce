<?php
  session_start();
  include "../../function.php";
  include "../config.php";
  $id_user  = $_POST['id_user'];
  $id_child  = $_SESSION['id_user'];
  $username  = $_POST['username'];
  $pass  = md5($_POST['pass']);
  $nama_user  = $_POST['nama_user'];
  $email  = $_POST['email'];
  $level  = $_POST['level'];
  $alamat  = $_POST['alamat'];
  $lokasi = $_POST['lokasi'];
  $no_bank  = $_POST['no_bank'];
  $nm_bank  = $_POST['nm_bank'];
  $atas_nama  = $_POST['atas_nama'];
  $mysqli  = "INSERT INTO tbl_user 
                          (id_child,
                          `username`,
                          `password`,
                          nama_user,
                          email,
                          `level`,
                          alamat,
                          lokasi,
                          no_bank,
                          nm_bank,
                          atas_nama) 
                VALUES ('$id_child',
                        '$username', 
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
  
  if ($result) {
    create_validasi(
       "Sukses",
       "Member berhasil ditambahkan.Mohon tunggu approval user oleh admin terlebih dahulu",
       "../../view/member/list_member.php"
       );
  } else {
    create_validasi(
    "Gagal",
    "Input member gagal");
  }
  clearstatcache();
  mysqli_close($conn);

  
?>