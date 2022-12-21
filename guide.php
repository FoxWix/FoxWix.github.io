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

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>ご利用ガイド -</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-guide.css">
<link rel="icon" href="ico/favicon.ico">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<nav class="Breadcrumb">
    <ol class="Breadcrumb-ListGroup">
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link" href="index.php"><span>トップ</span></a>
        </li>
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link"><span>ご利用ガイド</span></a>
        </li>
    </ol>
</nav>
<!-- <div id="register">
  <h2>よくある質問</h2>
</div> -->
<main>
  <ol class="Guide-list">
    <li><a href="#" class="crunchify-top">ご注文の流れ</a></li>
    <li><a href="#Guide-delivery">配送プラン(都道府県別)</a></li>
    <li><a href="#Guide-pay">お支払い方法</a></li>
    <!-- <li><a href="">List4</a></li> -->
  </ol>
  <div>
    <div id="Guide-box">
	<!-- ここから別のタブ -->
	  <div id="Order-flow">
	    <div class="line">
          <h2>ご注文の流れ</h2>
        </div>
        <div id="Flow-box">
		  <div class="flow-items Arrow">
<div class="flow-flex-01">
			<h3>１</h3>
			<img src="images/damball-icon.svg" alt="ダンボール" width="100px">
			<div class="items-border">
			  <h4>形状・サイズ・デザインのデータ入力</h4>
			</div>
</div>
			<div class="items-txt">
			  <p>当サイトのトップページより、「形状」、「サイズ」、「厚み」など、必要に応じてデータを入力してください。</p>
		    </div>
		  </div>
		  <div class="flow-items Arrow">
<div class="flow-flex-01">
			<h3>２</h3>
			<img src="images/cart-icon.svg" alt="カート" width="100px">
			<div class="items-border">
			  <h4>　<br>注文を確定する</h4>
			</div>
</div>
			<div class="items-txt">
			  <p>商品をカートに入れ、「お届け希望日」を設定のうえ、注文してください。<br><span class="items-span">※配送日は、都道府県によって異なります。</span></p>
		    </div>
		  </div>
		  <div class="flow-items">
<div class="flow-flex-01">
			<h3>３</h3>
			<img src="images/sp-icon.svg" alt="スマートフォン" width="100px">
			<div class="items-border">
			  <h4>　<br>受信メールからお支払い</h4>
			</div>
