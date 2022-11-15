<?php 
session_start();
$_SESSION["cardboard_flg"] = true;
header("Location:../order.php");
exit();
?>