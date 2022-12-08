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
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>よくある質問 -</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-question.css">
<link rel="icon" href="ico/favicon.ico">
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
<nav class="Breadcrumb">
    <ol class="Breadcrumb-ListGroup">
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link" href="index.html"><span>トップ</span></a>
        </li>
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link"><span>よくある質問</span></a>
        </li>
    </ol>
</nav>
<main>
  <ol class="Guide-list">
    <li><a href="#" class="crunchify-top">会員登録に関して</a></li>
    <li><a href="#q-print">ダンボールについて</a></li>
    <li><a href="#q-ten">注文に関して</a></li>
    <li><a href="#q-save">配送に関して</a></li>
    <!-- <li><a href="">List4</a></li> -->
  </ol>
<div id="Guide-delivery">
<div id="register">
  <h2>よくある質問</h2>
</div>

  <h3>会員登録に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;注文には会員登録が必要ですか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>はい。ご注文には会員登録が必要です。<br><br><a href="register.html" class="Btn-reg">無料会員登録はこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;フリーメールでの会員登録は出来ますか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>はい。フリーメールであっても会員登録は可能です。<br><br><a href="register.html" class="Btn-reg">無料会員登録はこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;会員のIDとパスワードを忘れてしまった場合はどうすればいいでしょうか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>申し訳ございませんが、会員様のパスワードは弊社では一切保持しておりません。<br><br>お忘れになってしまった場合は、再設定をお願いいたします。<br><br>ID（ご登録いただいたメールアドレス）はお調べすることが可能ですのでお問い合わせください。<br>お問い合わせいただいた際、ご本人様であることを確認させていただく場合がありますので、予めご了承ください。<br><br><a href="inquiry.html" class="Btn-reg">お問い合わせフォームはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;会員登録をしましたが、登録完了のURLが記載されたメールが届きません。</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>お客様のメールソフトにおいて、「迷惑メールフォルダ」に自動振り分けされている可能性があります。<br><br>お手数ですが、一度「迷惑メールフォルダ」をご確認ください。</dd>
  </dl>

  <h3 id="q-print">ダンボールに関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;ダンボールの形状(形式)はどの様なものがありますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>「お客様プリント」に関しましては、ストレイジボックス型のみご用意しております。<br><br>それ以外でご希望の形状がございましたら、「デザインテンプレート」より選択いただくか、お問い合わせフォームより、お問い合わせください。<br><br><a href="inquiry.html" class="Btn-reg">お問い合わせフォームはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;ダンボールに傷がついていますが、返品できますか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>いいえ。できません。<br><br>年に数回ほどお客様から「ダンボールに、傷がついてる」というお問い合わせをいただくことがあります。<br>弊社としては、その傷が配送時についた傷なのか、到着時についた傷なのかを判断することが非常に困難となります。<br>ですので、恐れ入りますがダンボールの返品はできかねます。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;ダンボール１枚あたりの重さを教えてください。</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>オーダーメイドダンボールの１枚あたりの重さは、サイト上には記載しておりません。<br><br>お問い合わせフォームよりダンボールのサイズや材質をご連絡いただければ、お知らせすることが可能です。<br><br><a href="inquiry.html" class="Btn-reg">お問い合わせフォームはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;ダンボールの厚みは何を選べばいいでしょうか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>ご使用の用途や目的に応じてお選びいただけます。<br><br>重量のある内容物の場合は、「5mm」「8mm」の材質をおすすめしております。<br>軽量の内容物の場合は、美粧性が高く低価格の「3mm」がおすすめです。<br>内容物や総重量等を目安に、最適な材質をお選びください。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;商品を送るので、ぴったりの箱を作ってもらえませんか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>はい。ご希望の箱をご用意させていただきます。<br><br>送り状の備考欄に「見積もり依頼品」などと書き添えてお送りください。到着し次第、営業担当よりご連絡させていただきます。<br>「こんな印刷を入れたい」とか、「仕切りを付けたい」などのご要望がございましたら、メモ書き程度で構いませんのでお送りいただければと思います。<br><br>また、中身が割れ物の際は輸送中に商品が破損しないようにぷちぷちなどで包んでからお送りいただければと思います。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;人が入れる箱は作れますか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>はい。お作りできます。<br><br>一般的に、ヒト一人が十分にゆとりを持って入ることのできる箱の大きさは、高さ970mm 幅700mm 深さ700mmとなります。<br>弊社では通常、高さ500mm 幅500mm 深さ500mmの制限を設けていますが、事前にそういったお問い合わせを頂ければ、対応致します。<br><br><a href="inquiry.html" class="Btn-reg">お問い合わせフォームはこちら</a><br><br> </dd>
  </dl>


  <h3 id="q-ten">注文に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;複数のダンボールをまとめて注文できますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>はい。種類の違うダンボールを、まとめてご注文いただけます。<br><br>一度の注文で、同じ形式のダンボールであれば最大10個までご注文いただけます。<br><br>例）ダンボール形状A × 6個　ダンボール形状B × 10個　・・・</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;注文してからどのくらいで届きますか？</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>最短で当日の発送となります。<br><br>詳細はご利用ガイド＞発送プランをご覧ください。<br><br><a href="guide.html" class="Btn-reg">ご利用ガイドはこちら</a><br><br> </dd>
  </dl>
  <dl>
      <dt class="trigger">Q.&nbsp;注文方法が分かりません。</dt>
	  <dd><span class="Answer">A.&nbsp;回答</span><br>当サイトのトップページより、「形状」、「サイズ」、「厚み」など、必要に応じてデータを入力してください。<br><br>商品をカートに入れ、「お届け希望日」を設定のうえ、ご注文ください。<br>ご注文が確定しますと、お支払いメールが届きます。<br>注文の詳細はご利用ガイド＞ご注文の流れをご覧ください。<br><br><a href="guide.html" class="Btn-reg">ご利用ガイドはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;誤って商品を注文してしまったのですが、返品することはできますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>返品・交換は未使用・未開封に限り承ります。<br><br>返品のご連絡は商品到着後２週間以内にお願いいたします。<br>ご返金についてはご注文時のお支払い方法により異なりますのでその都度ご連絡いたします。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;注文した商品のキャンセルはできますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>ご注文のキャンセルについては商品の配送前まで承っております。</dd>
  </dl>

  <h3 id="q-save">「配送」に関して</h3>
  <dl>
    <dt class="trigger">Q.&nbsp;沖縄県・離島までのオーダーメイドダンボールの見積りを教えてください。</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>お届け先が沖縄県、又は離島の場合はお問い合わせフォームよりお見積りをご依頼ください。<br><br>オーダーメイドダンボールの自動見積もりフォームからは、届け先が沖縄県のダンボールのお見積りはできません。<br>
お見積りをご希望の場合は、下記をお問い合わせフォームよりご連絡ください。<br>折り返しお見積りをご連絡させていただきます。<br><br><span class="q-block">ご希望のダンボールサイズ（長さ・幅・深さ）</span><br><span class="q-block">ご希望の材質</span><br><span class="q-block">ご希望の数量</span><br><span class="q-block">お届け先住所</span><br><br><a href="inquiry.html" class="Btn-reg">お問い合わせフォームはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;土日祝は営業していますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>土日曜祝日は原則休業とさせていただいております。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;商品の送料はかかりますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>はい、配送先（地域）に応じて頂戴しております。<br><br>また、代金引き換え支払いをご選択の場合は、別途代金引換手数料も頂戴しております。<br>詳しくはご利用ガイド＞発送プランをご覧ください。<br><br><a href="guide.html" class="Btn-reg">ご利用ガイドはこちら</a><br><br> </dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;配送の時間指定はできますか？</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>申し訳ありません。配送の時間指定は承っておりません。</dd>
  </dl>
  <dl>
    <dt class="trigger">Q.&nbsp;商品が届きません。</dt>
    <dd><span class="Answer">A.&nbsp;回答</span><br>発送メールから配送状況を確認できます。</dd>
  </dl>
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
