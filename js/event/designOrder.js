window.addEventListener('load', () => {

    //セッションストレージから注文内容を取得
    const type = sessionStorage.getItem('type');
    const length = sessionStorage.getItem('length');
    const width = sessionStorage.getItem('width');
    const depth = sessionStorage.getItem('depth');
    const thickness = sessionStorage.getItem('thickness');
    const color = sessionStorage.getItem('color');
    const tmpId = sessionStorage.getItem('tmpId');
    const quantity = sessionStorage.getItem('quantity');

    //注文内容を設定
    if (type == 'C_order') {

        document.getElementById('ordertype').innerHTML = 'お客様プリント';
        document.getElementById('sl').innerHTML = length + "<span> mm</span>";
        document.getElementById('sw').innerHTML = width + "<span> mm</span>";
        document.getElementById('sd').innerHTML = depth + "<span> mm</span>";
        document.getElementById('sth').innerHTML = thickness + "<span> mm</span>";
        document.getElementById('sq').innerHTML = quantity + "<span> 枚</span>";

        //テクスチャを一枚の画像に連結
        let form = document.getElementById('base64');
        texturesConnection(form);


    } else if ('T_order') {

        document.getElementById('ordertype').innerHTML = "形状テンプレート " + color + " " + tmpId;
        document.getElementById('sth').innerHTML = thickness + "<span> mm</span>";
        document.getElementById('sq').innerHTML = quantity + "<span> 枚</span>";

    }

    //価格を設定　＊価格要修正＊
    document.getElementById('price').innerHTML = depth + "<span> 円</span>";
    document.getElementById('total').innerHTML = depth + "<span> 円</span>";
    document.getElementById('with-tax').innerHTML = depth + '<span class="total-last-span"> 円</span>';

    //formに設定
    document.getElementById('type').value = type == '' ? '' : type;
    document.getElementById('length').value = length != null ? length : '';
    document.getElementById('width').value = width != null ? width : '';
    document.getElementById('depth').value = depth != null ? depth : '';
    document.getElementById('tmpId').value = tmpId != null ? tmpId : '';
    document.getElementById('color').value = color != null ? color : '';
    document.getElementById('thickness').value = thickness;
    document.getElementById('quantity').value = quantity;

    //セッションストレージをクリア
    sessionStorage.clear();

}, false);