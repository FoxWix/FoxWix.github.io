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
?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-confirm.css">
<link rel="icon" href="ico/favicon.ico">
<!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>注文完了 -</title>
</head>

<body>
<header id="header">
  <h1><a href="./index.php"><img src="images/Logo.png" alt="ブロック・デコ" height="60px" width="auto"></a></h1><span class="head-pr">最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
  <div id="header-btns">
      <!-- ログイン処理 -->
      <?php if($Login_flg): ?>
      <span class="User-inner">ユーザー：<span id="User-name"><?php echo $user_name ?></span></span>
      <?php endif; ?>
      <div id="flex-btns">
        <a href="./cart.php" class="Cart_buttun">カート</a>
        <?php if($Login_flg): ?>
          <a href="./php/user_logout.php" class="Login_buttun">ログアウト</a>
        <?php endif; ?>
        <?php if(!$Login_flg): ?>
          <a href="./login.php" class="Login_buttun">ログイン</a>
        <?php endif; ?>
      </div>
    </div>
</header>
<script>            
jQuery(document).ready(function() {
var offset = 220;
var duration = 500;
jQuery(window).scroll(function() {
if (jQuery(this).scrollTop() > offset) {
jQuery('.crunchify-top').fadeIn(duration);
} else {
jQuery('.crunchify-top').fadeIn(duration);
}
});
 
jQuery('.crunchify-top').click(function(event) {
event.preventDefault();
jQuery('html, body').animate({scrollTop: 0}, duration);
return false;
})
});
</script>
<!--  <nav class="Breadcrumb">
    <ol class="Breadcrumb-ListGroup">
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link" href="index.html"><span>トップ</span></a>
        </li>
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link" href="index.html"><span>カート</span></a>
        </li>
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link"><span>注文完了</span></a>
        </li>
    </ol>
</nav> -->
<div id="login-box">
  <div class="mail-icon">
    <img src="images/check-icon.svg" alt="メールアイコン" width="40px">
  </div>
  <div id="register">
    <h2>ご注文が完了しました</h2>
  </div>
  <div class="Check-txt">
	<p>間もなく、登録されたメールアドレスにお支払いメールが届きます。<br>決済方法は「現金」、又は「クレジットカード」でお受けいたします。</p>
  </div>
  <form  action="login.php" method="post">
      <a href="index.php" class="Login_buttun2">トップへ</a>
  </form>
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
