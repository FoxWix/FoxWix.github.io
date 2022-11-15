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

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>【Bloc Deco (ブロック・デコ)】公式</title>
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
  <div class="MainVis">
    <img src="images/MainVisual.png" alt="メインビジュアル" class="MainVis_img">
    <img src="images/sp.png" alt="メインビジュアル" class="MainVis_sp">
  </div>
  <div class="MainVis_inner">
    <h2 class="MainVis_headline">まずは無料会員登録！</h2>
    <div class="MainVis_headline_flex">
      <p class="MainVis_headline_txt">
        お客様のご指定「サイズ・形状」に合わせた段ボール箱をオーダーメイドで製作します。<br>段ボールに、お客様のお好きなデザインをプリントする「お客様プリント」、<br>ここでしか取り扱っていない特殊なデザインや形状から選択する「デザインテンプレート」の２種類からお選びいただけます。
      </p>
      <img src="images/damball_01.png" alt="ダンボールイメージ" width="200" height="100">
    </div>
    <div class="Member_registration_button">
      <a href="register.php" class="Member_registration_txt btn--orange btn--radius">会員登録はこちら！</a>
    </div>
  </div>
  <div class="Selection_inner">
    <ul class="btns">
      <li class="Selection_btn active "><a href="javascript:;" onclick="Display('no1')" class="btn"
          id="btn1">お客様プリント</a></li>
      <li class="Selection_btn "><a href="javascript:;" onclick="Display('no2')" class="btn">デザインテンプレート</a></li>
    </ul>
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
    <div class="Custom_inner">
      <div id="SW1">
        <!-- <p>これはSW1のエリアです。上記SW2をクリックすると消えます。</p> -->
        <div class="Custom_image_box">
          <div class="Image_selection_txt_box">
            <p class="Image_selection_txt">画像</p>
          </div>
          <div>
            <div class="Image_selection_inner">
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none6.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview0">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file Userimg">
                <select class="Input_file color" id="DropColor0">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none5.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview1">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file  Userimg">
                <select class="Input_file color" id="DropColor1">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none2.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview2">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file  Userimg">
                <select class="Input_file color" id="DropColor2">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none4.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview3">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file  Userimg">
                <select class="Input_file color" id="DropColor3">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none1.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview4">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file Userimg">
                <select class="Input_file color" id="DropColor4">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
              <div class="Image_selection_box">
                <img src="images/PreviewInitImages/none3.png" alt="どこに画像がプリントされるかを示した画像" width="150px" id="preview5">
                <input type="file" accept=".png, .jpg, .jpeg" class="Input_file  Userimg">
                <select class="Input_file color" id="DropColor5">
                  <option value="none">選択なし</option>
                  <option value="blue">青色</option>
                  <option value="yellow">黄色</option>
                  <option value="red">赤色</option>
                  <option value="green">緑色</option>
                </select>
              </div>
            </div>
            <div id="Reset-inner">
              <button class="Reset_buttun" id="resetBtn">画像をリセット</button>
            </div>
          </div>
        </div>
        <hr width="100%">
      </div>
      <div id="SW2" style="display:none;">
        <!-- <p>これはSW2のエリアです。上記SW1をクリックすると消えます。</p> -->
        <div class="Custom_shape_box">
          <div class="Shape_selection_txt_box">
            <div class="Shape_txt_inner">
              <p class="Shape_selection_txt">形状</p>
              <p class="Shape_selection_txt">デザイン</p>
            </div>
          </div>
          <div class="Shape_selection_inner">
            <p id="tabcontrol">
              <a href="#tabpage1">タブ1</a>
              <a href="#tabpage2">タブ2</a>
              <a href="#tabpage3">タブ3</a>
              <a href="#tabpage4">タブ4</a>
            </p>
            <div id="tabbody">
              <div id="tabpage1" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape01" id="TemplateSelect01" checked><label
                  for="TemplateSelect01" class="show_pop" onclick="ChangeShowColor( 1 )"></label>
                <input type="radio" name="TemplateSelect" value="shape02" id="TemplateSelect02"><label
                  for="TemplateSelect02" class="show_pop02" onclick="ChangeShowColor( 2 )"></label>
                <input type="radio" name="TemplateSelect" value="shape03" id="TemplateSelect03"><label
                  for="TemplateSelect03" onclick="ChangeShowColor( 3 )"></label>
              </div>
              <div id="tabpage2" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape04" id="TemplateSelect04"><label
                  for="TemplateSelect04" onclick="ChangeShowColor( 4 )"></label>
                <input type="radio" name="TemplateSelect" value="shape05" id="TemplateSelect05"><label
                  for="TemplateSelect05" onclick="ChangeShowColor( 5 )"></label>
                <input type="radio" name="TemplateSelect" value="shape06" id="TemplateSelect06"><label
                  for="TemplateSelect06" onclick="ChangeShowColor( 6 )"></label>
              </div>
              <div id="tabpage3" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape07" id="TemplateSelect07"><label
                  for="TemplateSelect07" onclick="ChangeShowColor( 7 )"></label>
                <input type="radio" name="TemplateSelect" value="shape08" id="TemplateSelect08"><label
                  for="TemplateSelect08" onclick="ChangeShowColor( 8 )"></label>
                <input type="radio" name="TemplateSelect" value="shape09" id="TemplateSelect09"><label
                  for="TemplateSelect09" onclick="ChangeShowColor( 9 )"></label>
              </div>
              <div id="tabpage4" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape10" id="TemplateSelect10"><label
                  for="TemplateSelect10" onclick="ChangeShowColor( 10 )"></label>
                <input type="radio" name="TemplateSelect" value="shape11" id="TemplateSelect11"><label
                  for="TemplateSelect11" onclick="ChangeShowColor( 11 )"></label>
                <input type="radio" name="TemplateSelect" value="shape12" id="TemplateSelect12"><label
                  for="TemplateSelect12" onclick="ChangeShowColor( 12 )"></label>
              </div>
            </div>
          </div>
        </div>
        <hr width="100%">
        <div class="Custom_color_box">
          <div class="Color_selection_txt_box">
            <p class="Color_selection_txt">配色</p>
          </div>
          <div class="Color_selection_inner">
            <input type="radio" name="ColorSelect" value="color01" id="ColorSelect01" checked><label for="ColorSelect01"
              class="Color_label"></label>
            <input type="radio" name="ColorSelect" value="color02" id="ColorSelect02"><label for="ColorSelect02"
              class="Color_label"></label>
            <input type="radio" name="ColorSelect" value="color03" id="ColorSelect03"><label for="ColorSelect03"
              class="Color_label"></label>
            <input type="radio" name="ColorSelect" value="color04" id="ColorSelect04"><label for="ColorSelect04"
              class="Color_label"></label>
            <input type="radio" name="ColorSelect" value="color05" id="ColorSelect05"><label for="ColorSelect05"
              class="Color_label"></label>
            <input type="radio" name="ColorSelect" value="color06" id="ColorSelect06"><label for="ColorSelect06"
              class="Color_label"></label>
          </div>
        </div>
        <hr width="100%">
      </div>
      <div class="Custom_size_box">
        <!--<div class="Custom_size_inner">	
	    <div class="Size_selection_txt_box">
	      <p class="Size_selection_txt">寸法</p>
		  <p class="Size_selection_txt">(外寸)</p>
        </div>
	  </div> -->
        <div class="Size_txt_box">
          <div class="Size_txt_inner">
            <p class="Size_txt">寸法</p>
            <p class="Size_txt02">(外寸)</p>
          </div>
        </div>
        <div class="Size_inner">
          <div class="Size_selection_inner">
            <div class="Size_input">
              <label for="number">長さ</label><br>
              <input type="number" name="length" id="length" value="300" required class="Size_number" pattern="^[0-9]+$"
                min="100" max="500" /><!-- <span>cm</span> --><span class="Size_number_span">mm</span>
            </div>
            <div class="Size_input">
              <label for="number">幅</label><br>
              <input type="number" name="width" id="width" value="330" required class="Size_number" pattern="^[0-9]+$"
                min="100" max="500" /><!-- <span>cm</span> --><span class="Size_number_span">mm</span>
            </div>
            <div class="Size_input">
              <label for="number">深さ</label><br>
              <input type="number" name="depth" id="depth" value="220" required class="Size_number" pattern="^[0-9]+$"
                min="100" max="500" /><!-- <span>cm</span> --><span class="Size_number_span">mm</span>
            </div>
          </div>
          <!-- <div class="Size_cm_mm_inner">
	      <form method="post">
	        <div>
		      <label for="prefecture"></label><br>
		      <select name="prefecture">
		      <option value="外寸">外寸</option>
			  <option value="内寸">内寸</option>
		      </select>
	        </div>
		  </form>
