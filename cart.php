<?php
session_start();
require_once("./php/util.php");
require_once("./php/workDB_MF.php");

//ログイン情報
if(isset($_SESSION["user_data"])){
  $user_data = $_SESSION["user_data"];
  $user_name = $user_data["Name"];
  $user_mail = $user_data["Mail"];
  $user_address = mb_split('\$',$user_data["Address"]);
  $prefecture = $user_address[0];
  $Login_flg = true;
}
else{
  $user_name = "";
  $Login_flg = false;
  header("Location:./login.php");
}

$cart = [];

if(GetData_Cart_CB("'{$user_mail}'") !== null)
  $cart = GetData_Cart_CB("'{$user_mail}'");

if(GetData_Cart_F("'{$user_mail}'") !== null)
  $cart = array_merge($cart,GetData_Cart_F("'{$user_mail}'"));

$prefecture_list = [
  ["北海道"],
  ["青森県","岩手県","宮崎県","山形県","福島県"],
  ["茨城県","群馬県","埼玉県","千葉県","東京県","神奈川県","山梨県"],
  ["岐阜県","静岡県","愛知県","三重県",],
  ["新潟県","長野県","富山県","石川県","福井県"],
  ["滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県"],
  ["鳥取県","島根県","岡山県","広島県","山口県"],
  ["徳島県","香川県","愛媛県","高知県"],
  ["福岡県","佐賀県","長崎県","大分県","熊本県","宮崎県","鹿児島県"],
  ["沖縄県"]
];

$delivery_list = "";
$postage = 0;
switch($prefecture){
  case in_array($prefecture,$prefecture_list[0]):
    $delivery_list = '<option value="1" selected>出荷日から4～6日後 </option>';
    $postage = 1700;
    break;
  case in_array($prefecture,$prefecture_list[1]):
    $delivery_list = '<option value="2" selected>2～3日後（翌々日～3日）</option>';
    $postage = 1260;
    break;
  case in_array($prefecture,$prefecture_list[2]):
    $delivery_list = '<option value="3" selected>2日後（翌々日）</option>';
    $postage = 1040;
    break;
  case in_array($prefecture,$prefecture_list[3]):
    $delivery_list = '<option value="3" selected>2日後（翌々日）</option>';
    $postage = 1150;
    break;
  case in_array($prefecture,$prefecture_list[4]):
    $delivery_list = '<option value="3" selected>2日後（翌々日）</option>';
    $postage = 930;
    break;
  case in_array($prefecture,$prefecture_list[5]):
    $delivery_list = '<option value="4" selected>1日後（翌日）</option>';
    $postage = 930;
    break;
  case in_array($prefecture,$prefecture_list[6]):
    $delivery_list = '<option value="2" selected>2～3日後（翌々日～3日）</option>';
    $postage = 930;
    break;
  case in_array($prefecture,$prefecture_list[7]):
    $delivery_list = '<option value="3" selected>2日後（翌々日）</option>';
    $postage = 1040;
    break;
  case in_array($prefecture,$prefecture_list[8]):
    $delivery_list = '<option value="3" selected>3～4日後（3～4日）</option>';
    $postage = 1040;
    break;
  case in_array($prefecture,$prefecture_list[9]):
    $delivery_list = '<option value="5" selected>（沖縄・離島）お問い合わせください </option>';
    $postage = 1370;
    break;
  default:
    $delivery_list = '<option value="6">（その他）お問い合わせください </option>';
    $postage = 1370;
    break;
}
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style-cart.css">
<link rel="icon" href="ico/favicon.ico">
  <!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
  <!-- 参考サイトリンク→ https://codepen.io/khurramalvi/pen/EKRQJZ -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>カート -</title>
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
            <a class="Breadcrumb-ListGroup-Item-Link"><span>カート</span></a>
        </li>
    </ol>
