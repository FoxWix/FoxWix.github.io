<?php
session_start();
require_once("./php/util.php");
require_once("./php/workDB_MF.php");

//ログイン情報
if (isset($_SESSION["user_data"])) {
    $user_data = $_SESSION["user_data"];
    $user_name = $user_data["Name"];
    $Login_flg = true;
  } else {
    $user_name = "";
    $Login_flg = false;
  }

if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    unset($_SESSION["errors"]);
}
else
    $errors = "";
?>

<!doctype html>
<html lang="ja">
<!--langをhtmlに記載すること！ ヘッダーロゴを押すとトップページへ以降すると認識されているので、そのように変更すること！ コピーライトもログインのヤツに変更しておくこと！ -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name=”robots” content=”noindex”>
    <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="ico/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>エラーページ</title>
</head>

<body>
<header id="header">
    <h1><a href="index.php" class="crunchify-top"><img src="images/Logo.png" alt="ブロック・デコ" height="60px"
          width="auto"></a></h1><span class="head-pr">最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
    <div id="header-btns">
      <!-- ログイン処理 -->
      <?php if ($Login_flg): ?>
      <span class="User-inner">ユーザー：<span id="User-name">
          <?php echo $user_name ?>
        </span></span>
      <?php endif; ?>
      <div id="flex-btns">
        <a href="./cart.php" class="Cart_buttun">カート</a>
        <?php if ($Login_flg): ?>
        <a href="./php/user_logout.php" class="Login_buttun">ログアウト</a>
        <?php endif; ?>
        <?php if (!$Login_flg): ?>
        <a href="./login.php" class="Login_buttun">ログイン</a>
        <?php endif; ?>
      </div>
    </div>
  </header>
<div class="MainVis"></div>
<div class="MainVis">
    <div id="register">
        <h2>エラーが発生しました</h2>
    </div>
</div>
<footer id="Footer">
    <div class="Footer_inner">
      <ul class="Footer_ul">
        <li class="Footer_li"><a href="index.php" class="Footer_a">HOME</a></li>
        <li class="Footer_li"><a href="question.php" class="Footer_a">よくある質問</a></li>
        <li class="Footer_li"><a href="inquiry.php" class="Footer_a">お問い合わせ</a></li>
        <li class="Footer_li"><a href="guide.php" class="Footer_a">ご利用ガイド</a></li>
      </ul>
      <div class="Footer_logo">
        <img src="images/Logo-2.png" alt="ブロック・デコ" height="80px" class="Footer_img">
      </div>
    </div>
    <div class="Footer_copy">
      <p class="Footer_copy_txt">©️ 2023 Bloc Deco</p>
    </div>
  </footer>
</body>
</html>
