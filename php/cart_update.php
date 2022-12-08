<?php
session_start();
require_once("./util.php");
require_once("./workDB_MF.php");
$data = file_get_contents('php://input');
$update_data =  mb_split(',',$data);
$Mail = $_SESSION["user_data"]["Mail"];

GetData_Cart_UpdateQuantity("'{$Mail}'","'{$update_data[0]}'","'{$update_data[1]}'");
echo $data;
?>