<?php
session_start();
require_once("./php/util.php");

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

if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    unset($_SESSION["errors"]);
}
else
    $errors = "";

if(isset($_SESSION["input_data"])){
	$input_flag = true;
	$input_data = $_SESSION["input_data"];
	unset($_SESSION["input_data"]);
}
else{
	unset($_SESSION["input_data"]);
	$input_flag = false;
}
?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style-register.css">
<link rel="icon" href="ico/favicon.ico">
<link rel="stylesheet" href="css/style-php_error.css">
<!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>新規会員登録 -</title>
</head>

<body>
<header id="header">
    <h1><a href="./index.php"><img src="images/Logo.png" alt="ブロック・デコ" height="60px" width="auto"></a></h1>
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
            <a class="Breadcrumb-ListGroup-Item-Link" href="index.php"><span>トップ</span></a>
        </li>
        <li class="Breadcrumb-ListGroup-Item">
            <a class="Breadcrumb-ListGroup-Item-Link"><span>新規会員登録</span></a>
        </li>
    </ol>
</nav>
<div id="register">
  <h2>新規会員登録</h2>
  <?php error_list($errors,"database"); ?>
</div>
<!-- <form action="user_register.php" method="POST"> 処理追加 -->
<form action="./php/user_register.php" method="POST">
	<div id="Form-area">
	<dl class="Form-dl">
		<dt>メールアドレス</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["email"];?>" name="e-mail-address" type="text" class="Form-txt" placeholder="例）info@bloc.com">
		<?php error_list($errors,"email"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>メールアドレス(確認)</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["email-conf"];?>" name="e-mail-address-confirmation" type="text" class="Form-txt" placeholder="例）info@bloc.com">
		<?php error_list($errors,"email-conf"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>パスワード</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["password"];?>" name="password" type="text" class="Form-txt">
		<?php error_list($errors,"password"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>パスワード(確認)</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["password-conf"];?>" name="password-confirmation" type="text" class="Form-txt">
		<?php error_list($errors,"password-conf"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>お名前</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["name_1"];?>" name="name-1" type="text" class="Form-name-txt" placeholder="例）大阪">
			<input value="<?php if($input_flag) echo $input_data["name_2"];?>" name="name-2" type="text" class="Form-name-txt" placeholder="例）太郎">
		<?php error_list($errors,"name"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>お名前(フリガナ)</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["name_3"];?>" name="name-3" type="text" class="Form-name-txt" placeholder="例）オオサカ">
			<input value="<?php if($input_flag) echo $input_data["name_4"];?>" name="name-4" type="text" class="Form-name-txt" placeholder="例）タロウ">
		<?php error_list($errors,"name-kana"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>電話番号</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["phone-number"];?>" name="phone-number" type="text" class="Form-code-txt" placeholder="例）06-6772-2233">
		<?php error_list($errors,"phone-number"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>郵便番号</dt>
		<dd>〒 <input value="<?php if($input_flag) echo $input_data["postcode1"];?>" name="postcode1" type="text" class="Form-name-txt" placeholder="例）543" id="postcode1"> - 
			<input value="<?php if($input_flag) echo $input_data["postcode2"];?>" name="postcode2" type="text" class="Form-name-txt" placeholder="例）0001" id="postcode2">
		<?php error_list($errors,"postcode"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>都道府県(お届け先)</dt>
		<dd>
			<!-- <form> を <div> に変更 -->
			<div name="post" class="Number_input" placeholder="">
			<div>
				<select name="prefecture" id="address1">
				<?php 
				$prefecture_list = [
					"",
					"北海道",
					"青森県",
					"岩手県",
					"宮城県",
					"秋田県",
					"山形県",
					"福島県",
					"茨城県",
					"栃木県",
					"群馬県",
					"埼玉県",
					"千葉県",
					"東京都",
					"神奈川県",
					"新潟県",
					"富山県",
					"石川県",
					"福井県",
					"山梨県",
					"長野県",
					"岐阜県",
					"静岡県",
					"愛知県",
					"三重県",
					"滋賀県",
					"京都府",
					"大阪府",
					"兵庫県",
					"奈良県",
					"和歌山県",
					"鳥取県",
					"島根県",
					"岡山県",
					"広島県",
					"山口県",
					"徳島県",
					"香川県",
					"愛媛県",
					"高知県",
					"福岡県",
					"佐賀県",
					"長崎県",
					"熊本県",
					"大分県",
					"宮崎県",
					"鹿児島県",
					"沖縄県"
				];
				foreach($prefecture_list as $data){
					if($input_flag){
						if($data == $input_data["prefecture"])
							echo '<option value="'.$data.'" selected>'.$data.'</option>';
						elseif($data == "")
							continue;
						else
							echo '<option value="'.$data.'">'.$data.'</option>';
					}
					else{
						if($data == "")
							echo '<option value="'.$data.'" selected>お選びください</option>';
						else
							echo '<option value="'.$data.'">'.$data.'</option>';
					}
				}
				?>
				</select>
			</div>
			<!-- </form> を </div> に変更 -->
		</div>
		<?php error_list($errors,"prefecture"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt>市区町村(お届け先)</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["citytown"];?>" name="citytown" type="text" class="Form-txt" placeholder="例）大阪市天王寺区上本町" id="address2">
		<?php error_list($errors,"citytown"); ?>
		</dd>
	</dl>
	<dl class="Form-dl">
		<dt id="address-dt">番地・建物名(お届け先)</dt>
		<dd><input value="<?php if($input_flag) echo $input_data["addnumber"];?>" name="addnumber" type="text" class="Form-txt" placeholder="例）6-8-4" id="address3">
		<?php error_list($errors,"addnumber"); ?>
		</dd>
	</dl>
	</div>
	<div id="terms">
	<h3>ご利用規約</h3>
	</div>
	<div class="box">
	<p>この利用規約（以下，「本規約」といいます。）は，株式会社ブロック・デコ（以下，「当社」といいます。）がこのウェブサイト上で提供するオンラインショップ（以下，「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。</p><br>

	<h4>第1条（適用）</h4>
	<ol>
	<li>本規約は，ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。</li>
	<li>当社は本サービスに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下,「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。</li>
	<li>本規約の定めが前項の個別規定の定めと矛盾する場合には，個別規定において特段の定めなき限り，個別規定の定めが優先されるものとします。</li>
	</ol><br>

	<h4>第2条（利用登録）</h4>
	<ol>
	<li>本サービスにおいては，登録希望者が本規約に同意の上，当社の定める方法によって利用登録を申請し，当社がこれに対する承認を登録希望者に通知することによって，利用登録が完了するものとします。</li>
	<li>当社は，利用登録の申請者に以下の事由があると判断した場合，利用登録の申請を承認しないことがあり，その理由については一切の開示義務を負わないものとします。
	<ol>
	<li>利用登録の申請に際して虚偽の事項を届け出た場合</li>
	<li>本規約に違反したことがある者からの申請である場合</li>
	<li>その他，当社が利用登録を相当でないと判断した場合</li>
	</ol></li>
	</ol><br>

	<h4>第3条（ユーザーIDおよびパスワードの管理）</h4>
	<ol>
	<li>ユーザーは，自己の責任において，本サービスのユーザーIDおよびパスワードを管理するものとします。</li>
	<li>ユーザーは，いかなる場合にも，ユーザーIDおよびパスワードを第三者に譲渡または貸与し，もしくは第三者と共用することはできません。当社は，ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には，そのユーザーIDを登録しているユーザー自身による利用とみなします。</li>
	<li>ユーザーID及びパスワードが第三者に使用されたことによって生じた損害は，当社に故意又は重大な過失がある場合を除き，当社は一切の責任を負わないものとします。</li>
	</ol><br>

	<h4>第4条（売買契約）</h4>
	<ol>
	<li>本サービスにおいては，ユーザーが当社に対して購入の申し込みをし，これに対して当社が当該申し込みを承諾した旨の通知をすることによって売買契約が成立するものとします。なお，当該商品の所有権は，当社が商品を配送業者に引き渡したときに，ユーザーに移転するものとします。</li>
	<li>当社は，ユーザーが以下のいずれかの事由に該当する場合には，当該ユーザーに事前に通知することなく，前項の売買契約を解除することができるものとします。
	<ol>
	<li>ユーザーが本規約に違反した場合</li>
	<li>届け先不明や長期の不在のため商品の配送が完了しない場合</li>
	<li>その他当社とユーザーの信頼関係が損なわれたと認める場合</li>
	</ol></li>
	<li>本サービスに関する決済方法，配送方法，購入の申し込みのキャンセル方法，または返品方法等については，別途当社が定める方法によります。</li>
	</ol><br>

	<h4>第5条（知的財産権）</h4>
	<p>本サービスによって提供される商品写真その他のコンテンツ（以下「コンテンツ」といいます）の著作権又はその他の知的所有権は,当社及びコンテンツ提供者などの正当な権利者に帰属し,ユーザーは,これらを無断で複製,転載,改変,その他の二次利用をすることはできません。</p><br>

	<h4>第6条（禁止事項）</h4>
	<p>ユーザーは，本サービスの利用にあたり，以下の行為をしてはならないものとします。</p>
	<ol>
	<li>法令または公序良俗に違反する行為</li>
	<li>犯罪行為に関連する行為</li>
	<li>本サービスに含まれる著作権，商標権その他の知的財産権を侵害する行為</li>
	<li>当社のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為</li>
	<li>本サービスによって得られた情報を商業的に利用する行為</li>
	<li>当社のサービスの運営を妨害するおそれのある行為</li>
	<li>不正アクセスをし，またはこれを試みる行為</li>
	<li>他のユーザーに関する個人情報等を収集または蓄積する行為</li>
	<li>他のユーザーに成りすます行為</li>
	<li>当社のサービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為</li>
	<li>その他，当社が不適切と判断する行為</li>
	</ol><br>

	<h4>第7条（本サービスの提供の停止等）</h4>
	<ol>
	<li>当社は，以下のいずれかの事由があると判断した場合，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。
	<ol>
	<li>本サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
	<li>地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合</li>
	<li>コンピュータまたは通信回線等が事故により停止した場合</li>
	<li>その他，当社が本サービスの提供が困難と判断した場合</li>
	</ol></li>
	<li>当社は，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害について，理由を問わず一切の責任を負わないものとします。</li>
	</ol><br>

	<h4>第8条（利用制限および登録抹消）</h4>
	<ol>
	<li>当社は，以下のいずれかに該当する場合には，事前の通知なく，ユーザーに対して，本サービスの全部もしくは一部の利用を制限し，またはユーザーとしての登録を抹消することができるものとします。
	<ol>
	<li>本規約のいずれかの条項に違反した場合</li>
	<li>登録事項に虚偽の事実があることが判明した場合</li>
	<li>決済手段として当該ユーザーが届け出たクレジットカードが利用停止となった場合</li>
	<li>料金等の支払債務の不履行があった場合</li>
	<li>当社からの連絡に対し，一定期間返答がない場合</li>
	<li>本サービスについて，最終の利用から一定期間利用がない場合</li>
	<li>その他，当社が本サービスの利用を適当でないと判断した場合</li>
	</ol></li>
	<li>当社は，本条に基づき当社が行った行為によりユーザーに生じた損害について，一切の責任を負いません。</li>
	</ol><br>

	<h4>第9条（退会）</h4>
	<p>ユーザーは，所定の退会手続により，本サービスから退会できるものとします。</p><br>

	<h4>第10条（保証の否認および免責事項）</h4>
	<ol>
	<li>当社は,本サービスに事実上または法律上の瑕疵（安全性,信頼性,正確性,完全性,有効性,特定の目的への適合性,セキュリティなどに関する欠陥,エラーやバグ,権利侵害などを含みます。）がないことを保証するものではありません。</li>
	<li>当社は,本サービスによってユーザーに生じたあらゆる損害について,一切の責任を負いません。ただし,本サービスに関する当社とユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合,この免責規定は適用されませんが,この場合であっても,当社は,当社の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害のうち特別な事情から生じた損害（当社またはユーザーが損害発生につき予見し,または予見し得た場合を含みます。）について一切の責任を負いません。</li>
	<li>当社は，本サービスに関して，ユーザーと他のユーザーまたは第三者との間において生じた取引，連絡または紛争等について一切責任を負いません。</li>
	</ol><br>

	<h4>第11条（サービス内容の変更等）</h4>
	<p>当社は，ユーザーに通知することなく，本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし，これによってユーザーに生じた損害について一切の責任を負いません。</p><br>

	<h4>第12条（利用規約の変更）</h4>
	<p>当社は，必要と判断した場合には，ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお，本規約の変更後，本サービスの利用を開始した場合には，当該ユーザーは変更後の規約に同意したものとみなします。</p><br>

	<h4>第13条（個人情報の取扱い）</h4>
	<p>当社は，本サービスの利用によって取得する個人情報については，当社「プライバシーポリシー」に従い適切に取り扱うものとします。</p><br>

	<h4>第14条（通知または連絡）</h4>
	<p>ユーザーと当社との間の通知または連絡は，当社の定める方法によって行うものとします。当社は,ユーザーから,当社が別途定める方式に従った変更届け出がない限り,現在登録されている連絡先が有効なものとみなして当該連絡先へ通知または連絡を行い,これらは,発信時にユーザーへ到達したものとみなします。</p><br>

	<h4>第15条（権利義務の譲渡の禁止）</h4>
	<p>ユーザーは，当社の書面による事前の承諾なく，利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し，または担保に供することはできません。</p><br>

	<h4>第16条（準拠法・裁判管轄）</h4>
	<ol>
	<li>本規約の解釈にあたっては，日本法を準拠法とします。なお，本サービスに関しては，国際物品売買契約に関する国際連合条約の適用を排除するものとします。</li>
	<li>本サービスに関して紛争が生じた場合には，当社の本店所在地を管轄する裁判所を専属的合意管轄裁判所とします。</li>
	</ol>
	</div>
	<div class="checkbox">
	<p class="checkbox-p"><input required type="checkbox" name="os" value="win7" class="checkbox-input">利用規約に同意する</p>
	</div>

	<div class="Price_inner">
	<!-- <form action="" method=""> 削除 -->
	<input type="submit" class="Price_box" value="入力内容を送信する">
	<!-- </form> 削除 -->
	</div>
</form>
<!-- </form> 処理追加 -->

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
