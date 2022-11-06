/*-------------------------------------------------------------------------
    プレビューに関する関数群

    ・3Dプレビュー画面
    ・画像のリサイズ
    ・画像のアップロード
    ・デザインを3Dオブジェクトへ反映
    ・色選択に応じて3Dオブジェクトのテクスチャ変更
    ・3Dオブジェクトのテクスチャを初期化
    ・アップロードされた画像を一枚に結合する
-------------------------------------------------------------------------*/

let renderer;
let camera;
let controls;
let stats;
let box;
let scene;
let textures;
let currentCameraPos = 2000;
//
//カメラのX座標
//
let x = 1500;
//
//カメラのY座標
//
let y = 1500;
//
//オブジェクトのサイズ
//
let initlength = 300;
let initwidth = 330;
let initdepth = 220;
//
//スケールサイズ
//
let initscaleX = 2;
let initscaleY = 2;
let initscaleZ = 2;
//
//XYZ軸の長さ
//
let initaxesLength = 700;
//
//背景色
//
let backgroundColor = 0xffffff;
//
// プレビュー画面のサイズ
//
let displayWidth;
let displayHeight;


//*********************************************************************** 
//  メイン関数
//*********************************************************************** 
document.addEventListener('DOMContentLoaded', function () {

  //シーンの準備
  prepareScene();

  //レンダリングループ
  sceneRender();

}, false);

//--------------------------------------------------------------------------
//  シーンの準備
//--------------------------------------------------------------------------
function prepareScene() {

  //画面サイズの初期化
  let offsetsize = GetOffsetSize('wrapper');
  displayWidth = offsetsize['width'];
  displayHeight = offsetsize['height'];

  //レンダラーの初期化
  renderer = new THREE.WebGLRenderer({

    canvas: document.querySelector('canvas')

  });
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(displayWidth, displayHeight);

  //シーンの初期化
  scene = new THREE.Scene();
  scene.background = new THREE.Color(backgroundColor);

  //カメラの初期化
  camera = new THREE.PerspectiveCamera(45, displayWidth / displayHeight, 1, 10000);
  camera.position.set(x, y, +currentCameraPos);

  //コントロールの初期化
  controls = new THREE.OrbitControls(camera, renderer.domElement);

  //オブジェクトの生成と初期テクスチャを設定
  const geometry = new THREE.BoxGeometry(initwidth, initdepth, initlength);
  const loadPic = new THREE.TextureLoader();
  textures = [
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/1.jpg') }),
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/2.jpg') }),
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/3.jpg') }),
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/4.jpg') }),
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/5.jpg') }),
    new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/6.jpg') })
  ];

  //オブジェクトをシーンに追加
  box = new THREE.Mesh(geometry, textures);
  box.scale.set(initscaleX, initscaleY, initscaleZ);
  scene.add(box);

  //XYZ軸をシーンに追加
  const axes = new THREE.AxesHelper(initaxesLength);
  scene.add(axes);

  //光源をシーンに追加
  const light = new THREE.AmbientLight(0xffffff);
  scene.add(light);

}

//--------------------------------------------------------------------------
//  レンダリング
//--------------------------------------------------------------------------
function sceneRender() {

  requestAnimationFrame(sceneRender);

  controls.update();

  renderer.render(scene, camera);

}



//************************************************************************ 
//  ユーザ関数
//************************************************************************ 
//--------------------------------------------------------------------------
//  指定された大きさで、指定面にアップロードされた画像を反映する
//--------------------------------------------------------------------------
function RePreview(face_id) {

  let droname = 'DropColor' + face_id;

  //ボックスを初期化
  scene.clear();

  //指定サイズを取得
  let currentSize = GetSize();
  const length = currentSize['length'];
  const width = currentSize['width'];
  const depth = currentSize['depth'];

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(width, depth, length);

  if (!DropListIsNone(droname)) {

    let path = GetColorImagePath(droname);

    if (face_id < 2) {

      SetColorImage_Box(face_id, length, depth, path);
      SetColorImage_Box(face_id, length, depth, path);

    } else if (face_id > 1 && face_id < 4) {

      SetColorImage_Box(face_id, width, length, path);
      SetColorImage_Box(face_id, width, length, path);

    } else if (face_id > 3 && face_id < 6) {

      SetColorImage_Box(face_id, width, depth, path);
      SetColorImage_Box(face_id, width, depth, path);

    }
  }

  if (face_id < 2) {

    SetImage_Box(length, depth, face_id);
    SetImage_Box(length, depth, face_id);

  } else if (face_id > 1 && face_id < 4) {

    SetImage_Box(width, length, face_id);
    SetImage_Box(width, length, face_id);

  } else if (face_id > 3 && face_id < 6) {

    SetImage_Box(width, depth, face_id);
    SetImage_Box(width, depth, face_id);

  }

  //テクスチャの設定
  box = new THREE.Mesh(geometry, textures);
  box.scale.set(initscaleX, initscaleY, initscaleZ);
  scene.add(box);

  //XYZ軸の追加
  let axes = new THREE.AxesHelper(initaxesLength);
  scene.add(axes);

}

