//
//   3.4 プレビュー表示
//

window.addEventListener('DOMContentLoaded', init);

var camera, controls, stats, box, scene, textures, path;
var currentCameraPos = 2000;
var X = 1500;
var Y = 1000;
var InitWidth = 500;
var InitHeight = 500;
var InitDepth = 500;
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
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/1.jpg' )}),
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/2.jpg' )}),
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/3.jpg' )}),
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/4.jpg' )}),
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/5.jpg' )}),
    	new THREE.MeshBasicMaterial({map: loadPic.load( '../img/6.jpg' )})
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
function RePreview(face_id){

  //ボックスを初期化
  scene.clear();
  
  //指定サイズを取得
  const width = parseInt(document.getElementById('width').value);
  const height = parseInt(document.getElementById('height').value);
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
  }, false);
  
  if( file ) {
    //アップロードファイル読み込み
    reader.readAsDataURL( file );
  }else{
    //画像が選択されていない面は初期画像を設定
    textures[face_id] = new THREE.MeshBasicMaterial({map: loadPic.load( '../img/' + (face_id + 1) + '.jpg' )});
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
  for(let faceno=0; faceno<6; ++faceno){
    RePreview(faceno);
  }
}

//
//	ボックス位置、テクスチャ、ズーム率、すべて初期化
//
function ResetAll(){
  scene.clear();
  init();
}

//
//	指定された画像を初期化
//
function ResetImage(){

	//現在のテクスチャをクリア
	scene.clear();
	
	//指定サイズを取得
  const width = parseInt(document.getElementById('width').value);
  const height = parseInt(document.getElementById('height').value);
  const depth = parseInt(document.getElementById('depth').value);

  //ボックスを再生成
  const geometry = new THREE.BoxGeometry(width,height,depth);
    
	const loadPic = new THREE.TextureLoader();
	for(let index=0; index < 6; ++index){
		//選択ファイルをクリア
		let file = document.querySelectorAll('#face')[index].files[0];
		if( file != null ){
      //アップロードされた画像をクリア
			document.querySelectorAll('#face')[index].files[0] = null;
			//親要素取得
			let parent = document.getElementById('preview' + index);
			//canvas要素削除
			parent.removeChild(parent.firstChild);
		}
		
		//初期画像を設定
		textures[index] = new THREE.MeshBasicMaterial({map: loadPic.load( '../img/' + (index + 1) + '.jpg' )});
		
		//新しいテクスチャの設定
  	let material = textures;
  	box = new THREE.Mesh(geometry, material);
  	scene.add(box);
	}
}