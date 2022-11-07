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