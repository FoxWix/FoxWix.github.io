<?php
session_start();
require_once("util.php");
require_once("workDB_MF.php");

$errors = [];

//POSTデータチェック
if(isset($_POST["email"])){
    $email = str_replace(" ","",$_POST["email"]);
    if($email == "")
        $errors["email"][] = "メールアドレスが入力されていません";
}

if(isset($_POST["password"])){
    $password = str_replace(" ","",$_POST["password"]);
    if($password == "")
        $errors["password"][] = "パスワードが入力されていません";
}

if(count($errors) > 0){
    $_SESSION["errors"] = $errors;
    header("Location:../login.php");
    exit();
}

$result = GetData_LOGIN("customer",["mail","password"],[$email],[$password]);

if(isset($result)){
    //会員データ（仮）
    if(count($result) > 0){
    foreach($result as $row){
        $_SESSION["data"] = $row;
    }

    header("Location:../phptest/Test_login.php");
    exit();
    }
}

$errors["password"][] = "メールアドレスかパスワードが間違っています";
$_SESSION["errors"] = $errors;
header("Location:../login.php");
exit();
?>