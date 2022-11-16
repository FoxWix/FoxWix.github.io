//--------------------------------------------------------------------------
//  指定されたサイズで画像をリサイズ
//--------------------------------------------------------------------------
function Resize(index, width, height, preview) {

    //アップロードファイル取得
    let file = GetImage(index);

    //リサイズの準備
    const img = new Image();
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

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

            let src = canvas.toDataURL();

            if (!preview) {

                //対応する面のテクスチャを変更
                UpdateTexture(index, src);

            } else {

                //プレビューに表示
                document.getElementById('preview' + index).src = src;

                //対応する面のテクスチャを変更
                UpdateTexture(index, src);

            }

        }

    }, false);

    if (file) {

        //アップロードファイル読み込み
        reader.readAsDataURL(file);

    }

}

//----------------------------------------------------------------------
//  テクスチャを指定サイズで描画し、アップデート
//----------------------------------------------------------------------
function drawTexture() {

    let texture = new Array(6);
    const len = sessionStorage.getItem('length');
    const wid = sessionStorage.getItem('width');
    const dep = sessionStorage.getItem('depth');

    //各面をユーザー指定のサイズでリサイズ
    const img = new Image();
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

    for (let f = 0; f < texture.length; ++f) {

        let s = GetWH(f, len, wid, dep);

        img.src = sessionStorage.getItem('texture' + f);

        img.onload = function () {

            //canvasの初期化
            canvas.width = s['width'];
            canvas.height = s['height'];
            ctx.clearRect(0, 0, s['width'], s['height']);

            //新しいサイズで画像を描画
            ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, s['width'], s['height']);

            UpdateTexture(f, canvas.toDataURL());

        }

    }

    return texture;

}

//--------------------------------------------------------------------------
//  テクスチャの画像を一枚に結合
//--------------------------------------------------------------------------
function texturesConnection(form) {

    try {

        //テクスチャを取得
        let textures = getTextures();

        //描画準備
        let chip = new Array(6);
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        //セッションストレージより指定サイズを取得
        const length_s = parseInt(sessionStorage.getItem('length'));
        const width_s = parseInt(sessionStorage.getItem('width'));
        const depth_s = parseInt(sessionStorage.getItem('depth'));

        //canvasのサイズを設定
        const width = length_s * 2 + width_s * 4;
        const height = length_s;
        canvas.width = width;
        canvas.height = height

        //6枚の画像を連結
        for (let f = 0; f < chip.length; ++f) {

            chip[f] = new Image();
            chip[f].src = textures[f].map.image.currentSrc;

            chip[f].onload = (function () {

                //各面の幅、高さを取得
                let ds = GetWH(f, length_s, width_s, depth_s);

                //描画先のX座標を算出
                let x = 0;
                let len2 = length_s * 2;
                if (f == 1) x = length_s;
                if (f == 2) x = len2;
                if (f == 3) x = len2 + width_s;
                if (f == 4) x = len2 + width_s * 2;
                if (f == 5) x = len2 + width_s * 3;

                ctx.drawImage(chip[f], 0, 0, chip[f].width, chip[f].height, x, 0, ds['width'], ds['height']);

                //formに設定
                form.value = canvas.toDataURL('image/jpeg');

            });

        }

        return true;

    } catch {

        return false;

    }

}

//----------------------------------------------------------------------------
//  引数で指定された面の幅、高さを返却
//----------------------------------------------------------------------------
function GetWH(face_id, length, width, depth) {

    let wh = {};

    if (face_id < 2) {

        wh = { width: length, height: depth };

    } else if (face_id > 1 && face_id < 4) {

        wh = { width: width, height: length };

    } else if (face_id > 3 && face_id < 6) {

        wh = { width: width, height: depth };

    }

    return wh;

}