</nav>

  <main>
    <div class="basket">
      <!-- <div class="basket-module">
        <label for="promo-code">Enter a promotional code</label>
        <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
        <button class="promo-code-cta">Apply</button>
      </div> -->
      <div class="basket-labels">
        <ul>
          <li class="item item-heading">商品名</li>
          <li class="price price-li">価格</li>
          <li class="quantity quantity-li">個数</li>
          <li class="subtotal subtotal-li">小合計</li>
        </ul>
      </div>

      <?php
      //カートデータをリスト表示
      $file_path = "../images/designTextures/";
      $count = 0;
      $total = 0;
      foreach($cart as $data){
        if(mb_substr($data["cardboardID"],0,1) == "P"){
          $name      = "お客様プリント";
          $ID        = $data["cardboardID"];
          $tmpid     = "";
          $length    = $data["length"];
          $width     = $data["width"];
          $depth     = $data["depth"];
          $thickness = $data["thickness"];
          $quantity  = $data["quantity"];
          $color     = $data["color"];
          $imgpath   = $file_path . $data["imgpath"];
          $price = $data["price"];
          $total = $total + $price * $quantity;
        }
        else{
          $name      = "段ボールテンプレート";
          $ID        = $data["cardboardID"];
          $tmpid     = $data["tmpid"];
          $length    = "- ";
          $width     = "- ";
          $depth     = "- ";
          $thickness = "- ";
          $quantity  = $data["quantity"];
          $color     = $data["color"];
          $imgpath   = "";
          $price = $data["price"];
          $total = $total + $price * $quantity;
        }

        echo '<div class="basket-product">';
            echo '<div class="item">';
              echo '<div class="product-image">';
                echo '<img src="'.$imgpath.'" alt="" class="product-frame">';
              echo '</div>';
              echo '<div class="product-details">';
                echo '<h1><strong><span class="item-quantity">'.$quantity.'</span> x '.$name.'</strong></h1>';
                echo '<p><strong>'.$color.'</strong></p>';
                echo '<p>寸法<br> '.$length.'<span>mm</span> '.$width.'<span>mm</span> '.$depth.'<span>mm</span></p>';
                echo '<p>厚み<br>'.$thickness.'<span>mm</span></p>';
              echo '</div>'; 
            echo '</div>';
            echo '<div class="price">'.$price.'</div>';
            echo '<div class="quantity">';
              echo '<input id="'.$ID.'" type="number" value="'.$quantity.'" min="1" max="10" class="quantity-field">';
            echo '</div>';
            echo '<div class="subtotal">'.($price*$quantity).'</div>';
            echo '<div class="remove">';
              echo '<button id="'.$ID.'" >削除</button>';
            echo '</div>';
          echo '</div>';

        $count++;
      }
    
      ?>

    </div>
    <aside>
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> つの商品が入っています</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">小合計</div>
          <!-- 商品合計 -->
          <div class="subtotal-value final-value" id="basket-subtotal"><?php echo $total ?></div>
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo"></div>
          </div>
        </div>

        <div class="summary-subtotal">
          <div class="subtotal-title">送料</div>
          <!-- 送料 -->
          <div class="subtotal-value"><?php echo $postage; ?></div>
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo-02"></div>
          </div>
        </div>


        <div class="summary-delivery">
        <label>お届け日</label>
        <select name="delivery-collection" class="summary-delivery-selection">
          <?php echo $delivery_list; ?>
        </select>
        </div>

        <div class="summary-total">
          <div class="total-title">合計（税込）</div>
          <!-- 送料込み合計 -->
          <div class="total-value final-value total-color" id="basket-total"><?php echo floor($total*1.1) + $postage ?></div>
        </div>
        <div class="summary-checkout">
          <?php if(count($cart) > 0): ?>
            <button class="checkout-cta">注文を確定する</button>
          <?php endif; ?>
          <?php if(count($cart) == 0): ?>
            <button class="checkout-cta" disabled>注文を確定する</button>
          <?php endif; ?>
        </div>
      </div>
    </aside>
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
  <script>
    /* Set values + misc */
    var promoCode;
    var promoPrice;
    var fadeTime = 300;

    /* Assign actions */
    $('.quantity input').change(function () {
      //個数更新処理追加
      var id = $(this).attr("id");
      var quantity = $(this).val();
      var data = [id,quantity]; 
      fetch('./php/cart_update.php',{
        method:'POST',
        headers:{'Content-Type':'test/plain'},
        body: data
      })
      /*
      .then(response => response.text())
      .then(res => {
        console.log(res);
      })
      */
      
      updateQuantity(this);
    });

    $('.remove button').click(function () {
      //カート内データ削除処理追加
      var id = $(this).attr("id");
      fetch('./php/cart_remove.php',{
        method:'POST',
        headers:{'Content-Type':'test/plain'},
        body: id
      })
      /*
      .then(response => response.text())
      .then(res => {
        console.log(res);
      })
      */

      removeItem(this);
    });

    $(document).ready(function () {
      updateSumItems();
    });

    $('.promo-code-cta').click(function () {

      promoCode = $('#promo-code').val();

      if (promoCode == '10off' || promoCode == '10OFF') {
        //If promoPrice has no value, set it as 10 for the 10OFF promocode
        if (!promoPrice) {
          promoPrice = 10;
        } else if (promoCode) {
          promoPrice = promoPrice * 1;
        }
      } else if (promoCode != '') {
        alert("Invalid Promo Code");
        promoPrice = 0;
      }
      //If there is a promoPrice that has been set (it means there is a valid promoCode input) show promo
      if (promoPrice) {
        $('.summary-promo').removeClass('hide');
        $('.promo-value').text(promoPrice.toFixed());
        recalculateCart(true);
      }
    });

    /* Recalculate cart */
    function recalculateCart(onlyTotal) {
      var subtotal = 0;

      /* Sum up row totals */
      $('.basket-product').each(function () {
        subtotal += parseFloat($(this).children('.subtotal').text());
      });

      /* Calculate totals */
      var total = subtotal;

      //If there is a valid promoCode, and subtotal < 10 subtract from total
      var promoPrice = parseFloat($('.promo-value').text());
      if (promoPrice) {
        if (subtotal >= 10) {
          total -= promoPrice;
        } else {
          alert('Order must be more than £10 for Promo code to apply.');
          $('.summary-promo').addClass('hide');
        }
      }

      /*If switch for update only total, update only total display*/
      if (onlyTotal) {
        /* Update total display */
        $('.total-value').fadeOut(fadeTime, function () {
          $('#basket-total').html(total.toFixed());
          $('.total-value').fadeIn(fadeTime);
        });
      } else {
        /* Update summary display. */
        $('.final-value').fadeOut(fadeTime, function () {
          var postage = <?php echo $postage ?>;
          $('#basket-subtotal').html(subtotal.toFixed());
          $('#basket-total').html(((total*1.1)+postage).toFixed());
          if (total == 0) {
            $('.checkout-cta').fadeOut(fadeTime);
          } else {
            $('.checkout-cta').fadeIn(fadeTime);
          }
          $('.final-value').fadeIn(fadeTime);
        });
      }
    }

    /* Update quantity */
    function updateQuantity(quantityInput) {
      /* Calculate line price */
      var productRow = $(quantityInput).parent().parent();
      var price = parseFloat(productRow.children('.price').text());
      var quantity = $(quantityInput).val();
      var linePrice = Math.floor(price * quantity);

      /* Update line price display and recalc cart totals */
      productRow.children('.subtotal').each(function () {
        $(this).fadeOut(fadeTime, function () {
          $(this).text(linePrice.toFixed());
          recalculateCart();
          $(this).fadeIn(fadeTime);
        });
      });

      productRow.find('.item-quantity').text(quantity);
      updateSumItems();
    }

    function updateSumItems() {
      var sumItems = 0;
      $('.quantity input').each(function () {
        sumItems += parseInt($(this).val());
      });
      $('.total-items').text(sumItems);
    }

    /* Remove item from cart */
    function removeItem(removeButton) {
      /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function () {
        productRow.remove();
        recalculateCart();
        updateSumItems();
      });
    }

    $('.checkout-cta').click(function () {
      location.href = "./php/order_registration.php";
    });

  </script>
</body>
</html>
