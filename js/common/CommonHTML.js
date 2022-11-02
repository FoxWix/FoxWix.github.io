//
//  長さを返却
//
function GetLength(){

    return parseInt(document.getElementById('length').value);

}

//
//  幅を返却
//
function GetWidth(){

    return parseInt(document.getElementById('width').value);

}

//
//  深さを返却
//
function GetDepth(){

    return parseInt(document.getElementById('depth').value);

}

//
//  長さ・幅・深さを返却
//
function GetSize(){

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

//
//  引数のオフセットを返却
//
function GetOffsetSize( tag ){

    let wrapper = document.getElementById(tag);
    
    let offsetsize = {
        width: wrapper.offsetWidth,
        height: wrapper.offsetHeight
    } ;

    return offsetsize;
}

//
//  引数の場所と値で子要素を作成
//
function AppendPreview( face_id, tag ){

    const preview = document.getElementById('preview' + face_id);

    if (  preview.firstChild  ) {
  
      preview.removeChild(preview.firstChild);
  
    }
    preview.appendChild(tag);
}

//
//  選択されているファイルを返却
//
function GetImage(face_id){

    return document.querySelectorAll('#face')[face_id].files[0];

}