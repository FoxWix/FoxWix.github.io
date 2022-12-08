<?php
session_start();
require_once("./php/util.php");
require_once("./php/workDB_MF.php");

//ログイン情報
if(isset($_SESSION["user_data"])){
  $user_data = $_SESSION["user_data"];

  $user_name = $user_data["Name"];
  $address = $user_data["Address"];
  $user_address =  mb_split('\$',$address);
  $user_post = $user_data["Post"];
  $Login_flg = true;
}
else{
  header("Location:./login.php");
}
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style-order.css">
<link rel="icon" href="ico/favicon.ico">
  <!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>ご注文内容の確認 -</title>
</head>

<body>

  <script src="https://unpkg.com/three@0.137.4/build/three.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="js/event/designOrder.js"></script>
  <script src="js/object/render.js"></script>
  <script src="js/controls/OrbitControls.js"></script>
  <script src="js/dom/designDom.js"></script>
  <script src="js/event/designImage.js"></script>

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
    jQuery(document).ready(function () {
      var offset = 220;
      var duration = 500;
      jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > offset) {
          jQuery('.crunchify-top').fadeIn(duration);
        } else {
          jQuery('.crunchify-top').fadeIn(duration);
        }
      });

      jQuery('.crunchify-top').click(function (event) {
        event.preventDefault();
        jQuery('html, body').animate({ scrollTop: 0 }, duration);
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
            <a class="Breadcrumb-ListGroup-Item-Link"><span>ご注文内容の確認</span></a>
        </li>
    </ol>
</nav>
  <div id="register">
    <h2>ご注文内容の確認</h2>
  </div>

  <div class="Body_inner">
    <div class="Preview_inner">
      <p class="Preview_txt">プレビュー</p>
      <div class="Preview_box">
        <div id="wrapper">
          <style>
            * {
              padding: 0;
              margin: 0;
            }

            canvas {
              display: block;
            }

            html,
            body,
            #wrapper {
              width: 100%;
              height: 100%;
            }
          </style>
          <canvas id="canvas" width="" height=""></canvas>
        </div>
      </div>
    </div>
    <div id="table-btn-box">
      <table class="tbl_system01 tbl_system01--vertical">
        <tbody>
          <tr class="table-area">
            <th width="30%">品名</th>
            <td id="ordertype"></td>
          </tr>
          <tr class="table-area-02">
            <th class="size-th" width="30%">寸法</th>
            <td>
              <table border="1" style="border-collapse: collapse" class="table-size" bordercolor="#cccccc">
                <tr>
                  <th width="40%" class="size-th-02">長さ</th>
                  <td id="sl">300<span>mm</span></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-02">幅</th>
                  <td id="sw">300<span>mm</span></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-02">深さ</th>
                  <td id="sd">300<span>mm</span></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-02">寸法</th>
                  <td>外寸</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr class="table-area">
            <th width="30%">厚み</th>
            <td id="sth">3<span>mm</span></td>
          </tr>
          <tr class="table-area">
            <th width="30%">枚数</th>
            <td id="sq">2<span>枚</span></td>
          </tr>
          <tr class="table-area-02">
            <th class="size-th" width="30%">配送先</th>
            <td>
              <table border="1" style="border-collapse: collapse" class="table-size" bordercolor="#cccccc">
                <tr>
                  <th width="40%" class="size-th-03">郵便番号</th>
                  <td><span>〒 </span><?php echo mb_substr($user_post,0,3)?><span> - </span><?php echo mb_substr($user_post,3,4)?></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-03">都道府県</th>
                  <td><?php echo $user_address[0] ?></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-03">市区町村</th>
                  <td><?php echo $user_address[1] ?></td>
                </tr>
                <tr>
                  <th width="40%" class="size-th-03">番地・建物名</th>
                  <td><?php echo $user_address[2] ?></td>
                </tr>
              </table>
            </td>
          </tr>

          <tr class="table-area-03">
            <th class="size-th-04" width="30%">合計</th>
            <td>
              <table class="table-total">
                <tr>
                  <!-- id追加 -->
                  <th width="40%" class="size-th-03">単価</th>
                  <td id="price" align="right">5,000<span>円</span></td>
                </tr>
                <tr>
                  <!-- id追加 -->
                  <th width="40%" class="size-th-03">商品計</th>
                  <td id="total" align="right">10,000<span>円</span></td>
                </tr>
                <!-- 
                <tr>
                  <th width="40%" class="size-th-03">送料</th>
                  <td align="right">740<span>円</span></td>
                </tr> 
                -->
                <tr>
                  <!-- id追加 -->
                  <th width="40%" class="size-th-03 total">合計(税込)</th>
                  <td id="with-tax" align="right" class="total-td">10,000<span class="total-last-span">円</span></td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="Price_inner">
        <form action="./php/cart_add.php" method="POST">
          <input type="hidden" name="type"      id="type"     value="">
          <input type="hidden" name="length"    id="length"   value="">
          <input type="hidden" name="width"     id="width"    value="">
          <input type="hidden" name="depth"     id="depth"    value="">
          <input type="hidden" name="tmpId"     id="tmpId"    value="">
          <input type="hidden" name="color"     id="color"    value="">
          <input type="hidden" name="thickness" id="thickness"  value="">
          <input type="hidden" name="quantity"  id="quantity"   value="">
          <input type="hidden" name="img_src"   id="img_src"  value="">
          <input type="hidden" name="img_type"  id="img_type" value="">
          <input type="hidden" name="img_name"  id="img_name" value="">
          <input type="hidden" name="f_price"     id="f_price"    value="">
          <input type="submit" class="Price_box" value="カートに入れる">
        </form>
      </div>

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
