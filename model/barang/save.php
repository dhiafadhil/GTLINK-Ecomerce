<?php
  session_start();
  include "../config.php";
  $level = $_SESSION['level'];

  if($level == 1) {
      $id_user  =  $_POST['id_user'];
      $id_kategori  = $_POST['nama_kategori'];
      $nama_barang  = $_POST['nama_barang'];
      $stock  = $_POST['stock'];
      $harga  = str_replace(",","",$_POST['harga']);
      $keterangan  = $_POST['keterangan'];
      $status  = 0;
      $created_at = date('Y-m-d');
      $tipe_room = $_POST['room'];
      $tipe_bed = $_POST['bed'];
      $harga_hotel = str_replace(",","",$_POST['harga']);


  if($id_kategori != 4) {

    mysqli_autocommit($conn,true);
    $flag = true;

    $sql_id = "SELECT MAX(id_barang) FROM tbl_barang";
    $queryId = mysqli_query($conn,$sql_id);
    $kode_barang = mysqli_fetch_array($queryId);

    if($kode_barang) {
        
        $nilai = substr($kode_barang[0], 1);
        $kode = (int) $nilai;
        $kode = $kode + 1;
        $auto_kode = "B" .str_pad($kode, 4, "0", STR_PAD_LEFT);

      }

      else {

        $auto_kode = "B0001";
      
      }

    $mysqli  = "INSERT INTO tbl_barang
                            (id_barang,
                            id_user,
                            id_kategori,
                            nama_barang,
                            stock,
                            harga,
                            keterangan,
                            status) 
                VALUES ('$auto_kode',
                        '$id_user',
                        '$id_kategori', 
                        '$nama_barang', 
                        '$stock',
                        '$harga',
                        '$keterangan',
                        '$status')";
    $result  = mysqli_query($conn, $mysqli);

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
          $name = rand(1,1234567890) . '-' . $file['name'];//fungsi untuk membuat nama acak
          $direktori   = "../../images/$name";
          
          if (!empty($lokasi_file)) {
    
              if (move_uploaded_file($lokasi_file,$direktori)){
              // code C
                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$auto_kode', '$name')";
                $aksi = mysqli_query($conn,$mysqli);
    
              } else {

                $flag = false;
                echo "EROR";
              
              }
            }
          }

    if ($result == TRUE   && $aksi == TRUE) {

      mysqli_commit($conn);

    } else {

      mysqli_rollback($conn);
      
    }

    echo "Input berhasil";
    header('location:../../view/barang/list_barang.php');

}

  else if($id_kategori == 4){

    mysqli_autocommit($conn,true);
    $flag = true;

    $sql_id = "SELECT MAX(id_hotel) FROM tbl_hotel";
    $queryId = mysqli_query($conn,$sql_id);
    $kode_hotel = mysqli_fetch_array($queryId);

    if($kode_hotel) {
        
        $nilai = substr($kode_hotel[0], 1);
        $kode = (int) $nilai;

        $kode = $kode + 1;
        $auto_kodeHotel = "H" .str_pad($kode, 4, "0", STR_PAD_LEFT);

      }

      else {

        $auto_kodeHotel = "H0001";
      
      }


  $mysqli2  = "INSERT INTO tbl_hotel
                              (id_hotel,
                              id_kategori,
                                id_user,
                                nama_hotel,
                                keterangan,
                                status) 
                  VALUES ('$auto_kodeHotel',
                          '$id_kategori',
                          '$id_user', 
                          '$nama_barang',
                          '$keterangan',
                          '$status')";
  $result2  = mysqli_query($conn, $mysqli2);

  $mysqli3  = "INSERT INTO tbl_room 
                          (id_hotel,
                          tipe_room,
                          tipe_bed,
                          harga_room,
                          stock_room) 
                VALUES ('$auto_kodeHotel',
                        '$tipe_room',
                        '$tipe_bed',
                        '$harga_hotel',
                        '$stock')";
  $result3  = mysqli_query($conn, $mysqli3);
  
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
          $name = rand(1,1234567890) . '.' . $file['name'];//fungsi untuk membuat nama acak
          $direktori   = "../../images/$name";
          
          if (!empty($lokasi_file)) {
    
              if (move_uploaded_file($lokasi_file,$direktori)){
              // code C
                $queryRoom = "SELECT id_room FROM tbl_room WHERE id_hotel = '$auto_kodeHotel'";
                $resultRoom = mysqli_query($conn,$queryRoom);
                
                while($row =mysqli_fetch_array($resultRoom)) {
                  
                  $id_room = $row['id_room'];
                }

                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$id_room', '$name')";
                $aksi = mysqli_query($conn,$mysqli);
    
              } else {
    
                $flag = false;
                echo "EROR";
    
              }
    
              if (!$aksi) {
    
                $error++;
    
              }
          }
        }

      if($result2 == TRUE && $result3 == TRUE && $resultRoom == TRUE && $aksi == TRUE){

        mysqli_commit($conn);

      } else {

        mysqli_rollback($conn);

      }

    echo "Input berhasil";
    header('location:../../view/barang/list_hotel.php');

  } else {

    echo "Input gagal";

  }
    }
    else if($level == 2)  {
  $id_user  =  $_SESSION['id_user'];
  $id_kategori  = $_POST['nama_kategori'];
  $nama_barang  = $_POST['nama_barang'];
  $stock  = $_POST['stock'];
  $harga  = str_replace(",","",$_POST['harga']);
  $keterangan  = $_POST['keterangan'];
  $status  = 0;
  $created_at = date('Y-m-d');
  $tipe_room = $_POST['room'];
  $tipe_bed = $_POST['bed'];
  $harga_hotel = str_replace(",","",$_POST['harga']);


  if($id_kategori != 4) {

    mysqli_autocommit($conn,true);
    $flag = true;

    $sql_id = "SELECT MAX(id_barang) FROM tbl_barang";
    $queryId = mysqli_query($conn,$sql_id);
    $kode_barang = mysqli_fetch_array($queryId);

    if($kode_barang) {
        
        $nilai = substr($kode_barang[0], 1);
        $kode = (int) $nilai;
        $kode = $kode + 1;
        $auto_kode = "B" .str_pad($kode, 4, "0", STR_PAD_LEFT);

      }

      else {

        $auto_kode = "B0001";
      
      }

    $mysqli  = "INSERT INTO tbl_barang
                            (id_barang,
                            id_user,
                            id_kategori,
                            nama_barang,
                            stock,
                            harga,
                            keterangan,
                            status) 
                VALUES ('$auto_kode',
                        '$id_user',
                        '$id_kategori', 
                        '$nama_barang', 
                        '$stock',
                        '$harga',
                        '$keterangan',
                        '$status')";
    $result  = mysqli_query($conn, $mysqli);

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
          $name = rand(1,1234567890) . '-' . $file['name'];//fungsi untuk membuat nama acak
          $direktori   = "../../images/$name";
          
          if (!empty($lokasi_file)) {
    
              if (move_uploaded_file($lokasi_file,$direktori)){
              // code C
                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$auto_kode', '$name')";
                $aksi = mysqli_query($conn,$mysqli);
    
              } else {

                $flag = false;
                echo "EROR";
              
              }
            }
          }

    if ($result == TRUE   && $aksi == TRUE) {

      mysqli_commit($conn);

    } else {

      mysqli_rollback($conn);
      
    }

    echo "Input berhasil";
    header('location:../../view/barang/list_barang.php');

}

  else if($id_kategori == 4){

    mysqli_autocommit($conn,true);
    $flag = true;

    $sql_id = "SELECT MAX(id_hotel) FROM tbl_hotel";
    $queryId = mysqli_query($conn,$sql_id);
    $kode_hotel = mysqli_fetch_array($queryId);

    if($kode_hotel) {
        
        $nilai = substr($kode_hotel[0], 1);
        $kode = (int) $nilai;

        $kode = $kode + 1;
        $auto_kodeHotel = "H" .str_pad($kode, 4, "0", STR_PAD_LEFT);

      }

      else {

        $auto_kodeHotel = "H0001";
      
      }


  $mysqli2  = "INSERT INTO tbl_hotel
                              (id_hotel,
                              id_kategori,
                                id_user,
                                nama_hotel,
                                keterangan,
                                status) 
                  VALUES ('$auto_kodeHotel',
                          '$id_kategori',
                          '$id_user', 
                          '$nama_barang',
                          '$keterangan',
                          '$status')";
  $result2  = mysqli_query($conn, $mysqli2);

  $mysqli3  = "INSERT INTO tbl_room 
                          (id_hotel,
                          tipe_room,
                          tipe_bed,
                          harga_room,
                          stock_room) 
                VALUES ('$auto_kodeHotel',
                        '$tipe_room',
                        '$tipe_bed',
                        '$harga_hotel',
                        '$stock')";
  $result3  = mysqli_query($conn, $mysqli3);
  
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
          $name = rand(1,1234567890) . '.' . $file['name'];//fungsi untuk membuat nama acak
          $direktori   = "../../images/$name";
          
          if (!empty($lokasi_file)) {
    
              if (move_uploaded_file($lokasi_file,$direktori)){
              // code C
                $queryRoom = "SELECT id_room FROM tbl_room WHERE id_hotel = '$auto_kodeHotel'";
                $resultRoom = mysqli_query($conn,$queryRoom);
                
                while($row =mysqli_fetch_array($resultRoom)) {
                  
                  $id_room = $row['id_room'];
                }

                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$id_room', '$name')";
                $aksi = mysqli_query($conn,$mysqli);
    
              } else {
    
                $flag = false;
                echo "EROR";
    
              }
    
              if (!$aksi) {
    
                $error++;
    
              }
          }
        }

      if($result2 == TRUE && $result3 == TRUE && $resultRoom == TRUE && $aksi == TRUE){

        mysqli_commit($conn);

      } else {

        mysqli_rollback($conn);

      }

    echo "Input berhasil";
    header('location:../../view/barang/list_hotel.php');

  } else {

    echo "Input gagal";

  }
    }
  mysqli_close($conn);
?>