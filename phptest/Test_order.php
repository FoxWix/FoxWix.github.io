<?php
session_start();
require_once("../php/util.php");

if(isset($_SESSION["test_c"]))
    $board = $_SESSION["test_c"];

if(isset($_SESSION["test_o"]))
    $data_o = $_SESSION["test_o"];

if(isset($_SESSION["test_o_d"]))
    $data_d = $_SESSION["test_o_d"];

unset($_SESSION["test_c"]);
unset($_SESSION["test_o"]);
unset($_SESSION["test_o_d"]);
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
    <h3>注文データ確認（テスト用）</h3>
    <h2>注文登録成功</h2>
    <?php 
    
    echo "<h2>段ボールデータ</h2>";
    for($count=0;count($board) > $count; $count++){
        echo "<h3>".($count+1)."個目</h3>";
        foreach($board[$count] as $key => $board_d)
            echo "<li>".$key.":".$board_d."</li>";
        echo "<br>";
    }

    echo "<h2>注文データ</h2>";
    for($count=0;count($data_o) > $count; $count++){
        echo "<h3>".($count+1)."個目</h3>";
        foreach($data_o[$count] as $key => $data_od){
            switch($key){
                case 0:
                    $key = "注文ID";
                    break;
                case 1:
                    $key = "段ボールID";
                    break;
                case 2:
                    $key = "値段";
                    break;
                case 3:
                    $key = "個数";
                    break;
                default:
                    $key = "error";
                    break;
            }
            echo "<li>".$key.":".$data_od."</li>";
        }
        echo "<br>";
    }
    echo "<h2>詳細データ</h2>";
    foreach($data_d as $key => $od){
        echo "<li>".$key.":".$od."</li>";
    }
    ?>
    <br><a href='../register.html'>会員登録ページへ</a>
    <br><a href='../login.php'>ログインページへ</a>
    <br><a href='../index.php'>トップページへ</a>
    <br>
</body>
</html>