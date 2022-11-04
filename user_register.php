<?php
session_start();
require_once("util.php");
require_once("workDB_MF.php");

$errors = [];   //エラーメッセージリスト（仮）
$data = [];     //顧客情報リスト


//POSTデータチェック

//メールアドレス
if(isset($_POST["e-mail-address"])){
    $email = str_replace(" ","",$_POST["e-mail-address"]);
    if($email == "")
        $errors[] = "メールアドレスが入力されていません";       
    if(data_exists("customer","mail",[$email]))
        $errors[] = "メールアドレスは既に使用されています";
    if(mb_strlen($email) > 50)
        $errors[] = "メールアドレスは50文字以下です";
}
//メールアドレス確認
if(isset($_POST["e-mail-address-confirmation"])){
    $email_conf = str_replace(" ","",$_POST["e-mail-address-confirmation"]);
    if($email_conf == "")
        $errors[] = "確認メールアドレスが入力されていません";
    if($email !== $email_conf)
        $errors[] = "メールアドレスが確認メールアドレスと一致しません";
}
//パスワード
if(isset($_POST["password"])){
    $password = str_replace(" ","",$_POST["password"]);
    if($password == "")
        $errors[] = "パスワードが入力されていません";
    if(mb_strlen($password) > 19)
        $errors[] = "パスワードは19文字以下です";
}
//パスワード確認
if(isset($_POST["password-confirmation"])){
    $password_conf = str_replace(" ","",$_POST["password-confirmation"]);
    if($password_conf == "")
        $errors[] = "確認パスワードが入力されていません";
    if($password !== $password_conf)
        $errors[] = "パスワードが確認パスワードと一致しません";
}
//名前
if(isset($_POST["name-1"])){
    $name_1 = str_replace(" ","",$_POST["name-1"]);
    if($name_1 == "")
        $errors[] = "姓が入力されていません";
}
//名前2
if(isset($_POST["name-2"])){
    $name_2 = str_replace(" ","",$_POST["name-2"]);
    if($name_2 == "")
        $errors[] = "名が入力されていません";
}

//名前（姓名）
$name = $name_1.$name_2;
if(mb_strlen($name) > 20)
        $errors[] = "名前は20文字以下です";

//名前カナ
if(isset($_POST["name-3"])){
    $name_3 = str_replace(" ","",$_POST["name-3"]);
    if($name_3 == "")
        $errors[] = "セイが入力されていません";
}
//名前カナ2
if(isset($_POST["name-4"])){
    $name_4 = str_replace(" ","",$_POST["name-4"]);
    if($name_4 == "")
        $errors[] = "メイが入力されていません";
}

//名前カナ（姓名）
$name_kana = $name_3.$name_4;
if(mb_strlen($name_kana) > 20)
        $errors[] = "フリガナは30文字以下です";

//電話番号
if(isset($_POST["phone-number"])){
    $phone_number = str_replace("-","", str_replace(" ","",$_POST["phone-number"]) );
    if($phone_number == "")
        $errors[] = "電話番号が入力されていません";
    if(mb_strlen($phone_number) > 13)
        $errors[] = "電話番号は13文字以下です";
    if(!check_half_numeric($phone_number))
        $errors[] = "電話番号は半角数字です";
}
//郵便番号
if(isset($_POST["postcode1"])){
    $postcode_1 = str_replace(" ","",$_POST["postcode1"]);
    if($postcode_1 == "")
        $errors[] = "郵便番号（前半）が入力されていません";
}
//郵便番号2
if(isset($_POST["postcode2"])){
    $postcode_2 = str_replace(" ","",$_POST["postcode2"]);
    if($postcode_2 == "")
        $errors[] = "郵便番号（後半）が入力されていません";
}

//郵便番号（フル）
$postcode = $postcode_1.$postcode_2;
if(mb_strlen($postcode) != 7)
    $errors[] = "郵便番号は7桁です";
if(!check_half_numeric($postcode))
    $errors[] = "郵便番号は半角数字です";

//都道府県
if(isset($_POST["prefecture"])){
    $prefecture = str_replace(" ","",$_POST["prefecture"]);
    if($prefecture == "")
        $errors[] = "都道府県が選択されていません";
}
//市区町村
if(isset($_POST["citytown"])){
    $citytown = str_replace(" ","",$_POST["citytown"]);
    if($citytown == "")
        $errors[] = "市区町村が入力されていません";
}
//番地建物
if(isset($_POST["addnumber"])){
    $addnumber = str_replace(" ","",$_POST["addnumber"]);
    if($addnumber == "")
        $errors[] = "番地・建物名が入力されていません";
}

//住所
$address = $prefecture.$citytown.$addnumber;
if(mb_strlen($address) > 50)
    $errors[] = "住所は50文字以下です";

//エラー件数
if(count($errors) > 0){
    $_SESSION["errors"] = $errors;
    header("Location:error_list.php");
    exit();
}


$data = [
    $email,
    $name,
    $name_kana,
    $postcode,
    $address,
    $phone_number,
    $password
];

echo "<br><br>";
print_r($data);

$e = Add("customer",$data);
if(isset($e)){
    $_SESSION["errors"] = [$e];
    header("Location:Location:error_list.php");
    exit();
}

//仮ページに遷移
$_SESSION["data"] = $data;
header("Location:Test_register.php");
exit();
?>