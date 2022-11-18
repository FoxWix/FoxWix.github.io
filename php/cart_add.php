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

//　ユーザーデータ取得
$user_data = $_SESSION["user_data"];

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
    ];

    $order_data = [
        "orderID"     => ""                ,
        "cardboardID" => ""                ,
        "mail"        => $user_data["Mail"],
        "price"       => $price            ,
        "quantity"    => $quantity         ,
        "orderFlag"   => 0                 ,
    ];

    //段ボール登録
    //段ボールID取得
    if(GetData_Increment_MaxID("t_cardboard","CardboardID","WHERE CardboardID LIKE 'P%'")[0]["CardboardID"] !== null)
        //最大ID + 1
        $cardboard_id = "P".GetData_Increment_MaxID("t_cardboard","CardboardID","WHERE CardboardID LIKE 'P%'")[0]["CardboardID"];
    else
        $cardboard_id = "P0001";
    
    $cardboard_data["cardboardID"] = $cardboard_id;
    
    //段ボール登録
    Add("t_cardboard",$cardboard_data);


    //注文登録（カート）
    //注文ID取得
    if(GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"] !== null)
        //フラグ＝0　の　最大ID
        $order_id = GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"];
    else{
        if(GetData_Increment_MaxID("t_order","OrderID","WHERE Mail = '{$user_data["Mail"]}'")[0]["OrderID"] !== null)
            $order_id = GetData_Increment_MaxID("t_order","OrderID","WHERE Mail = '{$user_data["Mail"]}'")[0]["OrderID"];
        else
            $order_id = 1;
    }
    
    $order_data["orderID"] = $order_id;
    $order_data["cardboardID"] = $cardboard_id;

    //注文（カート）登録
    Add("t_order",$order_data);

}else{
    //テンプレート
    $cardboard_data = [
        "cardboardID" => "T",
        "color"       => $color,
        "tmpId"       => $tmpId,
        "quantity"    => $quantity,
        "price"       => $price
    ];

    $order_data = [
        "orderID"     => ""                ,
        "cardboardID" => ""                ,
        "mail"        => $user_data["Mail"],
        "price"       => $price            ,
        "quantity"    => $quantity         ,
        "orderFlag"   => 0                 ,
    ];
}


unset($_SESSION["cardboard_flg"]);

header("Location:../cart.php");
exit();
?>