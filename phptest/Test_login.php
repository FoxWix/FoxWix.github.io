<?php
session_start();

require_once("util.php");

if(isset($_SESSION["data"]))
    $data = $_SESSION["data"];

unset($_SESSION["data"]);

//セッション
if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    unset($_SESSION["errors"]);
}
else
$errors = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="normalize.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php 
        echo "<h3>ログインデータ確認（テスト用）</h3>";
        echo "<h2>ログイン成功</h2>";
        echo "<form>";
        echo "<li><label>氏名:{$data["name"]}</label></li>";
        echo "<li><label>ふりがな:{$data["namekana"]}</label></li>";
        echo "<li><label>郵便番号:{$data["post"]}</label></li>";
        echo "<li><label>住所:{$data["address"]}</label></li>";
        echo "<li><label>電話番号:{$data["phone"]}</label></li>";
        echo "<li><label>メールアドレス:{$data["mail"]}</label></li>";
        echo "<li><label>パスワード:{$data["password"]}</label></li>";
        echo "</form>";
        echo "<br><a href='register.html'>会員登録ページへ</a>" ;
        echo "<br><a href='login.html'>ログインページへ</a>" ;
    ?>
</body>
</html>