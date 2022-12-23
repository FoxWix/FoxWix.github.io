window.addEventListener('load', () => {

    if(sessionStorage.getItem('type') == null){
        location.href = '../../index.php';
    }

    //セッションストレージから注文内容を取得
    const type = sessionStorage.getItem('type');
    const length = sessionStorage.getItem('length');
    const width = sessionStorage.getItem('width');
    const depth = sessionStorage.getItem('depth');
    const thickness = sessionStorage.getItem('thickness');
    const colorcode = sessionStorage.getItem('color');
    const tmpId = sessionStorage.getItem('tmpId');
    const quantity = sessionStorage.getItem('quantity');
    let color;
    let price;

    switch(colorcode){
        case "#a9a9a9":
            color = "ダークグレー";
            break;
        case "#ff4500":
            color = "オレンジレッド";
            break;
        case "#ffd700":
            color = "ゴールド";
            break;
        case "#66cdaa":
            color = "ミディアムカーマイン";
            break;
        case "#4169e1":
            color = "ロイヤルブルー";
            break;
        case "#9932cc":
            color = "ダークオーキッド";
            break;
    }

    //注文内容を設定
    if (type == 'C_order') {

        //価格を設定
        let total = Number(length) + Number(width) + Number(depth);
        if(total <= 600){
            price = 1000;
        }
        else if(total <= 800 && total > 600){
            price = 2000;
        }
        else if(total <= 1000 && total > 800){
            price = 10000;
        }
        else if(total <= 1200 && total > 1000){
            price = 12000;
        }
        else if(total <= 1400 && total > 1200){
            price = 13000;
        }
        else{
            price = 14000;
        }
        
        document.getElementById('price').innerHTML = price + "<span> 円</span>";
        document.getElementById('total').innerHTML = (price*quantity) + "<span> 円</span>";
        document.getElementById('with-tax').innerHTML = Math.floor(price*quantity*1.1) + '<span class="total-last-span"> 円</span>';

        //　値段設定
        document.getElementById('f_price').value = price;

        document.getElementById('ordertype').innerHTML = 'お客様プリント';
        document.getElementById('sl').innerHTML = length + "<span> mm</span>";
        document.getElementById('sw').innerHTML = width + "<span> mm</span>";
        document.getElementById('sd').innerHTML = depth + "<span> mm</span>";
        document.getElementById('sth').innerHTML = thickness + "<span> mm</span>";
        document.getElementById('sq').innerHTML = quantity + "<span> 枚</span>";

        //お客様プリントプレビュー表示
        document.getElementById("cp").style.display = 'block';
        document.getElementById("tp").style.display = 'none';

        //テクスチャを一枚の画像に連結
        let data = document.getElementById('img_src');
        let type = document.getElementById('img_type');
        let name = document.getElementById('img_name');
        let errorflg = texturesConnection(data, type, name);
        if (!errorflg) {

            alert('エラーが発生しました');

            sessionStorage.clear();

            location.href = '../../index.php';

        }


    } else if (type == 'T_order') {

        //テンプレートデータ取得
        fetch('../../php/get_tmpdata.php',{
            method:'POST',
            headers:{'Content-Type':'text/plain'},
            body: tmpId
        })
        .then(response => response.text())
        .then(res => {
            let tmpdata = res.split(',');
            document.getElementById('sl').innerHTML = tmpdata[0] + "<span> mm</span>";
            document.getElementById('sw').innerHTML = tmpdata[1] + "<span> mm</span>";
            document.getElementById('sd').innerHTML = tmpdata[2] + "<span> mm</span>";
            document.getElementById('ordertype').innerHTML = tmpdata[4] + " " +color;

            let price = tmpdata[3];
            document.getElementById('price').innerHTML = price + "<span> 円</span>";
            document.getElementById('total').innerHTML = (price*quantity) + "<span> 円</span>";
            document.getElementById('with-tax').innerHTML = Math.floor(price*quantity*1.1) + '<span class="total-last-span"> 円</span>';

            // form に設定
            document.getElementById('length').value = tmpdata[0];
            document.getElementById('width').value = tmpdata[1];
            document.getElementById('depth').value = tmpdata[2];
            document.getElementById('f_price').value = price;
        })

        //デザインテンプレートプレビュー表示
        document.getElementById("cp").style.display = 'none';
        document.getElementById("tp").style.display = 'block';
        
        //選択された画像をプレビューへ表示
        let path='';
        for (let f = 0; f < Template.length; ++f){

            for (let i = 0; i < 3; ++i){

                if (tmpId == Template[f][i].fullname) {
                    
                    path = Template[f][i].path;

                }

            }
            if (path != '') break;

        }
        document.getElementById('tmpImage').src = path;
        
        document.getElementById('sth').innerHTML = thickness + "<span> mm</span>";
        document.getElementById('sq').innerHTML = quantity + "<span> 枚</span>";

        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        const offset = GetOffsetSize('wrapper');
        canvas.width = offset['width'];
        canvas.height = offset['height']

        const preview = new Image();
        preview.src = '../../images/Box-1.jpg';

        preview.onload = () => {

            ctx.drawImage(preview, 0, 0);

        };

    }

    //formに設定
    document.getElementById('type').value = type == '' ? '' : type;

    if (type == 'C_order') {
        document.getElementById('length').value = length != null ? length : '';
        document.getElementById('width').value = width != null ? width : '';
        document.getElementById('depth').value = depth != null ? depth : '';
    }

    document.getElementById('tmpId').value = tmpId != null ? tmpId : '';
    document.getElementById('color').value = colorcode != null ? colorcode : '';
    document.getElementById('thickness').value = thickness;
    document.getElementById('quantity').value = quantity;

    //セッションストレージをクリア
    sessionStorage.clear();

}, false);
