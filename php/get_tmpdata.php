<?php 
session_start();
require_once("./util.php");
require_once("./workDB_MF.php");
$data = file_get_contents('php://input');
$Mail = $_SESSION["user_data"]["Mail"];

$result = GetData_SELECT("m_cardboard_hina","SelectdesignNO","'".$data."'")[0];
$returntxt = $result["Length"].",".$result["Width"].",".$result["Depth"].",".$result["Price"].",".$result["Name"];
echo $returntxt;
?>