<?php
session_start();
require_once("./util.php");
require_once("./workDB_MF.php");
$data = file_get_contents('php://input');

unset($_SESSION["cart"][$data]);

echo $data;
?>