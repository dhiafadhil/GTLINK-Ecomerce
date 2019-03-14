
<?php
  include "../config.php";

  $id_kategori = $_POST['id_kategori'];
  $nama_kategori  = $_POST['nama_kategori'];

  $data = "UPDATE tbl_kategori SET nama_kategori='$nama_kategori' WHERE id_kategori = $id_kategori";
  $result  = mysqli_query($conn, $data);

    if ($result) {

      echo "Input berhasil";
      
      header('location:../../view/supplier/list_kategori.php');
      

    } else {

      echo "Input gagal";

    }
    
    mysqli_close($conn);
?>