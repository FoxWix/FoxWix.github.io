//-----------------------------------------------------------------------
//  変数の宣言
//-----------------------------------------------------------------------
let renderer;
let camera;
let controls;
let stats;
let box;
let scene;
var textures;
let currentCameraPos = 2000;
//カメラの座標
let x = 1500;
let y = 1500;
//スケールサイズ
let initscaleX = 2;
let initscaleY = 2;
let initscaleZ = 2;
//XYZ軸の長さ
let initaxesLength = 700;
//背景色
let backgroundColor = 0xffffff;

//テクスチャ読み込み用
const loadPic = new THREE.TextureLoader();
const reader = new FileReader();

//*********************************************************************** 
//  メイン関数
//*********************************************************************** 
document.addEventListener('DOMContentLoaded', function () {

    main();

}, false);

function main() {

    //セッションストレージにテンプレート注文情報がある場合は実行終了
    if (sessionStorage.getItem('type') == 'T_order')
        return;

    //シーンの準備
    prepareScene();

    //レンダリングループ
    sceneRender();

}

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
    const loadPic = new THREE.TextureLoader();
    const session = sessionStorage.getItem('type');
    let bw, bd, bl;
    if (session) {

        //セッションストレージに値がある場合はその値でオブジェクトを生成

        bl = sessionStorage.getItem('length');
        bw = sessionStorage.getItem('width');
        bd = sessionStorage.getItem('depth');

        textures = [

            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture0')) }),
            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture1')) }),
            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture2')) }),
            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture3')) }),
            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture4')) }),
            new THREE.MeshBasicMaterial({ map: loadPic.load(sessionStorage.getItem('texture5')) })

        ];

        drawTexture();

    } else {

        bl = GetLength();
        bw = GetWidth();
        bd = GetDepth();

        textures = [

            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/1.jpg') }),
            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/2.jpg') }),
            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/3.jpg') }),
            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/4.jpg') }),
            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/5.jpg') }),
            new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/6.jpg') })

        ];

    }

    //オブジェクトを生成
    const geometry = new THREE.BoxGeometry(bw, bd, bl);

    //オブジェクトをシーンに追加
    box = new THREE.Mesh(geometry, textures);
    box.scale.set(initscaleX, initscaleY, initscaleZ);
    scene.add(box);

    //ナビゲーション用の平面を生成
    createNavigation(bl, bw, bd);

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

//-------------------------------------------------------------------------
//  ナビゲーションを追加
//-------------------------------------------------------------------------
function createNavigation(length, width, depth) {

    //XYZ軸の追加
    let axes = new THREE.AxesHelper(initaxesLength);
    scene.add(axes);

    //ナビゲーション用の平面を生成
    const span = 300;
    const PosPath = {
        pos: [
            new THREE.Vector3(width + span, 0, 0),
            new THREE.Vector3(-width - span, 0, 0),
            new THREE.Vector3(0, depth + span, 0),
            new THREE.Vector3(0, -depth - span, 0),
            new THREE.Vector3(0, 0, length + span),
            new THREE.Vector3(0, 0, -length - span)
        ],
        path: [
            '../images/PreviewInitImages/none6.png',
            '../images/PreviewInitImages/none5.png',
            '../images/PreviewInitImages/none2.png',
            '../images/PreviewInitImages/none4.png',
            '../images/PreviewInitImages/none1.png',
            '../images/PreviewInitImages/none3.png'
        ]
    }
    const loadPic = new THREE.TextureLoader();
    for (let f = 0; f < 6; ++f) {

        const sprite = new THREE.Sprite(new THREE.SpriteMaterial({ map: new THREE.TextureLoader().load(PosPath.path[f]) }));
        sprite.position.set(PosPath.pos[f].x, PosPath.pos[f].y, PosPath.pos[f].z);
        sprite.scale.set(400, 400, 400);

        scene.add(sprite);

    }

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

    }

    //新しいテクスチャの設定
    box = new THREE.Mesh(geometry, textures);
    box.scale.set(initscaleX, initscaleY, initscaleZ);
    scene.add(box);

    //ナビゲーション用の平面を生成
    createNavigation(length, width, depth);
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

    //ナビゲーションを追加
    createNavigation(length, width, depth);

}

//--------------------------------------------------------------------------
//  テクスチャを取得
//--------------------------------------------------------------------------
function getTextures() {

    return textures;

}

//----------------------------------------------------------------------------
//  タブ切り替え時にmain関数を実行
//----------------------------------------------------------------------------
document.getElementById("designCus").addEventListener("click", () => {

    main();

}, false);