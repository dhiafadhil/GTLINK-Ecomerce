<?php
// include database connection file
 session_start();
include "../../function.php";
include "../config.php";

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$data = "DELETE FROM tbl_user WHERE id_user =$id" ;
$result  = mysqli_query($conn, $data);
  if ($result) {
      create_validasi(
		   "Sukses",
		   "Data berhasil di hapus",
		   "../../view/member/list_member.php"
		   );
  } else {
  	create_validasi(
  	"Gagal",
    "Delete gagal");
  }
  clearstatcache();
  mysqli_close($conn);
?>