//--------------------------------------------------------------------------
//  指定された幅、高さで画像を整形し、3Dプレビューに表示
//--------------------------------------------------------------------------
function SetImage_Box(width, height, face_id) {

  //アップロードファイル取得
  const file = GetImage(face_id);

  //リサイズの準備
  const img = new Image();
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');

  const loadPic = new THREE.TextureLoader();

  const reader = new FileReader();
  reader.addEventListener("load", function () {

    img.src = reader.result;

    img.onload = function () {

      //canvasの初期化
      canvas.width = width;
      canvas.height = height;
      ctx.clearRect(0, 0, width, height);

      //新しいサイズで画像を描画
      ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, width, height);

      //対応する面に表示
      textures[face_id] = new THREE.MeshBasicMaterial({ map: loadPic.load(canvas.toDataURL()) });

    }
  }, false);

  if (file) {

    //アップロードファイル読み込み
    reader.readAsDataURL(file);

  } else {

    //画像が選択されていない面は初期画像を設定
    textures[face_id] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/' + (face_id + 1) + '.jpg') });

  }

}

//--------------------------------------------------------------------------
//  引数の値で画像をリサイズし、3Dプレビューに表示
//--------------------------------------------------------------------------
function SetColorImage_Box(face_id, width, height, path) {

  //canvasの設定
  const place = document.createElement('canvas');
  const ctx = place.getContext('2d');

  //画像の作成
  const img = new Image();

  img.src = path;
  img.onload = function () {

    //canvasの初期化
    place.width = width;
    place.height = height;
    ctx.clearRect(0, 0, width, height);

    //新しいサイズで画像を描画
    ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, width, height);

    //ボックスのテクスチャに設定
    const loadPic = new THREE.TextureLoader();
    textures[face_id] = new THREE.MeshBasicMaterial({ map: loadPic.load(path) });

  }
}

//--------------------------------------------------------------------------
//  150 * 150で画像を表示
//--------------------------------------------------------------------------
function ShowPreview(face_id) {

  const new_length = 150;
  const new_width = 150;

  let droname = "DropColor" + face_id;
  let prename = 'preview' + face_id;

  //色選択用のドロップリストを初期化
  DropListClear(droname);

  //画像の取得
  const file = document.querySelectorAll('#face')[face_id].files[0];
  const reader = new FileReader();

  //画像の作成
  const img = new Image();

  //canvasの生成
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');

  //プレビューの設定
  AppendPreview(face_id, canvas);

  reader.addEventListener("load", function () {

    img.src = reader.result;

    img.onload = function () {

      //canvasの初期化
      canvas.width = new_length;
      canvas.height = new_width;
      ctx.clearRect(0, 0, new_length, new_width);

      //新しいサイズで画像を描画
      ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, new_length, new_width);

      document.getElementById(prename).src = canvas.toDataURL();

    }

  }, false);

  if (file) {

    //アップロードファイル読み込み
    reader.readAsDataURL(file);

  }

  RePreview(face_id);

}

//--------------------------------------------------------------------------
//  選択された色に応じて色画像をリサイズして描画
// --------------------------------------------------------------------------
function GetColor(face_id) {

  let droname = 'DropColor' + face_id;
  let prename = 'preview' + face_id;

  if (DropListIsNone(droname)) {

    //
    //  「選択なし」が選ばれている場合
    //

    //画像プレビューを未選択に初期化
    ImagePreviewClear(prename);

    //3Dプレビューのテクスチャを初期化
    const loadPic = new THREE.TextureLoader();
    textures[face_id] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/' + (face_id + 1) + '.jpg') });

  } else {

    //
    //  色が選択されている場合
    //

    //アップロードされているファイルをクリア
    document.querySelectorAll('#face')[face_id].value = '';

    //色画像の相対パスを取得
    let path = GetColorImagePath(droname);

    //画像のプレビューを表示
    document.getElementById(prename).src = path;

    //3Dプレビューの対応する面に画像を設定
    let size = GetSize();
    let l = size['length'];
    let w = size['width'];
    let d = size['depth'];
    if (face_id < 2) {

      SetColorImage_Box(face_id, l, d, path);
      SetColorImage_Box(face_id, l, d, path);

    } else if (face_id > 1 && face_id < 4) {

      SetColorImage_Box(face_id, w, l, path);
      SetColorImage_Box(face_id, w, l, path);

    } else if (face_id > 3 && face_id < 6) {

      SetColorImage_Box(face_id, w, d, path);
      SetColorImage_Box(face_id, w, d, path);

    }

  }

}

//--------------------------------------------------------------------------
//  画像がアップロードされている面を指定された大きさで再プレビュー
//--------------------------------------------------------------------------
function RePreviewAll() {

  for (let faceno = 0; faceno < 6; ++faceno) {

    RePreview(faceno);

  }

}


//************************************************************************
//  イベント
//************************************************************************
//--------------------------------------------------------------------------
//	指定された画像を初期化
//--------------------------------------------------------------------------
// document.getElementById('ttn').addEventListener('click', () => {

//   //現在のテクスチャをクリア
//   scene.clear();

