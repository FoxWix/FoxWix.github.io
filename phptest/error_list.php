<?php
session_start();
require_once("../php/util.php");
require_once("../php/workDB_MF.php");

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
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/style-register.css">
<!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>test-register</title>
</head>

<body>
<header id="header">
  <h1><a href="../index.html" class="crunchify-top"><img src="../images/Logo.png" alt="ブロック・デコ" height="60px"></a></h1><span>最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
  <a href="../login.php" class="Login_buttun">ログイン</a>
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
  <h2>エラー表示ページ（テスト用）</h2>
</div>
<div id="Form-area">
    <?php 
        echo "<h2>エラーが発生しました<h2>";
        if ($errors !== ""){
            echo '<ul class="error">';
            foreach ($errors as $value) {
                echo "<li style='list-style: none'>", $value, "</li>";
            }
            echo "</ul>";
        }
        echo "<br><a href='../register.html'>会員登録ページへ</a>" ;
        echo "<br><a href='../login.php'>ログインページへ</a>" ;
    ?>
</div>
<footer id="Footer">
  <div class="Footer_inner">
	<ul class="Footer_ul">
	  <li class="Footer_li"><a href="../index.html" class="Footer_a crunchify-top">HOME</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">よくある質問</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">FAQ・お問い合わせ</a></li>
	  <li class="Footer_li"><a href="" class="Footer_a">ご利用ガイド</a></li>
    </ul>
	<div class="Footer_logo">
	  <img src="../images/Logo-2.png" alt="ブロック・デコ" height="80px" class="Footer_img">
    </div>
  </div>
  <div class="Footer_copy">
	<p class="Footer_copy_txt">©️ Bloc Deco. All rights reserved.</p>
  </div>
</footer>
</body>
</html>