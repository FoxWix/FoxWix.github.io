<?php
session_start();
require_once("util.php");
require_once("workDB_MF.php");

$errors = [];   //エラーメッセージリスト（仮）
$input_data = []; //入力情報
$data = [];     //顧客情報リスト


//POSTデータチェック

//メールアドレス
if(isset($_POST["e-mail-address"])){
    $email = str_replace(" ","",$_POST["e-mail-address"]);
    $input_data["email"] = $email;
    if($email == "")
        $errors["email"][] = "メールアドレスが入力されていません";       
    if(data_exists("t_customer","mail",[$email]))
        $errors["email"][] = "メールアドレスは既に使用されています";
    if(mb_strlen($email) > 50)
        $errors["email"][] = "メールアドレスは50文字以下です";
    if(check_char($email))
        $errors["email"][] = "使用できない文字が入力されています";
}
else{
    $input_data["email"] = "";
}
//メールアドレス確認
if(isset($_POST["e-mail-address-confirmation"])){
    $email_conf = str_replace(" ","",$_POST["e-mail-address-confirmation"]);
    $input_data["email-conf"] = $email_conf;
    if($email_conf == "")
        $errors["email-conf"][] = "確認メールアドレスが入力されていません";
    if($email !== $email_conf)
        $errors["email-conf"][] = "メールアドレスが確認メールアドレスと一致しません";
    if(check_char($email_conf))
        $errors["email_conf"][] = "使用できない文字が入力されています";
}
else{
    $input_data["email-conf"] = "";
}
//パスワード
if(isset($_POST["password"])){
    $password = str_replace(" ","",$_POST["password"]);
    $input_data["password"] = $password;
    if($password == "")
        $errors["password"][] = "パスワードが入力されていません";
    if(mb_strlen($password) > 20)
        $errors["password"][] = "パスワードは20文字以下です";
    if(check_char($password))
        $errors["password"][] = "使用できない文字が入力されています";
}
else{
    $input_data["password"] = "";
}
//パスワード確認
if(isset($_POST["password-confirmation"])){
    $password_conf = str_replace(" ","",$_POST["password-confirmation"]);
    $input_data["password-conf"] = $password_conf;
    if($password_conf == "")
        $errors["password-conf"][] = "確認パスワードが入力されていません";
    if($password !== $password_conf)
        $errors["password-conf"][] = "パスワードが確認パスワードと一致しません";
}
else{
    $input_data["password-conf"] = "";
}
//名前
if(isset($_POST["name-1"])){
    $name_1 = str_replace(" ","",$_POST["name-1"]);
    $input_data["name_1"] = $name_1;
}
else{
    $input_data["name_1"] = "";
}
    
//名前2
if(isset($_POST["name-2"])){
    $name_2 = str_replace(" ","",$_POST["name-2"]);
    $input_data["name_2"] = $name_2;
}
else{
    $input_data["name_2"] = "";
}
    
//名前（姓名）
$name = $name_1." ".$name_2;
if($name == " ")
    $errors["name"][] = "名前が入力されていません";
if(mb_strlen($name) > 20)
    $errors["name"][] = "名前は20文字以下です";
if(check_char($name))
    $errors["name"][] = "使用できない文字が入力されています";

//名前カナ
if(isset($_POST["name-3"])){
    $name_3 = str_replace(" ","",$_POST["name-3"]);
    $input_data["name_3"] = $name_3;
}
else{
    $input_data["name_3"] = "";
}
//名前カナ2
if(isset($_POST["name-4"])){
    $name_4 = str_replace(" ","",$_POST["name-4"]);
    $input_data["name_4"] = $name_4;
}
else{
    $input_data["name_4"] = "";
}

//名前カナ
$name_kana = $name_3." ".$name_4;
if($name_kana == " ")
    $errors["name-kana"][] = "フリガナが入力されていません";
if(mb_strlen($name_kana) > 30)
    $errors["name-kana"][] = "フリガナは30文字以下です";
if(!check_Kana($name_kana))
    $errors["name-kana"][] = "フリガナは全角カタカナです";
