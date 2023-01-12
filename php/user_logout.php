<?php 
session_start();
$_SESSION = [];
if(isset($_COOKIE[session_name()])){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-36000, $params['path']);
}
session_destroy();
    
header("Location:../index.php");
exit();
?>