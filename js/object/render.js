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

//テクスチャ読み込み用
const loadPic = new THREE.TextureLoader();
const reader = new FileReader();

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
    let displayWidth = offsetsize['width'];
    let displayHeight = offsetsize['height'];

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
    const bl = GetLength();
    const bw = GetWidth();
    const bd = GetDepth();
    const geometry = new THREE.BoxGeometry(bw, bd, bl);
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

//--------------------------------------------------------------------------
//  テクスチャのリセット
//--------------------------------------------------------------------------
function textureReset() {

    //現在のテクスチャをクリア
    scene.clear();

    //指定サイズを取得
    let currentSize = GetSize();
    const length = currentSize['length'];
    const width = currentSize['width'];
    const depth = currentSize['depth'];

    //ボックスを再生成
    const geometry = new THREE.BoxGeometry(width, depth, length);

    const loadPic = new THREE.TextureLoader();

    for (let index = 0; index < 6; ++index) {

        //初期画像を設定
        textures[index] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/' + (index + 1) + '.jpg') });

        //新しいテクスチャの設定
        box = new THREE.Mesh(geometry, textures);
        box.scale.set(initscaleX, initscaleY, initscaleZ);
        scene.add(box);

        //XYZ軸をシーンに追加
        const axes = new THREE.AxesHelper(initaxesLength);
        scene.add(axes);

    }

}

//--------------------------------------------------------------------------
//  指定面のテクスチャを初期化
//--------------------------------------------------------------------------
function ImageOneReset(textureId) {

    textures[textureId] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/' + (textureId + 1) + '.jpg') });

}

//--------------------------------------------------------------------------
//  指定面のテクスチャを変更
//--------------------------------------------------------------------------
function UpdateTexture(textureId, src) {

    if (src == null || src == '') return;

    textures[textureId] = new THREE.MeshBasicMaterial({ map: loadPic.load(src) });

}

function UpdateTexture_C(textureId, path) {

    if (path == null || path == '') return;

    textures[textureId] = new THREE.MeshBasicMaterial({ map: loadPic.load(path) });

}

//--------------------------------------------------------------------------
//  指定サイズで再レンダリング
//--------------------------------------------------------------------------
function UpdateSize(length, width, depth) {

    //現在のテクスチャをクリア
    scene.clear();

    //ボックスを再生成
    const geometry = new THREE.BoxGeometry(width, depth, length);

    //テクスチャの設定
    box = new THREE.Mesh(geometry, textures);
    box.scale.set(initscaleX, initscaleY, initscaleZ);
    scene.add(box);

    //XYZ軸の追加
    let axes = new THREE.AxesHelper(initaxesLength);
    scene.add(axes);

}

//--------------------------------------------------------------------------
//  テクスチャを取得
//--------------------------------------------------------------------------
function getTextures() {
    
    return textures;

}

//--------------------------------------------------------------------------
//  テクスチャの画像を一枚に結合
//--------------------------------------------------------------------------
function texturesConnection() {

    //指定サイズ取得
    let size = GetSize();

    //描画準備
    let chip = new Array(6);
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

    //配列の初期化
    for (let index = 0; index < chip.length; ++index) {

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
    for (let f = 0; f < chip.length; ++f) {

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
            return "";

        });

    }
}