</div>
			<div class="items-txt">
			  <p>注文が確定しますと、お支払いメールが届きます。<br>決済方法は「現金」、又は「クレジットカード」でお受けいたします。</p>
		    </div>
		  </div>
	    </div>
	  </div>
    <!-- ここから別のタブ -->
      <div id="Guide-delivery">
	    <div class="line">
          <h2>配送プラン(都道府県別)</h2>
        </div>
      <img src="images/Map-japan.png" alt="map-japan">
	    <div id="area-flex">
          <div id="area-1">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">北海道・東北</td>
              </tr>
              <tr>
                <th>北海道</th>
                <td class="Ship">出荷日から4〜6日後</td>
				<td rowspan="6">送料</td>
				<td class="Ship">1,700円</td>
              </tr>
              <tr>
                <th>青森</th>
                <td rowspan="5" class="Ship">出荷日から<br>2〜3日後（翌々日〜３日）</td>
				<td rowspan="5" class="Ship">1,260円</td>
			  </tr>
              <tr>
			    <th>岩手</th>
              </tr>
              <tr>
                <th>宮崎</th>
              </tr>
              <tr>
                <th>山形</th>
              </tr>
              <tr>
                <th>福島</th>
              </tr>
            </table>
	      </div>
          <div id="area-2">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">関東</td>
              </tr>
              <tr>
                <th>栃木</th>
                <td rowspan="8" class="Ship">出荷日から<br>２日後（翌々日）</td>
				<td rowspan="8">送料</td>
				<td class="Ship" rowspan="8">1,040円</td>
              </tr>
              <tr>
                <th>茨城</th>
              </tr>
              <tr>
			    <th>群馬</th>
              </tr>
              <tr>
                <th>埼玉</th>
              </tr>
              <tr>
                <th>千葉</th>
              </tr>
              <tr>
                <th>東京</th>
              </tr>
			  <tr>
                <th>神奈川</th>
              </tr>
		      <tr>
                <th>山梨</th>
              </tr>
            </table>
	      </div>
          <div id="area-3">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">東海</td>
              </tr>
              <tr>
                <th>岐阜</th>
                <td rowspan="4" class="Ship">出荷日から<br>２日後（翌々日）</td>
				<td rowspan="4">送料</td>
				<td class="Ship" rowspan="4">1,150円</td>
              </tr>
              <tr>
                <th>静岡</th>
              </tr>
              <tr>
			    <th>愛知</th>
              </tr>
              <tr>
                <th>三重</th>
              </tr>
            </table>
	      </div>
          <div id="area-4">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">北陸</td>
              </tr>
              <tr>
                <th>新潟</th>
                <td rowspan="5" class="Ship">出荷日から<br>２日後（翌々日）</td>
				<td rowspan="5">送料</td>
				<td class="Ship" rowspan="5">930円</td>
              </tr>
              <tr>
                <th>長野</th>
              </tr>
              <tr>
			    <th>富山</th>
              </tr>
              <tr>
                <th>石川</th>
              </tr>
              <tr>
                <th>福井</th>
              </tr>
            </table>
	      </div>
          <div id="area-5">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">関西</td>
              </tr>
              <tr>
                <th>滋賀</th>
                <td rowspan="6" class="Ship">出荷日から<br>１日後（翌日）</td>
				<td rowspan="6">送料</td>
				<td class="Ship" rowspan="6">930円</td>
              </tr>
              <tr>
                <th>京都</th>
              </tr>
              <tr>
			    <th>大阪</th>
              </tr>
              <tr>
                <th>兵庫</th>
              </tr>
              <tr>
                <th>奈良</th>
              </tr>
              <tr>
                <th>和歌山</th>
              </tr>
            </table>
	      </div>
          <div id="area-6">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">中国</td>
              </tr>
              <tr>
                <th>鳥取</th>
                <td rowspan="5" class="Ship">出荷日から<br>２〜３日後（翌々日〜３日）</td>
				<td rowspan="5">送料</td>
				<td class="Ship" rowspan="5">930円</td>
              </tr>
              <tr>
                <th>島根</th>
              </tr>
              <tr>
			    <th>岡山</th>
              </tr>
              <tr>
                <th>広島</th>
              </tr>
              <tr>
                <th>山口</th>
              </tr>
            </table>
	      </div>
          <div id="area-7">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">四国</td>
              </tr>
              <tr>
                <th>徳島</th>
                <td rowspan="4" class="Ship">出荷日から<br>２日後（翌々日）</td>
				<td rowspan="4">送料</td>
				<td class="Ship" rowspan="4">1,040円</td>
              </tr>
              <tr>
                <th>香川</th>
              </tr>
              <tr>
			    <th>愛媛</th>
              </tr>
              <tr>
                <th>高知</th>
              </tr>
		    </table>
	      </div>
          <div id="area-8">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4" class="title">九州・沖縄・離島</td>
              </tr>
              <tr>
                <th>福岡</th>
                <td rowspan="7" class="Ship">出荷日から<br>３〜４日後（３日〜４日）</td>
				<td rowspan="8">送料</td>
				<td class="Ship" rowspan="7">1,040円</td>
              </tr>
              <tr>
                <th>佐賀</th>
              </tr>
              <tr>
			    <th>長崎</th>
              </tr>
              <tr>
                <th>大分</th>
              </tr>
              <tr>
                <th>熊本</th>
              </tr>
              <tr>
                <th>宮崎</th>
              </tr>
              <tr>
                <th>鹿児島</th>
              </tr>
              <tr>
                <th>沖縄・離島</th>
                <td class="Ship">お問い合わせください</td>
				<td class="Ship" rowspan="8">1,370円</td>
              </tr>
            </table>
	      </div>
        </div>
      </div>
	<!-- ここから別のタブ -->
	  <div id="Guide-pay">
	    <div class="line">
          <h2>お支払い方法</h2>
        </div>
        <div id="Mail-box">
		  <div class="mail-icon">
		    <img src="images/mail-icon.svg" alt="メールアイコン" width="60px">
		  </div>
		  <p>当社では決済方法として、「<span>現金決済</span>」、「<span>クレジットカード決済</span>」に対応しております。
          <br><br>注文確定後、登録されましたお客さまのメールアドレスへ決済画面のリンクURLを送信致します。
	      <br><br>メールが利用できるデバイスをお持ちであれば、受信したメールからお支払いいただきます。</p>
	    </div>
	  </div>

    </div>
  </div>
</main>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    //ヘッダーの高さを取得
    var header = $('header').height();
    //ヘッダーの高さを引く
    var position = target.offset().top - header;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});
</script>
</body>
</html>
