<?php 
session_start();
require_once("../php/util.php");
require_once("../php/workDB_MF.php");

/*  4.1 注文登録  */

/* 
    受信するデータ
    <form action="" method="POST">
        <input type="number" id="type"      value="">
        <input type="number" id="length"    value="">
        <input type="number" id="width"     value="">
        <input type="number" id="depth"     value="">
        <input type="number" id="thickness" value="">
        <input type="number" id="tmpId"     value="">
        <input type="number" id="color"     value="">
        <input type="number" id="quantity"  value="">
        <input type="text"   id="imgpath"   value="">
    </form>

    4.1.1 カートに追加

*/

if(isset ( $_POST["type" ]))
$type = $_POST["type" ];
else
$type = "";

if(isset ( $_POST["length" ]))
$length = $_POST["length" ];
else
$length = "";

if(isset ( $_POST["width" ]))
$width = $_POST["width" ];
else
$width = "";

if(isset ( $_POST["depth" ]))
$depth = $_POST["depth" ];
else
$depth = "";

if(isset ( $_POST["thickness" ]))
$thickness = $_POST["thickness"];
else
$thickness = "";

if(isset ( $_POST["tmpId" ]))
$tmpId = $_POST["tmpId" ];
else
$tmpId = "";

if(isset ( $_POST["color" ]))
$color = $_POST["color" ];
else
$color = "";

if(isset ( $_POST["quantity" ]))
$quantity = $_POST["quantity" ];
else
$quantity = "";

if(isset ( $_POST["imgpath" ]))
$imgpath = $_POST["imgpath" ];
else
$imgpath = "";

//仮データ
$price = 2600;

if($type=="C_order"){
    //オリジナル
    $cardboard_data = [
        "cardboardID" => "P"       ,
        "length"      => $length   ,
        "width"       => $width    ,
        "depth"       => $depth    ,
        "thickness"   => $thickness,
        "color"       => $color    ,
        "imgpath"     => $imgpath  ,
        "quantity"    => $quantity ,
        "price"       => $price
    ];

}else{
    //テンプレート
    $cardboard_data = [
        "cardboardID" => "T",
        "color"       => $color,
        "tmpId"       => $tmpId,
        "quantity"    => $quantity,
        "price"       => $price
    ];
}

$_SESSION["cart"][] = $cardboard_data;
unset($_SESSION["cardboard_flg"]);

header("Location:../cart.php");
exit();
?>