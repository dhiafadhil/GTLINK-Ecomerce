<?php
  include "../config.php";
  $id_profile = $_POST['id_profile'];
  $logo = $_FILES['logo']['name'];
  $nama_profile  = $_POST['nama_profile'];

  $mysqli = "INSERT INTO tbl_profile (logo,nama_profile) VALUES ('$logo','$nama_profile')";
  $aksi = mysqli_query($conn,$mysqli);

  move_uploaded_file($_FILES['logo']['tmp_name'],'../../images/'.$logo);
  
  header('location:../../view/profile/list_profile.php');
  mysqli_close($conn);
?>