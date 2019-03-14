<?php
session_start();
include "../../function.php";
include "../config.php";
$name       = $_POST['username'];
$pass       = md5($_POST['password']);
$remember   = $_POST['remember'];

$data  = mysqli_query ($conn, "SELECT id_user,id_child,username,password,level,email,status_user FROM tbl_user WHERE username ='$name' AND `password` = '$pass' AND status_user=1 ");
$cek   = mysqli_num_rows($data);

if ($cek > 0 ) {
    
    while ($row = mysqli_fetch_array($data)){

        $lv = $row['level'] ;
        $id_user = $row['id_user'] ;
        $name = $row['username'];
        $email = $row['email'];
        $id_child = $row['id_child'];
    }
        $_SESSION['level'] = $lv;
        $_SESSION['username']= $name;
        $_SESSION['id_user']= $id_user;
        $_SESSION['email'] = $email;
        $_SESSION['id_child'] = $id_child;
        
        if ($remember == 1) {
          setcookie('username', $name, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('level', $lv, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('id_user', $id_user, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('id_child', $id_child, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

  header("location:../../home.php");

} else {

header("location:../../view/user/login.php");

}

mysqli_close($conn);

?>