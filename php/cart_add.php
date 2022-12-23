<?php 
session_start();
require_once("../php/util.php");
require_once("../php/workDB_MF.php");
$errors = [];

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
$length = 0;

if(isset ( $_POST["width" ]))
$width = $_POST["width" ];
else
$width = 0;

if(isset ( $_POST["depth" ]))
$depth = $_POST["depth" ];
else
$depth = 0;

if(isset ( $_POST["thickness" ]))
$thickness = $_POST["thickness"];
else
$thickness = 0;

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
$quantity = 0;

if(isset ( $_POST["f_price" ]))
$f_price = $_POST["f_price" ];
else
$f_price = 0;

$price = 0;

//　チェック
if($quantity < 1 || $quantity > 10){
    error_page("?errorcode=E_D_001");
}
if($thickness != 3 && $thickness != 5 && $thickness != 8){
    error_page("?errorcode=E_D_002");
}

//　数値
if(!check_half_numeric($length + $width + $depth + $quantity + $thickness + $f_price)){
    error_page("?errorcode=E_D_010");
}
//　特殊文字
if(check_char(substr($color,1))){
    error_page("?errorcode=E_D_011");
}

if($type=="C_order"){
    if($length < 100 || $length > 500){
        error_page("?errorcode=E_D_003");
    }
    if($width < 100 || $width > 500){
        error_page("?errorcode=E_D_004");
    }
    if($depth < 100 || $depth > 500){
        error_page("?errorcode=E_D_005");
    }

    $total = $length + $width + $depth;
    
    //  値段
    if($total <= 600){
        $price = 1000;
    }
    else if($total <= 800 && $total > 600){
        $price = 2000;
    }
    else if($total <= 1000 && $total > 800){
        $price = 10000;
    }
    else if($total <= 1200 && $total > 1000){
        $price = 12000;
    }
    else if($total <= 1400 && $total > 1200){
        $price = 13000;
    }
    else{
        $price = 14000;
    }

    if($f_price != $price){
        error_page("?errorcode=E_P_001");
    }
}

//　ユーザーデータ取得
$user_data = $_SESSION["user_data"];

if($type=="C_order"){
    //お客様プリント
    $cardboard_data = [
        "cardboardID" => "P"       ,
        "designNO"    => "P_1"     ,
        "length"      => $length   ,
        "width"       => $width    ,
        "depth"       => $depth    ,
        "thickness"   => $thickness,
        "color"       => ""        ,
        "imgpath"     => $img_name ,
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
    if(GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","WHERE CardboardID LIKE 'P%'")[0]["CardboardID"] !== null)
        //最大ID + 1
        $cardboard_id = "P".GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","WHERE CardboardID LIKE 'P%'")[0]["CardboardID"];
    else
        $cardboard_id = "P0001";
    
    $cardboard_data["cardboardID"] = $cardboard_id;
    
    //段ボール登録
    Add("t_cardboard",$cardboard_data);

}else if($type == "T_order"){
    //テンプレート
    $cardboard_data = [
        "cardboardID" => "T"       ,
        "designNO"    => $tmpId    ,
        "length"      => 0         ,
        "width"       => 0         ,
        "depth"       => 0         ,
        "thickness"   => $thickness,
        "color"       => $color    ,
        "imgname"     => ""        ,
    ];

    $order_data = [
        "orderID"     => ""                ,
        "cardboardID" => ""                ,
        "mail"        => $user_data["Mail"],
        "price"       => 0                 ,
        "quantity"    => $quantity         ,
        "orderFlag"   => 0                 ,
    ];

    // テンプレートデータ取得
    $Tmp = GetData_SELECT("m_cardboard_hina","SelectdesignNO","'".$tmpId."'")[0];
    //ない場合
    if(isset($Tmp)){
        if(count($Tmp) == 0){
            error_page("?errorcode=E_T_001");
        }
    }
    else{
        error_page("?errorcode=E_T_002");
    }
    $cardboard_data["length"] = $Tmp["Length"];
    $cardboard_data["width" ] = $Tmp["Width"];
    $cardboard_data["depth" ] = $Tmp["Depth"];
    $cardboard_data["imgname"] = $Tmp["Image"];
    $order_data    ["price" ] = $Tmp["Price"];
    $cardboard_data["thickness"] = $thickness;

    //段ボール登録
    //段ボールID取得
    if(GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","WHERE CardboardID LIKE 'T%'")[0]["CardboardID"] !== null)
        //最大ID + 1
        $cardboard_id = "T".GetData_Increment_MaxID_LPAD("t_cardboard","CardboardID","WHERE CardboardID LIKE 'T%'")[0]["CardboardID"];
    else
        $cardboard_id = "T0001";
    
    $cardboard_data["cardboardID"] = $cardboard_id;
    
    //段ボール登録
    Add("t_cardboard",$cardboard_data);
}
else{
    error_page("?errorcode=E_D_006");
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