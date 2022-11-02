window.addEventListener('DOMContentLoaded', init);

///////////////////////////////////////////////////
//
//  3.2 色を選択し、色データをブラウザに保存
//
///////////////////////////////////////////////////

//
//  選択された色に応じて色画像をリサイズして描画
// 
function GetColor( face_id ){

  //指定サイズを取得
  const l = GetLength();
  const w = GetWidth();

  //canvasの設定
  const place = document.createElement('canvas');
  const ctx = place.getContext('2d');

  //画像の作成
  const img = new Image();

  const loadPic = new THREE.TextureLoader();

  //プレビューの設定
  const preview = document.getElementById('preview' + face_id);
  if (  preview.firstChild  ) {

    preview.removeChild(preview.firstChild);
  
  }
  preview.appendChild(place);
  AppendPreview(face_id, place);

  //選択された色を取得
  let selectvalue = document.getElementById('face' + face_id).value;

  //画像パスの設定
  let path = "";
  if ( selectvalue == 'none' ){

    //パスのクリア
    path = '';
      
    //canvas要素削除
    let parent = document.getElementById('preview' + face_id);
    parent.removeChild(parent.firstChild);

    //ボックスのテクスチャを初期化
    textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( '../img/' + (face_id + 1) + '.jpg' )});

  } else if ( selectvalue == 'blue' ){

    path = '../img/Blue.jpg';

  } else if ( selectvalue == 'yellow' ){

    path = '../img/Yellow.jpg';

  } else if ( selectvalue == 'red'  ){

    path = '../img/Red.jpg';

  }

  img.src = path;
  img.onload = function () {

    //canvasの初期化
    place.width = l;
    place.height = w;
    ctx.clearRect(0, 0, l, w);
    
    //新しいサイズで画像を描画
    ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, l, w);

    //ボックスのテクスチャに設定
    textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( path )});

  }

}

///////////////////////////////////////////////////
//
//  3.3 段ボール各面に画像をアップロード
//      指定されたサイズで画像を整形し、画像をアップロードする
//
///////////////////////////////////////////////////

//
//  300 * 330で画像を表示
//
function ShowPreview( face_id ){

  const new_length = 300;
  const new_width = 330;

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

        document.getElementById('preview' + face_id).src = canvas.toDataURL();

      }

  }, false );

  if ( file ) {
    
    //アップロードファイル読み込み
    reader.readAsDataURL( file );
  
  }

  RePreview(face_id);
  
}

//
//  指定された幅、高さで画像を整形し、アップロード
//
function DrawImage( width, height, face_id ){

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
      ctx.clearRect(0, 0, width,  height);

      //新しいサイズで画像を描画
      ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, width, height);

      //対応する面に表示
      textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( canvas.toDataURL() )});

    }
  }, false );

  if( file ){

    //アップロードファイル読み込み
    reader.readAsDataURL( file );

  } else {
    
    //画像が選択されていない面は初期画像を設定
    textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/' + (face_id + 1) + '.jpg' )});
  
  }
}

