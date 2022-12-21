//--------------------------------------------------------------------------
//  セッションストレージをクリア
//--------------------------------------------------------------------------
window.addEventListener('load', () => {

    sessionStorage.clear();

    for (let index = 0; index < 6; ++index) {

        DropListClear('DropColor' + index);

    }

    document.getElementById("SWP").style.display = "block";
    document.getElementById("TMP").style.display = "none";

}, false);

//--------------------------------------------------------------------------
//  ファイルが選択時、プレビューを表示し、3Dオブジェクトの対応する面に描画
//--------------------------------------------------------------------------
const userimage = document.getElementsByClassName('Userimg');
for (let index = 0; index < userimage.length; ++index) {

    userimage[index].addEventListener('change', () => {

        //ドロップリストを初期化
        DropListClear('DropColor' + index);

        //150*150にリサイズし、プレビューに表示
        Resize(index, 150, 150, true);

    }, false);

}

//--------------------------------------------------------------------------
//  色選択用のドロップリスト変更時、プレビューを表示
//--------------------------------------------------------------------------
const texture_color = document.getElementsByClassName('color');
for (let index = 0; index < texture_color.length; ++index) {

    texture_color[index].addEventListener('change', () => {

        if (DropListIsNone(texture_color[index].id)) {

            //
            //  選択なし
            //

            //画像プレビューを未選択に初期化
            ImagePreviewClear(index);

            //3Dオブジェクトの対応面を初期化
            ImageOneReset(index);

        } else {

            //
            //  選択あり
            //

            //アップロードされているファイルをクリア
            CrearFile(index);

            //色画像の相対パスを取得
            let path = GetColorImagePath(texture_color[index].id);

            //画像のプレビューを表示
            document.getElementById('preview' + index).src = path;

            //対応する面のテクスチャを変更
            UpdateTexture_C(index, path);

        }

    }, false);

}

//--------------------------------------------------------------------------
//  すべて初期化
//--------------------------------------------------------------------------
document.getElementById('resetAllBtn').addEventListener('click', () => {

    const files = document.getElementsByClassName('Userimg');
    for (let index = 0; index < 6; ++index) {

        //選択ファイルをクリア
        if (files[index].files != null) {

            //アップロードされた画像をクリア
            files[index].value = '';

        }

        //色選択のドロップリストを初期化
        DropListClear('DropColor' + index);

        //プレビュー画像を初期化
        ImagePreviewClear(index);

    }

    //none画像を設定
    document.getElementById('preview0').src = "../images/PreviewInitImages/none6.png"
    document.getElementById('preview1').src = "../images/PreviewInitImages/none5.png"
    document.getElementById('preview2').src = "../images/PreviewInitImages/none2.png"
    document.getElementById('preview3').src = "../images/PreviewInitImages/none4.png"
    document.getElementById('preview4').src = "../images/PreviewInitImages/none1.png"
    document.getElementById('preview5').src = "../images/PreviewInitImages/none3.png"

    //3Dオブジェクトの画像を初期化
    textureReset();

    //カメラの位置を初期化
    resetCameraPos();

    //ナビゲーションの表示設定
    hideNavi(!document.getElementById("check01").checked);

}, false);

//--------------------------------------------------------------------------
//	画像を初期化
//--------------------------------------------------------------------------
document.getElementById('resetImgBtn').addEventListener('click', () => {

    const files = document.getElementsByClassName('Userimg');
    for (let index = 0; index < 6; ++index) {

        //選択ファイルをクリア
        if (files[index].files != null) {

            //アップロードされた画像をクリア
            files[index].value = '';

        }

        //色選択のドロップリストを初期化
        DropListClear('DropColor' + index);

        //プレビュー画像を初期化
        ImagePreviewClear(index);

    }

    //none画像を設定
    document.getElementById('preview0').src = "../images/PreviewInitImages/none6.png"
    document.getElementById('preview1').src = "../images/PreviewInitImages/none5.png"
    document.getElementById('preview2').src = "../images/PreviewInitImages/none2.png"
    document.getElementById('preview3').src = "../images/PreviewInitImages/none4.png"
    document.getElementById('preview4').src = "../images/PreviewInitImages/none1.png"
    document.getElementById('preview5').src = "../images/PreviewInitImages/none3.png"

    //3Dオブジェクトの画像を初期化
    textureReset();
    
    //ナビゲーションの表示設定
    hideNavi(!document.getElementById('check01').checked);

}, false);

