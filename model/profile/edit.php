
<?php
  include "../config.php";
  $id_profile = $_GET['id_profile'];
  $nama_profile = $_POST['nama_profile'];
    //ambil data foto dari form
    $name = $_FILES['logo']['name'];
    $tmp = $_FILES['logo']['tmp_name'];
    //Rename file dengan menambahkan tanggal dan jam upload
    $query = "UPDATE tbl_profile SET nama_profile='$nama_profile', alamat='$alamat', kota='$kota', telp='$telp', email='$email', kode_pos='$kode_pos' WHERE id_profile=$id_profile";
    $query2 = mysqli_query($conn, $query);
    $data=mysqli_fetch_array($query2);
  if (!empty($name)){
    $hapus= "SELECT * FROM tbl_profile WHERE id_profile=$id_profile";
    // menghapus gambar yang lama
    $query1 = mysqli_query($conn, $hapus);
    $nama_logo=mysqli_fetch_array($query1);
    // nama field gambar
    $lokasi=$nama_logo['logo'];
    // alamat tempat foto
      $hapus_logo="../../images/$lokasi";
      // script untuk menghapus gambar dari folder
      @unlink($hapus_logo);
        move_uploaded_file($tmp,'../../images/'.$name);
        $query = "UPDATE tbl_profile SET logo='$name' WHERE id_profile=$id_profile";
        $query2 = mysqli_query($conn, $query);
        $data=mysqli_fetch_array($query2);
    // Set path folder tempat menyimpan fotonya
  // update user data
        }
      header('location:../../view/profile/list_profile.php');
          mysqli_close($conn);
      
  ?>