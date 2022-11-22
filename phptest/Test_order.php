<?php
session_start();
require_once("../php/util.php");
require_once("../php/workDB_MF.php");
$TOD = $_SESSION["T_O_D"];
$TOC = $_SESSION["T_O"];

unset($_SESSION["T_O_D"]);
unset($_SESSION["T_O"]);

if(!isset($_SESSION["T_O_D"]))
    header("Location:../index.php");
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
    <h1>注文データ確認（テスト用）</h1>
    <h2>注文登録成功</h2>
    <?php
    echo "<h2>注文データ</h2>";
    foreach($TOD as $key => $data){
        echo "{$key}:{$data}<br>";
    }
    echo "<h2>カートデータ</h2>";
    for($count=0; count($TOC) > $count;$count++){
        echo "<h3>{$count}</h3>";
        foreach($TOC[$count] as $key => $data){
            echo "{$key}:{$data}<br>";
        }
    }
    ?>
    <br><a href='../register.html'>会員登録ページへ</a>
    <br><a href='../login.php'>ログインページへ</a>
    <br><a href='../index.php'>トップページへ</a>
    <br>
</body>
</html>