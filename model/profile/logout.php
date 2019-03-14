
<?php   
session_start(); 
session_destroy(); 

    unset($_COOKIE['username']);
    unset($_COOKIE['level']);
    setcookie('username', null, -1, '/');
    setcookie('level', null, -1, '/');



// setcookie('username', null, time() - (3600), "/"); // 86400 = 1 day
// setcookie('level', null, time() - (3600 ), "/"); // 3600 = 1 day

header("location:../../view/user/login.php"); 
exit();
?>

