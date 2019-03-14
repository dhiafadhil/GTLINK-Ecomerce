<?php
  session_start();
  include "../../function.php";
  include "../config.php";
  $id = $_POST['id_user'];
  $email = $_POST['email'];

    // update user data
$data = "UPDATE tbl_user SET  `status_user` = 1 WHERE id_user = '$id' ";
$result  = mysqli_query($conn, $data);

  if ($result) {
  include "../../email_approve_user.php";
  create_validasi (
  "Sukses",
  "Data berhasil di approve",
  "../../view/user/list_approval_user.php");
  } 
  else { 
  echo "Input gagal";
  }
  clearstatcache();
  mysqli_close($conn);
    ?>