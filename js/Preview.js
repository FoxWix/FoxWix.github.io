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
  const w = parseInt(document.getElementById('length').value);
  const h = parseInt(document.getElementById('width').value);

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
    place.width = w;
    place.height = h;
    ctx.clearRect(0, 0, w, h);
    
    //新しいサイズで画像を描画
    ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, w, h);

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
//  指定された幅、高さで画像を整形し、アップロード
//
function Resize( face_id ){

  if ( face_id > 5 ) return;

  //長さ、幅を取得
  const new_width = parseInt(document.getElementById("length").value);
  const new_height = parseInt(document.getElementById("width").value);

  //画像の取得
  const file = document.querySelectorAll('#face')[face_id].files[0];
  const reader = new FileReader();
  
  //画像の作成
  const img = new Image();
  
  //canvasの生成
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  
  //プレビューの設定
  const preview = document.getElementById('preview' + face_id);
  if (  preview.firstChild  ) {

    preview.removeChild(preview.firstChild);

  }
  preview.appendChild(canvas);


  reader.addEventListener("load", function () {

      img.src = reader.result;
      
      img.onload = function () {

        //canvasの初期化
        canvas.width = new_width;
        canvas.height = new_height;
        ctx.clearRect(0, 0, new_width, new_height);

        //新しいサイズで画像を描画
        ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, new_width, new_height);

        document.getElementById('preview' + face_id).src = canvas.toDataURL();
      }

  }, false );

  if ( file ) {
    
    //アップロードファイル読み込み
    reader.readAsDataURL( file );
  
  }

}

//
//  画像がアップロードされている面をリサイズする
//
function ResizeAll(){

  for ( let faceno = 0; faceno < 6; ++faceno ){

    let file = document.querySelectorAll('#face')[faceno].files[0];

    if ( file != null ){

      Resize(faceno);
    
    }
  
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
var InitWidth = 300;
var InitHeight = 330;
var InitDepth = 200;
//
//  プレビュー表示
//
function init() {

  //wrapperタグから画面の大きさを設定
  let wrapper = document.getElementById('wrapper');
  const width = wrapper.offsetWidth;
  const height = wrapper.offsetHeight;

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
  const geometry = new THREE.BoxGeometry(InitWidth, InitHeight, InitDepth);
  
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
  scene.add(box);

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
  const width = parseInt(document.getElementById('length').value);
  const height = parseInt(document.getElementById('width').value);
  const depth = parseInt(document.getElementById('depth').value);

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(width, height, depth);
  
  //指定画像を取得
  const loadPic = new THREE.TextureLoader();
  const reader = new FileReader();
  const file = document.querySelectorAll('#face')[face_id].files[0];

  //新しい画像、描画準備
  const img = new Image();
  const place = document.createElement('canvas');
  const ctx = place.getContext('2d');

  
  reader.addEventListener("load", function () {

    img.src = reader.result;

    //画像の描画
    img.onload = function () {

      //canvasの初期化
      place.width = width;
      place.height = height;
      ctx.clearRect(0, 0, width, height);

      //新しいサイズで画像を描画
      ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, width, height);
      
      //指定された面に画像を設定
      textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( place.toDataURL() )});

    }

  }, false );
  
  if ( file ) {
    
    //アップロードファイル読み込み
    reader.readAsDataURL( file );
  
  } else {
    
    //画像が選択されていない面は初期画像を設定
    textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( '../images/PreviewInitImages/' + (face_id + 1) + '.jpg' )});
  
  }

  //テクスチャの設定
  let material = textures;
  box = new THREE.Mesh(geometry, material);
  scene.add(box);

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
  const width = parseInt(document.getElementById('length').value);
  const height = parseInt(document.getElementById('width').value);
  const depth = parseInt(document.getElementById('depth').value);

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(width,height,depth);
    
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