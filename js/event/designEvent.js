//--------------------------------------------------------------------------
//  ファイルが選択時、プレビューを表示し、3Dオブジェクトの対応する面に描画
//--------------------------------------------------------------------------
const userimage = document.getElementsByClassName('Userimg');
for (let index = 0; index < userimage.length; ++index) {

    userimage[index].addEventListener('change', () => {

        //ドロップリストを初期化
        DropListClear('DropColor' + index);

        //150*150にリサイズし、プレビューに表示
        Resize(index, 150, 150);

    }, false);

}

//--------------------------------------------------------------------------
//  色選択用のドロップリスト変更時、プレビューを表示
//--------------------------------------------------------------------------
const texture_color = document.getElementsByClassName('color');
for (let index = 0; index < texture_color.length; ++index) {

    texture_color[index].addEventListener('change', () => {

        if (DropListIsNone(texture_color[index].id)) {

            //
            //  選択なし
            //

            //画像プレビューを未選択に初期化
            ImagePreviewClear(index);

            //3Dオブジェクトの対応面を初期化
            ImageOneReset(index);

        } else {

            //
            //  選択あり
            //

            //アップロードされているファイルをクリア
            CrearFile(index);

            //色画像の相対パスを取得
            let path = GetColorImagePath(texture_color[index].id);

            //画像のプレビューを表示
            document.getElementById('preview' + index).src = path;

            //対応する面のテクスチャを変更
            UpdateTexture_C(index, path);

        }

    }, false);

}

//--------------------------------------------------------------------------
//	画像を初期化
//--------------------------------------------------------------------------
document.getElementById('resetBtn').addEventListener('click', () => {

    const files = document.getElementsByClassName('Userimg');
    for (let index = 0; index < 6; ++index) {

        //選択ファイルをクリア
        if (files[index].files != null) {

            //アップロードされた画像をクリア
            files[index].value = '';

        }

        //色選択のドロップリストを初期化
        DropListClear('DropColor' + index);

        //プレビュー画像を初期化
        ImagePreviewClear(index);

    }

    //3Dオブジェクトの画像を初期化
    textureReset();

}, false);

//--------------------------------------------------------------------------
//	指定サイズに応じてオブジェクトのサイズを変更
//--------------------------------------------------------------------------
const usersize = document.getElementsByClassName('Size_selection_inner');
for (let index = 0; index < usersize.length; ++index) {

    usersize[index].addEventListener('change', () => {

        const length = GetLength();
        const width = GetWidth();
        const depth = GetDepth();

        UpdateSize(length, width, depth);

    }, false);
}

//--------------------------------------------------------------------------
//  形状テンプレートの色選択ボタンを動的に生成
//--------------------------------------------------------------------------
const color = {
    tab1: [1, 2, 3],
    tab2: [2, 3, 4],
    tab3: [3, 4, 5],
    tab4: [3, 4, 5],
    tab5: [3, 4, 5],
    tab6: [3, 4, 5],
    tab7: [3, 4, 5],
    tab8: [3, 4, 5],
    tab9: [3, 4, 5],
    tab10: [3, 4, 5],
    tab11: [3, 4, 5],
    tab12: [3, 4, 5]
}
const objcolor = document.getElementsByName('TemplateSelect');
for (let index = 0; index < objcolor.length; ++index) {

    objcolor[index].addEventListener('load', () => {

        CreateColorTag(color[index]);

    }, false);

}