if(check_char($name_kana))
    $errors["name_kana"][] = "使用できない文字が入力されています";

//電話番号
if(isset($_POST["phone-number"])){
    $phone_number = str_replace("-","", str_replace(" ","",$_POST["phone-number"]) );
    $input_data["phone-number"] = $phone_number;

if($phone_number == "")
    $errors["phone-number"][] = "電話番号が入力されていません";
if(mb_strlen($phone_number) > 13)
    $errors["phone-number"][] = "電話番号は13文字以下です";
if(!check_half_numeric($phone_number))
    $errors["phone-number"][] = "電話番号は半角数字です";
if(check_char($phone_number))
    $errors["phone_number"][] = "使用できない文字が入力されています";
}
else{
    $input_data["phone-number"] = "";
}
//郵便番号
if(isset($_POST["postcode1"])){
    $postcode_1 = str_replace(" ","",$_POST["postcode1"]);
    $input_data["postcode1"] = $postcode_1;
}
else{
    $input_data["postcode1"] = "";
}
//郵便番号2
if(isset($_POST["postcode2"])){
    $postcode_2 = str_replace(" ","",$_POST["postcode2"]);
    $input_data["postcode2"] = $postcode_2;
}
else{
    $input_data["postcode2"] = "";
}
//郵便番号（フル）
$postcode = $postcode_1.$postcode_2;
if($postcode == "")
    $errors["postcode"][] = "郵便番号が入力されていません";
if(mb_strlen($postcode) != 7)
    $errors["postcode"][] = "郵便番号は7桁です";
if(!check_half_numeric($postcode))
    $errors["postcode"][] = "郵便番号は半角数字です";
if(check_char($postcode))
    $errors["postcode"][] = "使用できない文字が入力されています";

//都道府県
if(isset($_POST["prefecture"])){
    $prefecture = str_replace(" ","",$_POST["prefecture"]);
    $input_data["prefecture"] = $prefecture;
    if($prefecture == "")
        $errors["prefecture"][] = "都道府県が選択されていません";
}
else{
    $input_data["postcode2"] = "";
}
//市区町村
if(isset($_POST["citytown"])){
    $citytown = str_replace(" ","",$_POST["citytown"]);
    $input_data["citytown"] = $citytown;
    if($citytown == "")
        $errors["citytown"][] = "市区町村が入力されていません";
    if(check_char($citytown))
        $errors["citytown"][] = "使用できない文字が入力されています";
}
else{
    $input_data["citytown"] = "";
}
//番地建物
if(isset($_POST["addnumber"])){
    $addnumber = str_replace(" ","",$_POST["addnumber"]);
    $input_data["addnumber"] = $addnumber;
    if($addnumber == "")
        $errors["addnumber"][] = "番地・建物名が入力されていません";
    if(check_char($addnumber))
        $errors["addnumber"][] = "使用できない文字が入力されています";
}
else{
    $input_data["addnumber"] = "";
}

//住所
$address = $prefecture."$".$citytown."$".$addnumber;
if(mb_strlen($address) > 100)
    $errors["address"][] = "住所は100文字以下です";

$_SESSION["input_data"] = $input_data;

//エラー件数
if(count($errors) > 0){
    $_SESSION["errors"] = $errors;
    header("Location:../register.php");
    exit();
}

//登録データ
$data = [
    $email,
    $name,
    $name_kana,
    $postcode,
    $address,
    $phone_number,
    $password
];

$e = Add("t_customer",$data);
if(isset($e)){
    $errors["database"][] = $e;
    $_SESSION["errors"] = $errors;
    header("Location:../register.php");
    exit();
}


$result = GetData_LOGIN("t_customer",["mail","password"],[$email],[$password]);

if(isset($result)){
    //会員データ
    if(count($result) > 0){
    foreach($result as $row){
        $_SESSION["user_data"] = $row;
    }

    if(isset($_SESSION["cardboard_flg"])){
        header("Location:../order.php");
        exit();
    }

    header("Location:../index.php");
    exit();
    }
}
?>