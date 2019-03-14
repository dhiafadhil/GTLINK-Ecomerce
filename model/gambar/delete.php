<?php
//include database connection file
include "../config.php";

// Get id from URL to delete that user
$id_gambar = $_GET['id_gambar'];
$id_room = $_GET['id_room'];
 $sqli1 = "SELECT gambar from tbl_gambar WHERE id_gambar=$id_gambar";
 $query1 = mysqli_query($conn, $sqli1);
 $data = mysqli_fetch_array($query1);
 $namafile = $data['gambar'];

// Delete user row from table based on given id
  $sqli2 = "DELETE FROM tbl_gambar WHERE id_gambar = $id_gambar " ;
  $query2 = mysqli_query($conn, $sqli2);
  $path =  "../../images/".$data['gambar'];

   if (file_exists($path)) {
   	 @unlink($path);
     echo "Delete berhasil";
     INPUT_GET['id_gambar'];
     header('location:../../view/gambar/list_gambar.php?id_room='.$id_room);
     
   } else {
     echo "Delete gagal";
   }
   mysqli_close($conn);
 
// After delete redirect to Home, so that latest user list will be displayed.
// @unlink('../../images/blog.png');
