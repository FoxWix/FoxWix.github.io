<?php
session_start();
require_once("./php/util.php");

if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    unset($_SESSION["errors"]);
}
else
    $errors = "";
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-login.css">
<link rel="stylesheet" href="css/style-php_error.css">
<!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>test-login</title>
</head>

<body>
<header id="header">
  <h1><a href="./index.html" class="crunchify-top"><img src="images/Logo.png" alt="ブロック・デコ" height="60px"></a></h1><span>最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
  <a href="./login.php" class="Login_buttun">ログイン</a>
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
<div id="login-box">
  <div id="register">
    <h2>ログイン</h2>
  </div>
  <form  action="./php/user_login.php" method="post">
    <div class="label-box">
      <label for="email">email</label>
    </div>
      <input type="email" name="email" class="email">
      <?php error_list($errors,"email"); ?>
	<div class="label-box">
      <label for="password">password</label>
    </div>
      <input type="password" name="password" class="password" required>
      <?php error_list($errors,"password"); ?>
    <div class="btn-box">
      <button type="submit" class="Login_buttun2">ログイン</button>
	  <a href="register.php" class="no-register">新規会員登録はこちら</a>
    </div>
  </form>
</div>
<footer id="Footer">
  <div class="Footer_inner">
	<ul class="Footer_ul">
	  <li class="Footer_li"><a href="./index.html" class="Footer_a crunchify-top">HOME</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">よくある質問</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">FAQ・お問い合わせ</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">ご利用ガイド</a></li>
    </ul>
	<div class="Footer_logo">
	  <img src="images/Logo-2.png" alt="ブロック・デコ" height="80px" class="Footer_img">
    </div>
  </div>
  <div class="Footer_copy">
	<p class="Footer_copy_txt">©️ Bloc Deco. All rights reserved.</p>
  </div>
</footer>
</body>
</html>
