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

$result = GetData_LOGIN("t_customer",["mail","password"],[$email],[$password]);

if(isset($result)){
    //会員データ
    if(count($result) > 0){
    foreach($result as $row){
        $_SESSION["user_data"] = $row;
    }

    if(isset($_SESSION["cardboard_flg"])){
        header("Location:../order.php");
        exit();
    }
    header("Location:../index.php");
    exit();
    }
}

$errors["password"][] = "メールアドレスかパスワードが間違っています";
$_SESSION["errors"] = $errors;
header("Location:../login.php");
exit();
?>