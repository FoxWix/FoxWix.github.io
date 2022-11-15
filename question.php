<?php
session_start();
require_once("./php/util.php");
require_once("./php/workDB_MF.php");

//ログイン情報
if(isset($_SESSION["user_data"])){
  $user_data = $_SESSION["user_data"];
  $user_name = $user_data["Name"];
  $Login_flg = true;
}
else{
  $user_name = "";
  $Login_flg = false;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>よくある質問 -</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-question.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<header id="header">
    <h1><a href="./index.php" class=""><img src="images/Logo.png" alt="ブロック・デコ" height="60px" width="auto"></a></h1>
    <span class="head-pr">最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
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
<div id="register">
  <h2>よくある質問</h2>
</div>
<main>

  <h3>「お客様プリント」に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;その1</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;その2</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>

  <h3>「デザインテンプレート」に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;その1</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;その2</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>
  <dl>
      <dt class="trigger">Q.&nbsp;その3</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>

  <h3>「配送」に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;その1</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;その2</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;その3</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>　 ここに詳細を記載する</dd>
  </dl>

</main>
<footer id="Footer">
  <div class="Footer_inner">
	<ul class="Footer_ul">
	  <li class="Footer_li"><a href="index.php" class="Footer_a">HOME</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">よくある質問</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">お問い合わせ</a></li>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
//質問をクリックで答えが展開//
  $(function() {
    $('.trigger').on('click',function() {
      $(this).next().slideToggle();
    });
  });
//答えが展開している状態にするためdtにclassを付与する//
  $(function() {
    $('.trigger').on('click',function() {
      $(this).toggleClass('active');//もしクラスが付いていると外します、付いていないなら付けます//
    });
  });
</script>
</body>
</html>
