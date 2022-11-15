<?php 
session_start();
require_once("util.php");
require_once("workDB_MF.php");

/*  4.1 注文登録  */

//　仮データ
$payment = "銀行振込";
$souryo = 790;

/* 
    4.1.2 注文情報登録
        .1 DB接続
*/

//カートデータ取得
$cardboard_list = $_SESSION["cart"];
if(GetData_Increment_MaxID("t_order","OrderID")[0]["OrderID"] !== null)
    $order_id = GetData_Increment_MaxID("t_order","OrderID")[0]["OrderID"];
else
    $order_id = 1;

$Total_amount = 0;

//カート内商品を登録
for($count=0;count($cardboard_list) > $count; $count++){

    //段ボールデータ
    $cardboard = $cardboard_list[$count];

    //注文データ
    $order = [
        "orderID"     => $order_id             ,
        "cardboardID" => ""                    ,
        "price"       => $cardboard["price"]   ,
        "quantity"    => $cardboard["quantity"],
    ];
    unset($cardboard["quantity"]);
    unset($cardboard["price"]);
    //注文合計金額
    $Total_amount += $order["price"] * $order["quantity"];

    //段ボールID取得
    if($cardboard["cardboardID"] == "P"){
        $tablename = "t_cardboard";
        if(GetData_Increment_MaxID($tablename,"CardboardID")[0]["CardboardID"] !== null)
            $cardboard_id = "P".GetData_Increment_MaxID($tablename,"CardboardID")[0]["CardboardID"];
        else
            $cardboard_id = "P0001";
    }
    else{
        $tablename = "T_form";
        if(GetData_Increment_MaxID($tablename,"CardboardID")[0]["CardboardID"] !== null)
            $cardboard_id = "T".GetData_Increment_MaxID($tablename,"CardboardID")[0]["CardboardID"];
        else
            $cardboard_id = "T0001";
    }

    $cardboard["cardboardID"] = $cardboard_id;
    foreach($cardboard as $name => $data){
        $cardboard_data[] = $data;
    }

    //テスト用
    $_SESSION["test_c"][] = $cardboard;
    
    //段ボール登録
    Add($tablename,$cardboard_data);
    //登録済みデータ削除
    unset($cardboard_data);
    
    //段ボールID更新
    $order["cardboardID"] = $cardboard_id;
    foreach($order as $name => $data){
        $order_data[] = $data;
    }
    
    //注文登録
    Add("t_order",$order_data);

    //テスト用
    $_SESSION["test_o"][] = $order_data;

    //登録済みデータ削除
    unset($order_data);
}

//  注文詳細登録
$Total_amount += $souryo;

//　ユーザーデータ取得
$user_data = $_SESSION["user_data"];
$date = date("Y-m-d H:i:s");

//  注文詳細データ
$order_detail = [
    "orderID" => $order_id,
    "email"   => $user_data["Mail"],
    "date"    => $date,
    "payment" => $payment,
    "total"   => $Total_amount,
    "flag"    => 0
];

//　テスト
$_SESSION["test_o_d"] = $order_detail;

Add_AUTO_INCREMENT("T_order_detail",$order_detail);

/*
    4.1.3 完了画面遷移
*/
var_export($cardboard_list);
var_export($order_detail);

//カートデータ削除
//unset($_SESSION["cart"]);

header("Location:../phptest/Test_order.php");
exit();
?>