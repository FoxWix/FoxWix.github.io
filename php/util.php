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
?>