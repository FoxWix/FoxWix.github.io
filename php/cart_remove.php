<?php
session_start();
require_once("./util.php");
require_once("./workDB_MF.php");
$data = file_get_contents('php://input');
$Mail = $_SESSION["user_data"]["Mail"];

GetData_Cart_UpdateFlag("'{$Mail}'","'{$data}'",2);
echo $data;
?>