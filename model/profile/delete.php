<?php
//include database connection file
include "../config.php";

// Get id from URL to delete that user
$id_profile = $_GET['id_profile'];
 $sqli1 = "SELECT logo from tbl_profile WHERE id_profile=$id_profile";
 $query1 = mysqli_query($conn, $sqli1);
 $data = mysqli_fetch_array($query1);
 $namafile = $data['logo'];

// Delete user row from table based on given id
  $sqli2 = "DELETE FROM tbl_profile WHERE id_profile =$id_profile" ;
  $query2 = mysqli_query($conn, $sqli2);
  $path =  "../../images/".$data['logo'];
   if (file_exists($path)) {
   	 @unlink($path);
     echo "Delete berhasil";
     header('location:../../view/profile/list_profile.php');
     
   } else {
     echo "Delete gagal";
   }

   mysqli_close($conn);
 
// After delete redirect to Home, so that latest user list will be displayed.
// @unlink('../../images/blog.png');
?>