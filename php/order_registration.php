<?php 
session_start();
require_once("util.php");
require_once("workDB_MF.php");

/*  注文詳細登録  */

//　仮データ
$payment = "銀行振込";
$souryo = 790;

//　ユーザーデータ取得
$user_data = $_SESSION["user_data"];
//　日付
$date = date("Y-m-d H:i:s");

//　注文ID取得
if(GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"] !== null){
    // フラグ＝0　の　最大ID
    $order_id = GetData_SELECT_Match("t_order","MAX(OrderID) as orderID",["Mail","OrderFlag"],["'{$user_data["Mail"]}'",0])[0]["orderID"];
}

//　合計計算
$Total_amount = 0;
$data = GetData_SELECT_Match("t_order","Price,Quantity",["OrderFlag","OrderID","Mail"],[0,$order_id,"'{$user_data["Mail"]}'"]);
for($count = 0; count($data) > $count; $count++){
    $Total_amount += $data[$count]["Price"] * $data[$count]["Quantity"];
}

//  注文詳細データ
$order_detail = [
    "orderID" => $order_id,
    "email"   => $user_data["Mail"],
    "date"    => $date,
    "payment" => $payment,
    "total"   => $Total_amount,
    "flag"    => 0
];

//　登録
Add_AUTO_INCREMENT("T_order_detail",$order_detail);

//　注文データ確定
GetData_Cart_UpdateFlag("'{$user_data["Mail"]}'","'%%'",1);

/*
    4.1.3 完了画面遷移
*/

//テスト用データ
$from1 = "t_order as o INNER JOIN t_cardboard as c ON o.CardboardID = c.CardboardID";
$from2 = "t_order as o INNER JOIN t_form as f ON o.CardboardID = f.CardboardID";

$select1 = "o.CardboardID as cardboardID, c.Length as length, c.Width as width,
            c.Depth as depth, c.Thickness as thickness, c.Color as color,
            o.Price as price, o.Quantity as quantity";

$select2 = "o.CardboardID as cardboardID,
            f.SelectdesignNO as tmpid,
            f.Color as color,
            o.Price as price, o.Quantity as quantity";

$_SESSION["T_O_D"] = $order_detail;
$_SESSION["T_O"] = [];
$T_O1 = GetData_SELECT_Match($from1,$select1,["OrderID","Mail","OrderFlag"],["'{$order_id}'","'{$user_data["Mail"]}'",1]);
$T_O2 = GetData_SELECT_Match($from2,$select2,["OrderID","Mail","OrderFlag"],["'{$order_id}'","'{$user_data["Mail"]}'",1]);
if(isset($T_O1))
    $_SESSION["T_O"] = array_merge($_SESSION["T_O"],$T_O1);
if(isset($T_O2))
    $_SESSION["T_O"] = array_merge($_SESSION["T_O"],$T_O2);
header("Location:../phptest/Test_order.php");
exit();
?>