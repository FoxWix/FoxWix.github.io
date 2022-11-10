<?php
session_start();
require_once("./php/util.php");
require_once("./php/workDB_MF.php");

$_SESSION["cart"] = array_values($_SESSION["cart"]);
$cart = $_SESSION["cart"];
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style-cart.css">
  <!-- <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="//jpostal-1006.appspot.com/jquery.jpostal.js" type="text/javascript"></script> -->
  <!-- 参考サイトリンク→ https://codepen.io/khurramalvi/pen/EKRQJZ -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>カート -</title>
</head>

<body>
  <header id="header">
    <h1><a href="#" class="crunchify-top"><img src="images/Logo.png" alt="ブロック・デコ" height="60px" width="auto"></a></h1>
    <span class="head-pr">最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
    <div id="header-btns">
      <span class="User-inner">ユーザー：<span id="User-name">大阪太郎</span></span>
      <div id="flex-btns">
        <a href="" class="Cart_buttun">カート</a>
        <a href="" class="Login_buttun">ログイン</a>
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
        jQuery('html, body').animate({
          scrollTop: 0
        }, duration);
        return false;
      })
    });
  </script>


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
      $count = 0;
      foreach($cart as $data){
        $length    = $data["length"];
        $width     = $data["width"];
        $depth     = $data["depth"];
        $thickness = $data["thickness"];
        $quantity  = $data["quantity"];
        $color     = $data["color"];
        $imgpath   = $data["imgpath"];

        echo '<div class="basket-product">';
          echo '<div class="item">';
            echo '<div class="product-image">';
              echo '<img src="'.$imgpath.'" alt="" class="product-frame">';
            echo '</div>';
            echo '<div class="product-details">';
              echo '<h1><strong><span class="item-quantity">'.$quantity.'</span> x '."お客様プリント".'</strong></h1>';
              echo '<p><strong>'.$color.'</strong></p>';
              echo '<p>寸法<br> '.$length.'<span>mm</span> '.$width.'<span>mm</span> '.$depth.'<span>mm</span></p>';
              echo '<p>厚み<br>'.$thickness.'<span>mm</span></p>';
            echo '</div>'; 
          echo '</div>';
          echo '<div class="price">2600</div>';
          echo '<div class="quantity">';
            echo '<input type="number" value="'.$quantity.'" min="1" class="quantity-field">';
          echo '</div>';
          echo '<div class="subtotal">2600</div>';
          echo '<div class="remove">';
            echo '<button id="'.$count.'" >削除</button>';
          echo '</div>';
        echo '</div>';

        $count++;
      }
      

      ?>

      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="images/damball_03.png" alt="Placholder Image 2" class="product-frame">
          </div>

          <div class="product-details">
            <h1><strong><span class="item-quantity">1</span> x お客様プリント</strong></h1>
            <!-- <p><strong>Navy</strong></p> -->
            <p>寸法<br>300<span>mm</span> 300<span>mm</span> 300<span>mm</span></p>
            <p>厚み<br>3<span>mm</span></p>
          </div>

        </div>
        <div class="price">2600</div>
        <div class="quantity">
          <input type="number" value="1" min="1" class="quantity-field">
        </div>
        <div class="subtotal">2600</div>
        <div class="remove">
          <button>削除</button>
        </div>
      </div>

      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="images/damball_03.png" alt="Placholder Image 2" class="product-frame">
          </div>
          <div class="product-details">
            <h1><strong><span class="item-quantity">1</span> x Whistles</strong><!-- Amella Lace Midi Dress -->
            </h1>
            <p><strong>Pink</strong></p>
            <p>寸法<br>300<span>mm</span> 300<span>mm</span> 300<span>mm</span></p>
            <p>厚み<br>3<span>mm</span></p>
          </div>
        </div>
        <div class="price">2600</div>
        <div class="quantity">
          <input type="number" value="1" min="1" class="quantity-field">
        </div>
        <div class="subtotal">2600</div>
        <div class="remove">
          <button>削除</button>
        </div>
      </div>

    </div>
    <aside>
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> つの商品が入っています</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">小合計</div>
          <div class="subtotal-value final-value" id="basket-subtotal">7800</div>
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo"></div>
          </div>
        </div>

        <div class="summary-subtotal">
          <div class="subtotal-title">送料</div>
          <div class="subtotal-value">790</div>
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo-02"></div>
          </div>
        </div>


        <div class="summary-delivery">
          <select name="delivery-collection" class="summary-delivery-selection">
            <option value="0" selected="selected">お届け希望日</option>
            <option value="collection">出荷日から1～2日後（翌日～翌々日）</option>
            <option value="first-class">出荷日から2～3日後（翌々日～3日）</option>
            <option value="second-class">出荷日から3～5日後</option>
            <option value="signed-for">沖縄・離島 (お問い合わせ下さい)</option>
          </select>
        </div>

        <div class="summary-total">
          <div class="total-title">合計</div>
          <div class="total-value final-value total-color" id="basket-total">7800</div>
        </div>
        <div class="summary-checkout">
          <button class="checkout-cta">注文を確定する</button>
        </div>
      </div>
    </aside>
  </main>




  <footer id="Footer">
    <div class="Footer_inner">
      <ul class="Footer_ul">
        <li class="Footer_li"><a href="index.html" class="Footer_a">HOME</a></li>
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
  <script>
    /* Set values + misc */
    var promoCode;
    var promoPrice;
    var fadeTime = 300;

    /* Assign actions */
    $('.quantity input').change(function () {
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
      .then(response => response.text())
      .then(res => {
        console.log(res);
      })

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
        $('.promo-value').text(promoPrice.toFixed(2));
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
          $('#basket-subtotal').html(subtotal.toFixed());
          $('#basket-total').html(total.toFixed());
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
  </script>
</body>

</html>