//--------------------------------------------------------------------------
//  ナビをの表示・非表示設定
//--------------------------------------------------------------------------
const NaviCheck = document.getElementById('check01');
NaviCheck.addEventListener('change', () => {

    hideNavi(!NaviCheck.checked);

}, false);

//--------------------------------------------------------------------------
//	指定サイズに応じてオブジェクトのサイズを変更
//--------------------------------------------------------------------------
const usersize = document.getElementsByClassName('Size_selection_inner');
for (let index = 0; index < usersize.length; ++index) {

    usersize[index].addEventListener('change', () => {

        //サイズを取得
        let length = GetLength();
        let width = GetWidth();
        let depth = GetDepth();

        //サイズの妥当性チェック
        if (length < 100 || length == '') {

            document.getElementById('length').value = 100;

            length = 100;

        } else if (length > 500) {

            document.getElementById('length').value = 500;

            length = 500;

        }
        if (width < 100 || width == '') {

            document.getElementById('width').value = 100;

            width = 100;

        } else if (width > 500) {

            document.getElementById('width').value = 500;

            width = 500;

        }
        if (depth < 100 || depth == '') {

            document.getElementById('depth').value = 100;

            depth = 100;

        } else if (depth > 500) {

            document.getElementById('depth').value = 500;

            depth = 500;

        }

        //オブジェクトの大きさを変更
        UpdateSize(length, width, depth);

    }, false);

}

//--------------------------------------------------------------------------
//  形状テンプレートの色選択ボタンを動的に生成
//--------------------------------------------------------------------------
const objcolor = document.getElementsByName('TemplateSelect');
for (let index = 0; index < objcolor.length; ++index) {

    objcolor[index].addEventListener('click', () => {

        let c = parseInt(objcolor[index].value.substring(5, objcolor[index].value.length)) - 1;

        CreateColorTag(Color.TemplateColor[c]);

    }, false);

    objcolor[index].addEventListener('change', () => {

        const path = Template[Math.floor(index / 3)][Math.floor(index % 3)].path;

        if (typeof path === 'undefined') return;

        document.getElementById("tmpImage").src = path;

    }, false);

}

//----------------------------------------------------------------------------
//  タブ切り替え時にmain関数を実行
//----------------------------------------------------------------------------
document.getElementById("btn1").addEventListener("click", () => {

    main();

}, false);


//=========================================================
//  デザインチームが用意した処理
//=========================================================

// jQueryクリックイベント
$('.Selection_btn').on('click', function () {
    $('.Selection_btn').removeClass('active');
    $(this).addClass('active');
});

function Display(no) {

    if (no == "no1") {

        document.getElementById("SW1").style.display = "block";
        document.getElementById('SW3').style.display = 'block';
        document.getElementById('SW4').style.display = 'block';
        document.getElementById("SW2").style.display = "none";

        document.getElementById("SWP").style.display = "block";
        document.getElementById("TMP").style.display = "none";

        //プレビューオブジェクトを表示
        boxVisible(true);

    } else if (no == "no2") {

        document.getElementById("SW1").style.display = "none";
        document.getElementById('SW3').style.display = 'none';
        document.getElementById('SW4').style.display = 'none';
        document.getElementById("SW2").style.display = "block";

        document.getElementById("SWP").style.display = "none";
        document.getElementById("TMP").style.display = "block";

        //プレビューオブジェクトを非表示
        boxVisible(false);

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
 $('.show_pop').on('dblclick',function(){
     $('.modal_pop').fadeIn();
 })
 $('.js-modal-close').on('click',function(){
     $('.modal_pop').fadeOut();
 })

//02
$('.modal_pop02').hide();
 $('.show_pop02').on('dblclick',function(){
     $('.modal_pop02').fadeIn();
 })
 $('.js-modal-close02').on('click',function(){
     $('.modal_pop02').fadeOut();
 })

//03
$('.modal_pop03').hide();
 $('.show_pop03').on('dblclick',function(){
     $('.modal_pop03').fadeIn();
 })
 $('.js-modal-close03').on('click',function(){
     $('.modal_pop03').fadeOut();
 })

//04
$('.modal_pop04').hide();
 $('.show_pop04').on('dblclick',function(){
     $('.modal_pop04').fadeIn();
 })
 $('.js-modal-close04').on('click',function(){
     $('.modal_pop04').fadeOut();
 })
