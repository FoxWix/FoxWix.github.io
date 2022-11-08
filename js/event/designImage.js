function Resize(index, width, height) {

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

            let src = canvas.toDataURL(canvas);

            //プレビューに表示
            document.getElementById('preview' + index).src = src;

            //対応する面のテクスチャを変更
            UpdateTexture(index, src);

        }

    }, false);

    if (file) {

        //アップロードファイル読み込み
        reader.readAsDataURL(file);

    }

}

//--------------------------------------------------------------------------
//  テクスチャの画像を一枚に結合
//--------------------------------------------------------------------------
function texturesConnection() {

    let textures = getTextures();

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

            if (GetImage(index) == null && DropListIsNone('DropColor' + index)) {

                alert('注文には、すべての面がデザインされている必要があります。');

                return false;

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
    let upimg = new Image();
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

        });

    }

}