<!-- ↓cm,mmボックス cm,mmの切り替えで上記にあるspanのcm,mmが切り替わる挙動を導入 -->
          <!-- <div class="Cm_mm_inner">
            <ul class="Cm_mm_ul">
              <li class="Cm_mm_li active02">cm</li>
              <li class="Cm_mm_li">mm</li>
            </ul>
          </div> -->
          <!-- cm,mmボックスここまで -->
          <!-- </div> -->
        </div>
      </div>
      <hr width="100%">
      <div class="Thickness_Custom_box">
        <div class="Thickness_txt_box">
          <p class="Thickness_txt">厚み</p>
        </div>
        <div class="Thickness_selection_inner">
          <input type="radio" name="ThicknessSelect" value="Thickness01" id="ThicknessSelect01" checked><label
            for="ThicknessSelect01" class="Thickness_label"></label>
          <input type="radio" name="ThicknessSelect" value="Thickness02" id="ThicknessSelect02"><label
            for="ThicknessSelect02" class="Thickness_label"></label>
          <input type="radio" name="ThicknessSelect" value="Thickness03" id="ThicknessSelect03"><label
            for="ThicknessSelect03" class="Thickness_label"></label>
        </div>
      </div>
      <hr width="100%">
      <div class="Number_Custom_box">
        <div class="Number_txt_box">
          <div class="Number_txt_inner">
            <p class="Number_txt">枚数</p>
            <!-- <p class="Number_txt">配送先</p> -->
          </div>
        </div>
        <div class="Number_selection_inner">
          <div class="Number_input">
            <label for="number">枚数</label><br>
            <input type="number" name="number" id="quantity" value="1" required class="Number_sheets" min="1"
              max="10" /><span class="Number_sheets_span">枚</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="Price_inner">
    <button class="Price_box" id="submit">価格の確認</button>
  </div>
  <!-- ここからデザインをダブルクリックするとポップアップする要素 -->
  <div class="modal_pop">
    <div class="bg js-modal-close"></div>
    <div class="modal_pop_main">
      <img src="images/Box-1.jpg" alt="ポップアップ01">
    </div>
  </div>
  <div class="modal_pop02">
    <div class="bg js-modal-close02"></div>
    <div class="modal_pop_main02">
      <img src="images/Box-2.jpg" alt="ポップアップ02">
    </div>
  </div>
  <!-- ポップアップここまで -->
  <footer id="Footer">
    <div class="Footer_inner">
      <ul class="Footer_ul">
        <li class="Footer_li"><a href="#" class="Footer_a">HOME</a></li>
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
    // jQueryクリックイベント
    $('.Selection_btn').on('click', function () {
      $('.Selection_btn').removeClass('active');
      $(this).addClass('active');
    });

    function Display(no) {

      if (no == "no1") {

        document.getElementById("SW1").style.display = "block";
        document.getElementById("SW2").style.display = "none";

      } else if (no == "no2") {

        document.getElementById("SW1").style.display = "none";
        document.getElementById("SW2").style.display = "block";

      }

    }

    // jQuery cm-mm切り替え01 getElementByClassNameで組まないといけないので注意
    $('.Cm_mm_li').on('click', function () {
      $('.Cm_mm_li').removeClass('active02');
      $(this).addClass('active02');
    });

    // ---------------------------
    // ▼A：対象要素を得る
    // ---------------------------
    var tabs = document.getElementById('tabcontrol').getElementsByTagName('a');
    var pages = document.getElementById('tabbody').getElementsByTagName('div');

    // ---------------------------
    // ▼B：タブの切り替え処理
    // ---------------------------
    function changeTab() {
      // ▼B-1. href属性値から対象のid名を抜き出す
      var targetid = this.href.substring(this.href.indexOf('#') + 1, this.href.length);

      // ▼B-2. 指定のタブページだけを表示する
      for (var i = 0; i < pages.length; i++) {
        if (pages[i].id != targetid) {
          pages[i].style.display = "none";
        }
        else {
          pages[i].style.display = "block";
        }
      }

      // ▼B-3. クリックされたタブを前面に表示する
      for (var i = 0; i < tabs.length; i++) {
        tabs[i].style.zIndex = "0";
      }
      this.style.zIndex = "10";

      // ▼B-4. ページ遷移しないようにfalseを返す
      return false;
    }

    // ---------------------------
    // ▼C：すべてのタブに対して、クリック時にchangeTab関数が実行されるよう指定する
    // ---------------------------
    for (var i = 0; i < tabs.length; i++) {
      tabs[i].onclick = changeTab;
    }

    // ---------------------------
    // ▼D：最初は先頭のタブを選択しておく
    // ---------------------------
    tabs[0].onclick();

    //ここから選んだテンプレートの展開図がポップアップ

    //1行目でロード時はポップアップを隠し、
    //2～4行目でボタンクリック時にポップアップを表示し
    //6～7行目で画面の背景をクリック時にポップアップを非表示にしています。
    //css追加するのを忘れるな！

    //参考サイト
    //https://mgmgblog.com/?p=641
    //https://zero-plus.io/media/jquery-dblclick/

    //01
    $('.modal_pop').hide();
    $('.show_pop').on('dblclick', function () {
      $('.modal_pop').fadeIn();
    })
    $('.js-modal-close').on('click', function () {
      $('.modal_pop').fadeOut();
    })

    //02
    $('.modal_pop02').hide();
    $('.show_pop02').on('dblclick', function () {
      $('.modal_pop02').fadeIn();
    })
    $('.js-modal-close02').on('click', function () {
      $('.modal_pop02').fadeOut();
    })

  </script>


  <script src="https://unpkg.com/three@0.137.4/build/three.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="js/object/render.js"></script>
  <script src="js/controls/OrbitControls.js"></script>
  <script src="js/dom/designDom.js"></script>
  <script src="js/event/designEvent.js"></script>
  <script src="js/event/designImage.js"></script>
  <script src="js/event/designSubmit.js"></script>

</body>

</html>