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
    <title>テストページ</title>
    <link href="normalize.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php 
        echo "<h3>登録データ確認（テスト用）</h3>";
        echo "<h2>登録成功</h2>";
        echo "<form>";
        echo "<li>氏名:{$data[1]}</li>";
        echo "<li>ふりがな:{$data[2]}</li>";
        echo "<li>郵便番号:{$data[3]}</li>";
        echo "<li>住所:{$data[4]}</li>";
        echo "<li>電話番号:{$data[5]}</li>";
        echo "<li>メールアドレス:{$data[0]}</li>";
        echo "<li>パスワード:{$data[6]}</li>";
        echo "</form>";
        echo "<br><a href='register.html'>会員登録ページへ</a>" ;
        echo "<br><a href='login.html'>ログインページへ</a>" ;
    ?>
</body>
</html>