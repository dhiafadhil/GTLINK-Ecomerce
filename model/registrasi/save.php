<?php
session_start();
include "../../function.php";
include "../config.php";
$query = "SELECT id_user,level from tbl_user WHERE level = 6";
$data = mysqli_query($conn, $query);
$id_child = 0;
while($user_data = mysqli_fetch_array($data)) {
$id_child = $user_data[0];
}
$id_child1 = $id_child;
$username  = $_POST['username'];
$pass  = md5($_POST['pass']);
$nama_user  = $_POST['nama_user'];
$email  = $_POST['email'];
$level  = 5;
$created_at = date('Y-m-d');
$alamat  = $_POST['alamat'];
$lokasi = $_POST['lokasi'];
$no_bank  = $_POST['no_bank'];
$nm_bank  = $_POST['nm_bank'];
$status_user = 0;
$atas_nama = $_POST['atas_nama'];

$user_check= mysqli_num_rows(mysqli_query($conn, "SELECT username FROM tbl_user WHERE username='$username'"));

$email_check = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM tbl_user WHERE email='$email'"));
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {
      $secret = '6LfEVpcUAAAAADjUGbFGm7lZVNf0ycQGc3UH0qGj';
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      $responseData = json_decode($verifyResponse);
      if($responseData->success)
        {
        if($user_check > 0) {

            echo "<script>alert('Maaf username telah digunakan');history.go(-1)</script>";

          } else if ($email_check > 0) {

                echo "<script>alert('Maaf email telah digunakan');history.go(-1)</script>";

          } else {

          $mysqli  = "INSERT INTO tbl_user
                                  (id_child,
                                    username,
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
                                '$status_user',
                                '$atas_nama')";
          
          $result  = mysqli_query($conn, $mysqli);
          
                  if ($result) {
                    include "../../email_user.php";
                    create_validasi (
                    "Sukses",
                    "Berhasil Registrasi,Account bisa digunakan setelah di approve oleh Admin GT-LINK<br>
                    Terima Kasih",
                    // "../../view/user/list_user.php"
                    "../../view/user/login.php");
                  } else {

                    echo "Input gagal";

                  }
                }
        } 
      } 
      else {
        echo "<script>alert('Rechapcha belum di isi');history.go(-1)</script>";
        } 
clearstatcache();
mysqli_close($conn);

?>