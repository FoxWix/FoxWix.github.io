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

<!doctype html>
<html lang="ja">
<!--langをhtmlに記載すること！ ヘッダーロゴを押すとトップページへ以降すると認識されているので、そのように変更すること！ コピーライトもログインのヤツに変更しておくこと！ -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="ico/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>【Bloc Deco (ブロック・デコ)】公式</title>
</head>

<body>
  <header id="header">
    <h1><a href="index.php" class="crunchify-top"><img src="images/Logo.png" alt="ブロック・デコ" height="60px"
          width="auto"></a></h1><span class="head-pr">最短当日発送<br>プレゼントならブロック・デコにお任せ！</span>
    <div id="header-btns">
      <!-- ログイン処理 -->
      <?php if ($Login_flg): ?>
      <span class="User-inner">ユーザー：<span id="User-name">
          <?php echo $user_name ?>
        </span></span>
      <?php endif; ?>
      <div id="flex-btns">
        <a href="./cart.php" class="Cart_buttun">カート</a>
        <?php if ($Login_flg): ?>
        <a href="./php/user_logout.php" class="Login_buttun">ログアウト</a>
        <?php endif; ?>
        <?php if (!$Login_flg): ?>
        <a href="./login.php" class="Login_buttun">ログイン</a>
        <?php endif; ?>
      </div>
    </div>
  </header>
  <div class="MainVis">
    <img src="images/MainVisual.png" alt="メインビジュアル" class="MainVis_img MainVis_pc">
    <img src="images/MainVisual-sp.png" alt="メインビジュアル" class="MainVis_sp">
    <div class="loop_wrap_pc MainVis_pc">
      <img src="images/Slider-pc.png" alt="スライダー"><img src="images/Slider-sp.png" alt="スライダー">
    </div>
    <div class="loop_wrap_sp1 MainVis_sp_s">
      <img src="images/Slider-sp.png" alt="スライダー"><img src="images/Slider-sp.png" alt="スライダー">
    </div>
    <div class="loop_wrap_sp2 MainVis_sp_s">
      <img src="images/Slider-pc.png" alt="スライダー"><img src="images/Slider-pc.png" alt="スライダー">
    </div>
  </div>
  <div class="MainVis_inner">
    <div class="register">
      <h2 class="MainVis_headline">ブロック・デコってなに？</h2>
    </div>
    <div class="MainVis_headline_flex">
      <p class="MainVis_headline_txt">Bloc Deco
        (ブロック・デコ)は、お客様のご指定「サイズ・形状」に合わせた段ボール箱を製作するオーダーメイド段ボールサービスです。<br><br>お客様の「プレゼントを入れる箱にもこだわりたい！」、「手軽に写真やデザインを箱にプリントしたい！」といった要望に応えるため、段ボールに、お客様のお好きなデザインをプリントする<span>「お客様プリント」</span>、ここでしか取り扱っていない特殊なデザインや形状から選択する<span>「デザインテンプレート」</span>の２種類をご用意しております。
      </p>
      <img src="images/damball_01.png" alt="ダンボールイメージ" width="250" height="278">
    </div>
  </div>
  <div id="Guide">
    <div class="register">
      <h2>サイトの使い方</h2>
    </div>
    <div id="Lead-Wire">
      <div class="Conductor-Element">
        <img src="images/Lead-Wire.png" alt="サイトの導線" id="Image-Element" width="1100px">
        <div class="Member_registration_button">
          <a href="register.php" class="Member_registration_txt btn--orange btn--radius">会員登録はこちら</a>
        </div>
      </div>
    </div>
  </div>
  <div class="Selection_inner">
    <ul class="btns">
      <li class="Selection_btn active "><a href="javascript:;" onclick="Display('no1')" class="btn"
          id="btn1">お客様プリント</a></li>
      <li class="Selection_btn "><a href="javascript:;" onclick="Display('no2')" class="btn"
          id="designTemp">デザインテンプレート</a></li>
    </ul>
  </div>
  <div class="Body_inner">
    <div class="Preview_inner" id="SWP">
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
        <p class="Display_bottun">
          <label class="check-box" for="check01">
            <input type="checkbox" id="check01">
            <span class="check-text"></span>
          </label>
        </p>
      </div>
    </div>
    <div id="TMP" class="Preview_inner">
      <div class="Preview_box">
        <img src="/images/Design01-A-preview.png" id="tmpImage" width="400" height="400">
      </div>
    </div>
    <div class="Custom_inner">
      <div id="SW1">
        <!-- <p>これはSW1のエリアです。上記SW2をクリックすると消えます。</p> -->
        <div class="Custom_image_box">
          <div class="Image_selection_txt_box">
            <p class="Image_selection_txt">画像</p>
          </div>
          <div class="Image_box_buttun_flex">
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
            <!-- ここからリセットボタン -->
            <div id="Reset-inner">
              <p>
                <img src="images/Reset-icon.png" alt="リセット" width="50" height="50" class="Reset_Single"
                  id="resetImgBtn">
              </p>
              <p>
                <img src="images/Reset-icon-all.png" alt="リセット" width="50" height="50" class="Reset_All"
                  id="resetAllBtn">
              </p>
            </div>
            <!-- ここまで -->
          </div>
        </div>
        <hr width="100%">
      </div>
      <div id="SW2" style="display:none;">
        <!-- <p>これはSW2のエリアです。上記SW1をクリックすると消えます。</p> -->
        <div class="Custom_shape_box">
          <div class="Shape_selection_txt_box">
            <div class="Shape_txt_inner">
              <p class="Shape_selection_txt">デザイン</p>
              <p class="Shape_selection_txt">形状</p>
            </div>
          </div>
          <div class="Shape_selection_inner">
            <p id="tabcontrol">
              <a href="#tabpage1">デザイン</a>
              <a href="#tabpage2">形状
                <!-- (普) -->
              </a>
              <!-- <a href="#tabpage3">形状(普)</a> -->
              <!-- <a href="#tabpage4">タブ4</a> -->
            </p>
            <div id="tabbody">
              <div id="tabpage1" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape01" id="TemplateSelect01"><label
                  for="TemplateSelect01" class="show_pop"></label>
                <input type="radio" name="TemplateSelect" value="shape02" id="TemplateSelect02"><label
                  for="TemplateSelect02" class="show_pop"></label>
                <input type="radio" name="TemplateSelect" value="shape03" id="TemplateSelect03"><label
                  for="TemplateSelect03" class="show_pop"></label>
                <input type="radio" name="TemplateSelect" value="shape04" id="TemplateSelect04"><label
                  for="TemplateSelect04" class="show_pop02"></label>
                <input type="radio" name="TemplateSelect" value="shape05" id="TemplateSelect05"><label
                  for="TemplateSelect05" class="show_pop02"></label>
                <input type="radio" name="TemplateSelect" value="shape06" id="TemplateSelect06"><label
                  for="TemplateSelect06" class="show_pop02"></label>
                <input type="radio" name="TemplateSelect" value="shape07" id="TemplateSelect07"><label
                  for="TemplateSelect07" class="show_pop03"></label>
                <input type="radio" name="TemplateSelect" value="shape08" id="TemplateSelect08"><label
                  for="TemplateSelect08" class="show_pop03"></label>
                <input type="radio" name="TemplateSelect" value="shape09" id="TemplateSelect09"><label
                  for="TemplateSelect09" class="show_pop03"></label>
                <input type="radio" name="TemplateSelect" value="shape10" id="TemplateSelect10"><label
                  for="TemplateSelect10" class="show_pop04"></label>
                <input type="radio" name="TemplateSelect" value="shape11" id="TemplateSelect11"><label
                  for="TemplateSelect11" class="show_pop04"></label>
                <input type="radio" name="TemplateSelect" value="shape12" id="TemplateSelect12"><label
                  for="TemplateSelect12" class="show_pop04"></label>
                <input type="radio" name="TemplateSelect" value="shape13" id="TemplateSelect13"><label
                  for="TemplateSelect13"></label>
                <input type="radio" name="TemplateSelect" value="shape14" id="TemplateSelect14"><label
                  for="TemplateSelect14"></label>
                <input type="radio" name="TemplateSelect" value="shape15" id="TemplateSelect15"><label
                  for="TemplateSelect15"></label>
                <input type="radio" name="TemplateSelect" value="shape16" id="TemplateSelect16"><label
                  for="TemplateSelect16"></label>
                <input type="radio" name="TemplateSelect" value="shape17" id="TemplateSelect17"><label
                  for="TemplateSelect17"></label>
                <input type="radio" name="TemplateSelect" value="shape18" id="TemplateSelect18"><label
                  for="TemplateSelect18"></label>
                <input type="radio" name="TemplateSelect" value="shape19" id="TemplateSelect19"><label
                  for="TemplateSelect19"></label>
                <input type="radio" name="TemplateSelect" value="shape20" id="TemplateSelect20"><label
                  for="TemplateSelect20"></label>
                <input type="radio" name="TemplateSelect" value="shape21" id="TemplateSelect21"><label
                  for="TemplateSelect21"></label>
              </div>
              <div id="tabpage2" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape22" id="TemplateSelect22"><label
                  for="TemplateSelect22"></label>
                <input type="radio" name="TemplateSelect" value="shape23" id="TemplateSelect23"><label
                  for="TemplateSelect23"></label>
                <input type="radio" name="TemplateSelect" value="shape24" id="TemplateSelect24"><label
                  for="TemplateSelect24"></label>
                <input type="radio" name="TemplateSelect" value="shape25" id="TemplateSelect25"><label
                  for="TemplateSelect25"></label>
                <input type="radio" name="TemplateSelect" value="shape26" id="TemplateSelect26"><label
                  for="TemplateSelect26"></label>
                <input type="radio" name="TemplateSelect" value="shape27" id="TemplateSelect27"><label
                  for="TemplateSelect27"></label>
                <input type="radio" name="TemplateSelect" value="shape28" id="TemplateSelect28"><label
                  for="TemplateSelect28"></label>
                <input type="radio" name="TemplateSelect" value="shape29" id="TemplateSelect29"><label
                  for="TemplateSelect29"></label>
                <input type="radio" name="TemplateSelect" value="shape30" id="TemplateSelect30"><label
                  for="TemplateSelect30"></label>
                <input type="radio" name="TemplateSelect" value="shape31" id="TemplateSelect31"><label
                  for="TemplateSelect31"></label>
                <input type="radio" name="TemplateSelect" value="shape32" id="TemplateSelect32"><label
                  for="TemplateSelect32"></label>
                <input type="radio" name="TemplateSelect" value="shape33" id="TemplateSelect33"><label
                  for="TemplateSelect33"></label>
              </div>
              <div id="tabpage3" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape07" id="TemplateSelect07"><label
                  for="TemplateSelect07"></label>
                <input type="radio" name="TemplateSelect" value="shape08" id="TemplateSelect08"><label
                  for="TemplateSelect08"></label>
                <input type="radio" name="TemplateSelect" value="shape09" id="TemplateSelect09"><label
                  for="TemplateSelect09"></label>
              </div>
              <div id="tabpage4" class="Shape_selection_tab">
                <input type="radio" name="TemplateSelect" value="shape10" id="TemplateSelect10"><label
                  for="TemplateSelect10"></label>
                <input type="radio" name="TemplateSelect" value="shape11" id="TemplateSelect11"><label
                  for="TemplateSelect11"></label>
                <input type="radio" name="TemplateSelect" value="shape12" id="TemplateSelect12"><label
                  for="TemplateSelect12"></label>
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
        <div class="Size_txt_box" id="SW3">
          <div class="Size_txt_inner">
            <p class="Size_txt">寸法</p>
            <p class="Size_txt02">(外寸)</p>
          </div>
        </div>
        <div class="Size_inner" id="SW4">
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
      ↓cm,mmボックス cm,mmの切り替えで上記にあるspanのcm,mmが切り替わる挙動を導入 -->
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
      <img src="images/Box-1.png" alt="ポップアップ01">
    </div>
  </div>
  <div class="modal_pop02">
    　<div class="bg js-modal-close02"></div>
    <div class="modal_pop_main02">
      <img src="images/Box-2.png" alt="ポップアップ02">
    </div>
  </div>
  <div class="modal_pop03">
    　<div class="bg js-modal-close03"></div>
    <div class="modal_pop_main03">
      <img src="images/Box-3.png" alt="ポップアップ03">
    </div>
  </div>
  <div class="modal_pop04">
    　<div class="bg js-modal-close04"></div>
    <div class="modal_pop_main04">
      <img src="images/Box-4.png" alt="ポップアップ04">
    </div>
  </div>
  <!-- ポップアップここまで -->
  <footer id="Footer">
    <div class="Footer_inner">
      <ul class="Footer_ul">
        <li class="Footer_li"><a href="#" class="Footer_a crunchify-top">HOME</a></li>
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

  <script src="https://unpkg.com/three@0.137.4/build/three.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="js/common/designCommon.js"></script>
  <script src="js/dom/designDom.js"></script>
  <script src="js/event/designEvent.js"></script>
  <script src="js/event/designImage.js"></script>
  <script src="js/event/designSubmit.js"></script>
  <script src="js/object/render.js"></script>
  <script src="js/controls/OrbitControls.js"></script>

</body>

</html>
