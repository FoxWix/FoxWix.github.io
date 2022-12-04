//************************************************************************** 
//  選択されたテンプレートの3Dプレビューを表示
//************************************************************************** 
document.getElementById("designTemp").addEventListener("click", () => {

    let tempEle = document.getElementsByName("TemplateSelect");
    for (let f = 0; f < tempEle.length; ++f) {

        tempEle[f].addEventListener("click", () => {

            //レンダリングの準備
            prepare();

            //選択されたテンプレートの番号を取得
            const tempId = parseInt(tempEle[f].value.substring(5, tempEle[f].value.length)) - 1;
            //選択されたテンプレートのサイズを取得
            const size = GetTempSize(tempId);
            //選択されたテンプレートのテクスチャを取得
            const tempTextures = GetTempTextures(tempId);

            //オブジェクトを生成
            createGeometry(tempId, size['length'], size['width'], size['depth'], tempTextures);

            //レンダリングの開始
            render();

        }, false);

    }

}, false);

//-------------------------------------------------------------------------
//  レンダリングの準備
//-------------------------------------------------------------------------
function prepare() {

    //画面サイズの初期化
    let offsetsize = GetOffsetSize('wrapper');
    let displayWidth = offsetsize['width'];
    let displayHeight = offsetsize['height'];

    //レンダラーの初期化
    renderer.clear();

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

    //XYZ軸をシーンに追加
    const axes = new THREE.AxesHelper(initaxesLength);
    scene.add(axes);

    //光源をシーンに追加
    const light = new THREE.AmbientLight(0xffffff);
    scene.add(light);

}

//--------------------------------------------------------------------------
//  オブジェクトを生成
//--------------------------------------------------------------------------
function createGeometry(tempid, length, width, depth, textures) {

    //テクスチャの設定
    const loadPic = new THREE.TextureLoader();
    textures = [

        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face1) }),
        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face2) }),
        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face3) }),
        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face4) }),
        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face5) }),
        new THREE.MeshBasicMaterial({ map: loadPic.load(textures.face6) })

    ]

    //オブジェクトを生成
    const geometry = new THREE.BoxGeometry(width, depth, length);

    //オブジェクトをシーンに追加
    box = new THREE.Mesh(geometry, textures);
    box.scale.set(initscaleX, initscaleY, initscaleZ);
    scene.add(box);

}

//--------------------------------------------------------------------------
//  レンダリング
//--------------------------------------------------------------------------
function render() {

    requestAnimationFrame(sceneRender);

    controls.update();

    renderer.render(scene, camera);

}

//---------------------------------------------------------------------------
//  引数で指定されたテンプレートのサイズを返却
//---------------------------------------------------------------------------
function GetTempSize(value) {

    let index_in = parseInt(value % 3);
    let index_out = parseInt(value / 3);

    const length = Template[index_out][index_in].length;
    const width = Template[index_out][index_in].width;
    const depth = Template[index_out][index_in].depth;

    return {
        length: length,
        width: width,
        depth: depth
    };

}

//------------------------------------------------------------------------
//  引数で指定されたテンプレートのテクスチャを返却
//------------------------------------------------------------------------
function GetTempTextures(value) {

    let index = parseInt(value / 3);

    return Template[index][3];

}