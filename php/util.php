<?php
// XSS対策のためのHTMLエスケープ
function es($data, $charset='UTF-8'){
  // $dataが配列のとき
  if (is_array($data)){
    // 再帰呼び出し
    return array_map(__METHOD__, $data);
  } else {
    // HTMLエスケープを行う
    return htmlspecialchars($data, ENT_QUOTES, $charset);
  }
}

// 配列の文字エンコードのチェックを行う
function cken(array $data){
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($value)){
      // 含まれている値が配列のとき文字列に連結する
      $value = implode("", $value);
    }
    if (!mb_check_encoding($value)){
      // 文字エンコードが一致しないとき
      $result = false;
      // foreachでの走査をブレイクする
      break;
    }
  }
  return $result;
}

/////////////////////
//  check_half_width()
//  return: true 一致 false 不一致
//  機能:半角英数字のチェック
/////////////////////
function check_half_width($str){
  $pattern = "/^[a-zA-Z0-9]{1,}/";
  if (preg_match($pattern, $str)){
    return true;
  }
  else
    return false;
}

/////////////////////
//  check_half_numeric()
//  return: true 一致 false 不一致
//  機能:半角数字のチェック
/////////////////////
function check_half_numeric($str){
  $pattern = "/^[0-9]{1,}/";
  if (preg_match($pattern, $str)){
    return true;
  }
  else
    return false;
}

/////////////////////
//  check_Kana()
//  return: true 一致 false 不一致
//  機能:全角カタカナのチェック
/////////////////////
function check_Kana($str){
  $pattern = '/^[ァ-ヾ]+$/u';
  if (preg_match($pattern, $str)){
    return true;
  }
  else{
    return false;
  }
}

/////////////////////
//  error_list()
//  機能:エラー一覧の表示
/////////////////////
function error_list($errors, $error){
  if (isset($errors[$error])){
    echo "<ul class='php_error'>";
    foreach ($errors[$error] as $value) {
      echo "<li>*", $value, "</li>";
    }
    echo "</ul>";
  }
  return;
}

/////////////////////
//  check_char()
//  機能:特殊文字の判定
/////////////////////
function check_char($str){
  $pattern = '/[\^\!\#\<\>\:\;\&\~\%\+\\\$\"\'\*\^\(\)\[\]\|\/\.\,\_\-]/';
  if(preg_match($pattern,$str)){
    return true;
  }
  else{
      return false;
  }
}

/////////////////////
//  error_page()
//  機能:エラーページ遷移
/////////////////////
function error_page($GET){
  $locate = "Location:../error.php".$GET;
  header($locate);
  exit();
}

/////////////////////
//  color_code_conversion()
//  機能:色コードを変換
/////////////////////
function color_code_conversion($colorcode){
  switch($colorcode){
    case "#a9a9a9":
        $color = "ダークグレー";
        break;
    case "#ff4500":
        $color = "オレンジレッド";
        break;
    case "#ffd700":
        $color = "ゴールド";
        break;
    case "#66cdaa":
        $color = "ミディアムカーマイン";
        break;
    case "#4169e1":
        $color = "ロイヤルブルー";
        break;
    case "#9932cc":
        $color = "ダークオーキッド";
        break;
    default:
        $color = "";
        break;
}

return $color;
}

?>