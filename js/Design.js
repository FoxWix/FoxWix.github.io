//
//  3.3 段ボール各面に画像をアップロード
//


//
//  指定された幅、高さで画像を整形し、アップロード
//
function Resize(face_id){
    
    //指定された面番号が6以上は実行終了
    if(face_id > 5) return;

    //幅、高さを取得
    const new_width = parseInt(document.getElementById("width").value);
    const new_height = parseInt(document.getElementById("height").value);
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
    if (preview.firstChild) {
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
        }
    }, false);

    if( file ) {
         //アップロードファイル読み込み
        reader.readAsDataURL( file );
    }
}

//
//  画像がアップロードされている面をリサイズする
//
function ResizeAll(){
    for(let faceno=0; faceno<6; ++faceno){
        
        let file = document.querySelectorAll('#face')[faceno].files[0];
        
        if( file != null ){
            Resize(faceno);
        }

    }
}