///////////////////////////////////////////////////
//
//   3.4 プレビュー表示
//          指定面に指定された画像をボックスの対応する面に描画する。
//          また、サイズが変更された場合、ボックスおよびアップロードされている画像のリサイズを行う
//          ※ボックス＝プレビュー画面に表示されている箱
//
///////////////////////////////////////////////////
var camera, controls, stats, box, scene, textures;
var currentCameraPos = 2000;
var X = 1500;
var Y = 1000;
var InitLength = 300;
var InitWidth = 330;
var InitDepth = 200;
var InitScaleX = 2;
var InitScaleY = 2;
var InitScaleZ = 2;
var InitAxesLength = 700;
//
//  プレビュー表示
//
function init() {

  //wrapperタグから画面の大きさを設定
  let offsetsize = GetOffsetSize('wrapper');
  const width = offsetsize['width'];
  const height = offsetsize['height'];

  //レンダラーを作成
  const renderer = new THREE.WebGLRenderer({

    canvas: document.querySelector('canvas')
  
  });
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(width, height);
  
  //シーンを作成
  scene = new THREE.Scene();
  scene.background = new THREE.Color( 0x707070 );

  //カメラを作成
  camera = new THREE.PerspectiveCamera(45, width / height, 1, 10000);
  camera.position.set(X, Y, +currentCameraPos);
  
  //マウス操作
  controls = new THREE.OrbitControls( camera, renderer.domElement );
  
  //箱を作成
  const geometry = new THREE.BoxGeometry(InitWidth, InitDepth, InitLength);
  
  //テクスチャの設定
  const loadPic = new THREE.TextureLoader();
  textures = [
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/1.jpg' )}),
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/2.jpg' )}),
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/3.jpg' )}),
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/4.jpg' )}),
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/5.jpg' )}),
    new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/6.jpg' )})
  ];
    
  let material = textures;
  box = new THREE.Mesh(geometry, material);
  //ボックスのスケールを2倍に設定
  box.scale.set(InitScaleX, InitScaleY, InitScaleZ);
  scene.add(box);

  //XYZ軸を追加
  const currentSize = GetSize();
  let axes = new THREE.AxesHelper(InitAxesLength);
  scene.add(axes);

  //光源
	var light = new THREE.AmbientLight(0xffffff);
	scene.add(light);
 
  //初回実行
  tick();

  function tick() {

    requestAnimationFrame(tick);
    
    //マウス操作
    controls.update();
    
    //レンダリング
    renderer.render(scene, camera);

  }

}

//
//  指定された大きさで、指定面にアップロードされた画像を反映する
//
function RePreview( face_id ){

  //ボックスを初期化
  scene.clear();
  
  //指定サイズを取得
  let currentSize = GetSize();
  const length = currentSize['length'];
  const width = currentSize['width'];
  const depth = currentSize['depth'];

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(width, depth, length);
  
  //サイズに応じてテクスチャをリサイズ
  if(face_id < 2){

    DrawImage(length, depth, face_id);
    DrawImage(length, depth, face_id);
  
  }else if(face_id > 1 && face_id < 4){
    
    DrawImage(width, length, face_id);
    DrawImage(width, length, face_id);
  
  }else if(face_id > 3 && face_id < 6){
    
    DrawImage(width, depth, face_id);
    DrawImage(width, depth, face_id);
  
  }

  //テクスチャの設定
  let material = textures;
  box = new THREE.Mesh(geometry, material);
  box.scale.set(InitScaleX, InitScaleY, InitScaleZ);
  scene.add(box);

  //XYZ軸の追加
  let axes = new THREE.AxesHelper(InitAxesLength);
  scene.add(axes);

}

//
//  画像がアップロードされている面を指定された大きさで再プレビュー
//
function RePreviewAll(){

  for ( let faceno = 0; faceno < 6; ++faceno ){

    RePreview( faceno );
  
  }

}

//
//	指定された画像を初期化
//
function ResetImage(){

	//現在のテクスチャをクリア
	scene.clear();
	
	//指定サイズを取得
  let currentSize = GetSize();
  const length = currentSize['length'];
  const width = currentSize['width'];
  const depth = currentSize['depth'];

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(length, width, depth);
    
	const loadPic = new THREE.TextureLoader();

	for ( let index = 0; index < 6; ++index ){
		
    //選択ファイルをクリア
		let file = document.querySelectorAll('#face')[index].files[0];
		
    if( file != null ){
      
      //アップロードされた画像をクリア
			document.querySelectorAll('#face')[index].value = '';
		
    }

    //色選択のドロップリストを初期化
    document.getElementById('face' + index).options[0].selected = true;
    GetColor(index);
		
		//初期画像を設定
		textures[index] = new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/' + (index + 1) + '.jpg' )});
		
		//新しいテクスチャの設定
  	let material = textures;
  	box = new THREE.Mesh(geometry, material);
  	scene.add(box);

	}

}