
<?php  
session_destroy();  
session_start(); 
include "../../function.php";

unset($_COOKIE['username']);
unset($_COOKIE['level']);
setcookie('username', null, -1, '/');
setcookie('level', null, -1, '/');

// setcookie('username', null, time() - (3600), "/"); // 86400 = 1 day
// setcookie('level', null, time() - (3600 ), "/"); // 3600 = 1 day
create_validasi(
"Sukses",
"Anda berhasil logout.Silahkan datang lagi di toko kami",
"../../view/user/login.php" ); 

exit();

?>

