
const tmpColor1 = [3, 4];
const tmpColor2 = [2, 3, 4];
const tmpColor3 = [2, 3, 4, 5];
const tmpColor4 = [2, 3, 4, 6];
const tmpColor5 = [2, 3, 4, 5, 6];
const tmpColor6 = [2, 3, 4];
const tmpColor7 = [2, 3, 4];
const tmpColor8 = [2, 3, 4];
const tmpColor9 = [2, 3, 4];
const tmpColor10 = [2, 3, 4];
const tmpColor11 = [2, 3, 4];
const tmpColor12 = [2, 3, 4];


function ChangeShowColor( tmpNo ){
    
    //親要素取得
    let parent = document.getElementsByClassName('Color_selection_inner');

    //子要素をすべて削除
    while( parent[0].lastChild ){
        parent[0].removeChild(parent[0].firstChild);
    }

    //選択なしボタンを生成
    let radio = document.createElement('input');
    let label = document.createElement('label');
    radio.setAttribute('type', 'radio');
    radio.setAttribute('name', 'ColorSelect');
    radio.setAttribute('value', 'color01');
    radio.setAttribute('id', 'ColorSelect01');
    radio.setAttribute('checked', 'true');
    label.setAttribute('for', 'ColorSelect01');
    label.setAttribute('class', 'Color_label');    
    parent[0].appendChild(radio);
    parent[0].appendChild(label);

    if( tmpNo == 1 ){

        CreateTag( tmpColor1, parent[0] );

    } else if ( tmpNo == 2 ){

        CreateTag( tmpColor2, parent[0] );

    } else if ( tmpNo == 3 ){

        CreateTag( tmpColor3, parent[0] );
        
    } else if ( tmpNo == 4 ){

        CreateTag( tmpColor4, parent[0] );
        
    } else if ( tmpNo == 5 ){

        CreateTag( tmpColor5, parent[0] );
        
    } else if ( tmpNo == 6 ){

        CreateTag( tmpColor6, parent[0] );
        
    } else if ( tmpNo == 7 ){

        CreateTag( tmpColor7, parent[0] );
        
    } else if ( tmpNo == 8 ){

        CreateTag( tmpColor8, parent[0] );
        
    } else if ( tmpNo == 9 ){

        CreateTag( tmpColor9, parent[0] );
        
    } else if ( tmpNo == 10 ){

        CreateTag( tmpColor10, parent[0] );
        
    } else if ( tmpNo == 11 ){

        CreateTag( tmpColor11, parent[0] );
        
    } else if ( tmpNo == 12 ){

        CreateTag( tmpColor12, parent[0] );
        
    }

}

function CreateTag( color, parent ){

    for(let index=0; index<color.length; ++index){

        let radio = document.createElement('input');
        let label = document.createElement('label');

        radio.setAttribute('type', 'radio');
        radio.setAttribute('name', 'ColorSelect');
        radio.setAttribute('value', 'color0' + color[index]);
        radio.setAttribute('id', 'ColorSelect0' + color[index]);

        label.setAttribute('for', 'ColorSelect0' + color[index]);
        label.setAttribute('class', 'Color_label');

        parent.appendChild(radio);
        parent.appendChild(label);

    }

}