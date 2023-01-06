//-----------------------------------------------------------------------
//  変数の宣言
//-----------------------------------------------------------------------
let renderer;
let camera;
let controls;
let stats;
let box;
let scene;
let textures = [];
let ren;
//オブジェクトとカメラの距離
const currentCameraPos = 2000;
//カメラの座標
const x = 1500;
const y = 1500;
//ボックスのスケールサイズ
const initscaleX = 2;
const initscaleY = 2;
const initscaleZ = 2;
//ナビゲーションのスケールサイズ
const scaleNavi = 400;
//XYZ軸の長さ
const initaxesLength = 5000;
//背景色
const backgroundColor = 0xffffff;

//テクスチャ読み込み用
const loadPic = new THREE.TextureLoader();
const reader = new FileReader();


//*********************************************************************** 
//  メイン関数
//*********************************************************************** 
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
//  HTMLのファイル解析後に実行
//--------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {

    main();

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
    const session = sessionStorage.getItem('type');
    let bw, bd, bl;
    if (session) {

        //セッションストレージに値がある場合はその値でオブジェクトを生成

        bl = parseInt(sessionStorage.getItem('length'));
        bw = parseInt(sessionStorage.getItem('width'));
        bd = parseInt(sessionStorage.getItem('depth'));

        for (let f = 0; f < 6; ++f) {

            let itemname = 'texture' + f;

            textures[f] = new THREE.MeshBasicMaterial({

                map: new THREE.TextureLoader().load(sessionStorage.getItem(itemname))

            });

        }

        drawTexture();

    } else {

        bl = GetLength();
        bw = GetWidth();
        bd = GetDepth();

        for (let f = 0; f < 6; ++f) {

            textures[f] = new THREE.MeshBasicMaterial({

                map: new THREE.TextureLoader().load('./images/PreviewInitImages/box.jpg')

            });

        }

    }

    //オブジェクトを生成
    const geometry = new THREE.BoxGeometry(bw, bd, bl);

    //オブジェクトをシーンに追加
    box = new THREE.Mesh(geometry, textures);
    box.scale.set(initscaleX, initscaleY, initscaleZ);
    box.name = "previewBox";
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
//  プレビューのボックスを非表示
//-------------------------------------------------------------------------
function boxVisible(visible) {

    scene.getObjectByName('previewBox').visible = visible;

    scene.getObjectByName('axes').visible = visible;

    for (let f = 0; f < 6; ++f) {

        scene.getObjectByName('navi' + f).visible = visible;

    }

}

//-------------------------------------------------------------------------
//  ナビゲーションを追加
//-------------------------------------------------------------------------
function createNavigation(length, width, depth) {

    //XYZ軸の追加
    const axes = new THREE.AxesHelper(initaxesLength);
    axes.name = "axes";
    scene.add(axes);

    //ナビゲーション用の画像を表示
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
    for (let f = 0; f < 6; ++f) {

        const sprite = new THREE.Sprite(new THREE.SpriteMaterial({ map: new THREE.TextureLoader().load(PosPath.path[f]) }));
        sprite.position.set(PosPath.pos[f].x, PosPath.pos[f].y, PosPath.pos[f].z);
        sprite.scale.set(scaleNavi, scaleNavi, scaleNavi);
        sprite.name = "navi" + f;

        scene.add(sprite);

    }

}

//--------------------------------------------------------------------------
//  ナビゲーションの表示非表示設定
//--------------------------------------------------------------------------
function hideNavi(cheked) {

    for (let f = 0; f < 6; ++f) {

        const navi = scene.getObjectByName('navi' + f);

        navi.visible = cheked;

    }

}

//--------------------------------------------------------------------------
//  カメラの位置を初期化
//--------------------------------------------------------------------------
function resetCameraPos() {

    camera.position.set(x, y, currentCameraPos);

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
        textures[index] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/box.jpg') });

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

    textures[textureId] = new THREE.MeshBasicMaterial({ map: loadPic.load('../images/PreviewInitImages/box.jpg') });

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

    //サイズチェック
    if (length < 100 || width < 100 || depth < 100) {
        return;
    }
    if (length > 500 || width > 500 || depth > 500) {
        return;
    }
    
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
