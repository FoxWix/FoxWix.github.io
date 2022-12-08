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
        <input type="hidden" name="img_src"   id="img_src"  value="">
        <input type="hidden" name="img_type"  id="img_type" value="">
        <input type="hidden" name="img_name"  id="img_name" value="">
    </form>

    4.1.1 カートに追加

*/

//画像が添付されている場合はdesignTexturesフォルダへアップロード
$file_path = '../images/designTextures/';
// POST データ設定
$img_name = $_POST['img_name'] ?? '';
$img_type = $_POST['img_type'] ?? '';
$img_src  = preg_replace('/data:(.*);base64,/', '', $_POST['img_src'])  ?? '';
if($img_name != ''){
  // 保存イメージ名
  $img_name = uniqid(dechex(random_int(0, 255))) . $img_name . "." . $img_type;
  // base64デコード
  $data = base64_decode($img_src);
  file_put_contents($file_path . $img_name, $data);
}

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

if(isset ( $_POST["f_price" ]))
$price = $_POST["f_price" ];
else
$price = 0;

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
        "imgpath"     => $img_name  ,
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
    if(GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","")[0]["CardboardID"] !== null)
        //最大ID + 1
        $cardboard_id = "P".GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","")[0]["CardboardID"];
    else
        $cardboard_id = "P0001";
    
    $cardboard_data["cardboardID"] = $cardboard_id;
    
    //段ボール登録
    Add("t_cardboard",$cardboard_data);

}else{
    //テンプレート
    $form_data = [
        "cardboardID" => "T",
        "tmpId"       => $tmpId,
        "color"       => $color,
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
    if(GetData_Increment_MaxID_LPAD("t_form","CardboardID","")[0]["CardboardID"] !== null)
        //最大ID + 1
        $cardboard_id = "T".GetData_Increment_MaxID_LPAD("t_form","CardboardID","")[0]["CardboardID"];
    else
        $cardboard_id = "T0001";
    
    $form_data["cardboardID"] = $cardboard_id;
    
    //段ボール登録
    Add("t_form",$form_data);
}

//注文登録（カート）
//注文ID取得
if(GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"] !== null)
    //フラグ＝0　の　最大ID
    $order_id = GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"];

else{
    if(GetData_Increment_MaxID("t_order","OrderID","WHERE Mail = '{$user_data["Mail"]}'")[0]["OrderID"] !== null)
        //最大注文ID + 1
        $order_id = GetData_Increment_MaxID("t_order","OrderID","WHERE Mail = '{$user_data["Mail"]}'")[0]["OrderID"];
    else
        $order_id = 1;
}

$order_data["orderID"] = $order_id;
$order_data["cardboardID"] = $cardboard_id;

//注文（カート）登録
Add("t_order",$order_data);
unset($_SESSION["cardboard_flg"]);
header("Location:../cart.php");
exit();

?>