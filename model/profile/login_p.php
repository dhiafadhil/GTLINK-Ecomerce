
<?php
session_start();

include "../config.php";
$name  = $_POST['username'];
$pass      = md5($_POST['password']);
$remember = $_POST['remember'];

$data  = mysqli_query ($conn, "select username,password,level from tbl_user where username ='$name' AND `password` = '$pass' ");
$cek = mysqli_num_rows($data);

if ($cek > 0 ){
    
    while ($row = mysqli_fetch_array($data)){
        $lv = $row['level'] ;
    }

        $_SESSION['level'] = $lv;
        
        $_SESSION['username']= $name;

    if ($remember == 1) {
        setcookie('username', $name, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('level', $lv, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    header("location:../../home.php");
} else {
header("location:../../view/user/login.php");
}

mysqli_close($conn);






?>
