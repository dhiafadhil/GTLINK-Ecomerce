<?php
  include "../config.php";
  $id_gambar = $_POST['id_gambar'];
  $id_barang  = $_POST['id_barang'];
  
 
 function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
  }

  $file_ary = reArrayFiles($_FILES['gambar']);
      foreach($file_ary as $file){
        $lokasi_file = $file['tmp_name'];
        $name = round(microtime(true)) . '-' . end($file_post['name']);//fungsi untuk membuat nama acak
        $direktori   = "../../images/$name";
    
        if (!empty($lokasi_file)) {
            move_uploaded_file($lokasi_file,$direktori);
              // code C
              $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$id_barang', '$name')";
              $aksi = mysqli_query($conn,$mysqli);
            if (!$aksi) {
              $error++;
            }
            
        }
      }

  if($error == 0){
    header('location:../../view/gambar/list_gambar.php');
  }else{
    echo "Input gagal";
  }

  mysqli_close($conn);
?>