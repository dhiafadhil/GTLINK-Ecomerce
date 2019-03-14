<?php
  include "../config.php";
  $id = $_POST['id_barang'];
  $id_user = $_POST['id_user'];
  $principal =  str_replace(",","",$_POST['principal']);
  $komisi1 =  str_replace(",","",$_POST['komisi1']);
  $komisi2 =  str_replace(",","",$_POST['komisi2']);
  $created_at = $_POST['created_at'];


    // update user data
$data = "UPDATE tbl_hotel SET  `status` = 1 WHERE id_hotel = '$id' ";
$result  = mysqli_query($conn, $data);
if ($result) {
    $komisi = "INSERT INTO tbl_komisi
                          (id_barang,
                          id_user,
                          principal,
                          komisi1,
                          komisi2,
                          created_at) 
                VALUES ('$id',
                        '$id_user',
                        '$principal',
                        '$komisi1',
                        '$komisi2',
                        '$created_at')";
  $result2 = mysqli_query($conn,$komisi);
  echo "Input berhasil";
  header('location:../../view/barang/list_approval.php');
} 
else { 
  echo "Input gagal";
}
  mysqli_close($conn);
    ?>