
<?php 
  include "../config.php";
  session_start();

  $id_hotel = $_POST['id_hotel'];
  $tipe_room = $_POST['room'];
  $tipe_bed = $_POST['bed'];
  $harga_hotel = str_replace(",","",$_POST['harga']);
  $stock  = $_POST['stock'];

  $mysqli  = "INSERT INTO tbl_room 
                          (id_hotel,
                          tipe_room,
                          tipe_bed,
                          harga_room,
                          stock_room) 
                  VALUES ('$id_hotel',
                          '$tipe_room',
                          '$tipe_bed',
                          '$harga_hotel',
                          '$stock')";
  $result  = mysqli_query($conn, $mysqli);

  $query = "SELECT id_room FROM tbl_room WHERE id_room = $id_hotel";
  $mysqliResult = mysqli_query($conn,$query);
  while($row = mysqli_fecth_array($mysqliResult)){
    $id_room = $row['id_room'];
  }
  if ($result == TRUE) {

    
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
          $name = round(microtime(true)) . '-' . $file['name'];//fungsi untuk membuat nama acak
          $direktori   = "../../images/$name";
          
          if (!empty($lokasi_file)) {
    
              if (move_uploaded_file($lokasi_file,$direktori)){
              // code C
                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$id_room', '$name')";
                $aksi = mysqli_query($conn,$mysqli);
    
              } else {
    
                var_dump("tidak berhasil"); exit;
    
              }
    
              if (!$aksi) {
    
                $error++;
    
              }
          }
        }

    }


    echo "Input berhasil";

    header('location:../../view/barang/list_hotel.php');

    var_dump($mysqli);
?>