//   //指定サイズを取得
//   let currentSize = GetSize();
//   const length = currentSize['length'];
//   const width = currentSize['width'];
//   const depth = currentSize['depth'];

//   //ボックスを再生成
//   const geometry = new THREE.BoxGeometry(length, width, depth);

//   const loadPic = new THREE.TextureLoader();

//   for (let index = 0; index < 6; ++index) {

//     //選択ファイルをクリア
//     let file = document.querySelectorAll('#face')[index].files[0];

//     if (file != null) {

//       //アップロードされた画像をクリア
//       document.querySelectorAll('#face')[index].value = '';

//     }

//     //色選択のドロップリストを初期化
//     DropListClear('DropColor' + index);

//     //プレビュー画像を初期化
//     ImagePreviewClear('preview' + index);

//     //初期画像を設定
//     textures[index] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/' + (index + 1) + '.jpg') });

//     //新しいテクスチャの設定
//     let material = textures;
//     box = new THREE.Mesh(geometry, material);
//     scene.add(box);

//   }

// }, false);

//--------------------------------------------------------------------------
//	画像を結合し、サイズを取得。POST送信後、確認画面に移行
//--------------------------------------------------------------------------
document.getElementById('submit').addEventListener('click', async () => {

  //指定サイズ取得
  let size = GetSize();

  //描画準備
  let chip = new Array(6); 
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');

  //配列の初期化
  for (let index = 0; index < chip.length; ++index){

    //デザインされていない場合は実行終了
    if (document.getElementById('SW1').style.display != 'none') {

      if (GetImage(index) == null || document.getElementById('preview' + index).firstChild == null) {
      
        alert('注文には、すべての面がデザインされている必要があります。');
        
        return;
  
      }
      
    }

    chip[index] = new Image(); 
    chip[index].src = textures[index].map.image.currentSrc;

  }

  //canvasのサイズを設定
  let max = size['length'];
  if (size['length'] < size['width']) max = size['width'];
  if (size['length'] < size['depth']) max = size['depth'];
  const width = size['length'] * 4 + size['width'] * 2;
  const height = size['length'];
  canvas.width = width;
  canvas.height = height

  //6枚の画像を連結
  for (let f = 0; f < chip.length; ++f){
    
    chip[f].onload = (function () {

      //描画座標を設定
      let x = 0;
      if (f == 1) x = size['length']; 
      if (f == 2) x = size['length'] * 2;
      if (f == 3) x = size['length'] * 2 + size['width'];
      if (f == 4) x = size['length'] * 2 + size['width'] * 2;
      if (f == 5) x = size['length'] * 3 + size['width'] * 2;

      //描画サイズを設定
      let width_d = 0;
      let height_d = 0;
      if (f == 0 || f == 1) {

        width_d = size['length'];
        height_d = size['depth'];

      } else if (f == 2 || f == 3) {

        width_d = size['width'];
        height_d = size['length'];

      } else if (f == 4 || f == 5) {

        width_d = size['width'];
        height_d = size['depth'];

      }

      ctx.drawImage(chip[f], 0, 0, chip[f].width, chip[f].height, x, 0, width_d, height_d);

      // canvas.toDataURL();

      //指定パスにアップロード

    });

  }


  //POSTデータ格納用変数
  let data = {};

  //厚みを取得
  let radio = document.getElementsByName('ThicknessSelect');
  let thicknessvalue = '';
  for ( let i = 0; i < radio.length; ++i ){

    if ( radio[i].checked ) {
      
      thicknessvalue = i;

    }

  }

  //数量を取得
  let quan = parseInt(document.getElementById('quantity').value);
  if (quan < 1 || quan == null) {

    alert('数量が選択されていません。');

    return;

  }
  if (quan > 10) {
    
    alert('数量は最大10個までです。');

    return;

  }


  //POSTデータを作成
  if ( document.getElementById('SW1').style.display != 'none' ) {
    
    //お客様プリント
    data = {

      //注文内容判別
      type: 'C_order',
      //長さ
      length: size['length'],
      //幅
      width: size['width'],
      //深さ
      depth: size['depth'],
      //デザイン画像パス
      imgpath: '',
      //厚み
      thickness: thicknessvalue,
      //数量
      quantity: quan
      
    }

  } else {


    //デザインテンプレート

    //選択形状取得
    let rb = document.getElementsByName('TemplateSelect');
    let selectvalue = '';
    for (let f = 0; f < rb.length; ++f) {
      
      if ( rb[f].checked ) {

        selectvalue = f;

      }

    }

    //選択色取得
    let c = document.getElementsByName('ColorSelect');
    let color = '';
    for (let k = 0; k < c.length; ++k){
      if (c[k].checked) {
        color = 'color' + k;
      }
    }
    
    data = {

      //注文内容判定
      type: 'T_order',
      //選択形状
      tmpId: selectvalue,
      //指定色
      color: color,
      //厚み
      thickness: thicknessvalue,
      //数量
      quantity: quan

    }
    
  }

  //POSTデータを送信
  $.ajax({

    type: 'POST',
    url: '../order.html',
    data: data,
    dataType: 'json'
    
  });

  //確認ページへ移動
  location.href = '../order.html';

}, false);