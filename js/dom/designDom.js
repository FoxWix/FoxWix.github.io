/*-------------------------------------------------------------------------

    デザイン画面・プレビュー画面用のユーティリティDOM関数群
    
-------------------------------------------------------------------------*/


//-------------------------------------------------------------------------
//  長さを返却
//-------------------------------------------------------------------------
function GetLength() {

    return parseInt(document.getElementById('length').value);

}

//-------------------------------------------------------------------------
//  幅を返却
//-------------------------------------------------------------------------
function GetWidth() {

    return parseInt(document.getElementById('width').value);

}

//-------------------------------------------------------------------------
//  深さを返却
//-------------------------------------------------------------------------
function GetDepth() {

    return parseInt(document.getElementById('depth').value);

}

//-------------------------------------------------------------------------
//  長さ・幅・深さを返却
//-------------------------------------------------------------------------
function GetSize() {

    const l = parseInt(document.getElementById('length').value);
    const w = parseInt(document.getElementById('width').value);
    const d = parseInt(document.getElementById('depth').value);

    let size = {
        length: l,
        width: w,
        depth: d
    };

    return size;
}

//-------------------------------------------------------------------------
//  引数のオフセットを返却
//-------------------------------------------------------------------------
function GetOffsetSize(tag) {

    let wrapper = document.getElementById(tag);

    let offsetsize = {
        width: wrapper.offsetWidth,
        height: wrapper.offsetHeight
    };

    return offsetsize;
}

//-------------------------------------------------------------------------
//  引数の場所と値で子要素を作成
//-------------------------------------------------------------------------
function AppendPreview(face_id, tag) {

    const preview = document.getElementById('preview' + face_id);

    if (preview.firstChild) {

        preview.removeChild(preview.firstChild);

    }
    preview.appendChild(tag);
}

//-------------------------------------------------------------------------
//  引数のタグの子要素を削除
//-------------------------------------------------------------------------
function RemoveChildTag(tag) {

    let parent = document.getElementById(tag);

    parent.removeChild(parent.firstChild);

}

//-------------------------------------------------------------------------
//  選択されているファイルを返却
//-------------------------------------------------------------------------
function GetImage(face_id) {

    let temp = document.getElementsByClassName('Userimg');

    return temp[face_id].files[0];

}

//-------------------------------------------------------------------------
//  指定したファイルをクリア
//-------------------------------------------------------------------------
function CrearFile(face_id) {

    let face = document.getElementsByClassName('Userimg');

    face[face_id].files[0] = '';

}

//-------------------------------------------------------------------------
//  引数で指定されたドロップリストが選択されていない場合は true 
//  選択されている場合は false
//-------------------------------------------------------------------------
function DropListIsNone(tag) {

    let selectvalue = document.getElementById(tag).value;

    if (selectvalue == 'none') {
        return true;
    } else {
        return false;
    }

}

//-------------------------------------------------------------------------
//  引数ので指定されたドロップリストの選択された値に応じて画像のパスを返却
//-------------------------------------------------------------------------
function GetColorImagePath(tag) {

    //選択された色を取得
    let selectvalue = document.getElementById(tag).value;

    let path = '';
    if (selectvalue == 'blue') {

        path = '../images/PreviewInitImages/Box-5.jpg';

    } else if (selectvalue == 'yellow') {

        path = '../images/PreviewInitImages/Box-6.jpg';

    } else if (selectvalue == 'red') {

        path = '../images/PreviewInitImages/Box-4.jpg';

    } else if (selectvalue == 'green') {

        path = '../images/PreviewInitImages/Box-3.jpg';

    }

    return path;

}

//-------------------------------------------------------------------------
//　タグで指定されたドロップリストを未選択に設定する
//-------------------------------------------------------------------------
function DropListClear(tag) {

    document.getElementById(tag).options[0].selected = true;

}

//-------------------------------------------------------------------------
//  タグで指定された画像に未選択画像を設定
//-------------------------------------------------------------------------
function ImagePreviewClear(face_id) {

    document.getElementById('preview' + face_id).src = '../../images/PreviewInitImages/none' + (face_id + 1) + '.png';

}

//--------------------------------------------------------------------------
//  形状テンプレートの色選択ボタンを生成
//--------------------------------------------------------------------------
function CreateColorTag(color) {

    //親要素取得
    let parent = document.getElementsByClassName('Color_selection_inner');

    //子要素をすべて削除
    while (parent[0].lastChild) {
        parent[0].removeChild(parent[0].firstChild);
    }

    for (let index = 0; index < color.length; ++index) {
        
        let radio = document.createElement('input');
        let label = document.createElement('label');

        radio.setAttribute('type', 'radio');
        radio.setAttribute('name', 'ColorSelect');
        radio.setAttribute('value', 'color0' + color[index]);
        radio.setAttribute('id', 'ColorSelect0' + color[index]);
        
        label.setAttribute('for', 'ColorSelect0' + color[index]);
        label.setAttribute('class', 'Color_label');
        
        parent[0].appendChild(radio);
        parent[0].appendChild(label);

    }

}