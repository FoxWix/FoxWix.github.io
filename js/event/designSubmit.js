document.getElementById('submit').addEventListener('click', () => {

    //テクスチャを一枚の画像に連結
    let flg = texturesConnection();

    if (flg != null) return;

    //厚みを取得
    let radio = document.getElementsByName('ThicknessSelect');
    let thicknessvalue = '';
    for (let i = 0; i < radio.length; ++i) {

        if (radio[i].checked) {

            thicknessvalue = i;

        }

    }

    //数量を取得
    let quan = parseInt(document.getElementById('quantity').value);
    if (quan < 1 || quan == null) {

        alert('数量が選択されていません。');

        return;

    }
    if (quan > 10) {

        alert('数量は最大10個までです。');

        return;

    }


    //POSTデータを作成
    if (document.getElementById('SW1').style.display != 'none') {

        //お客様プリント

        let size = GetSize();
        sessionStorage.clear();
        sessionStorage.setItem('type', 'C_order');
        sessionStorage.setItem('length', size['length']);
        sessionStorage.setItem('width', size['width']);
        sessionStorage.setItem('depth', size['depth']);
        sessionStorage.setItem('thickness', thicknessvalue);
        sessionStorage.setItem('quantity', quan);

    } else {


        //デザインテンプレート

        //選択形状取得
        let rb = document.getElementsByName('TemplateSelect');
        let selectvalue = '';
        for (let f = 0; f < rb.length; ++f) {

            if (rb[f].checked) {

                selectvalue = f;

            }

        }

        //選択色取得
        let c = document.getElementsByName('ColorSelect');
        let color = '';
        for (let k = 0; k < c.length; ++k) {
            if (c[k].checked) {
                color = 'color' + k;
            }
        }

        //セッションストレージに注文内容を保存
        sessionStorage.clear();
        sessionStorage.setItem('type', 'T_order');
        sessionStorage.setItem('tmpId', selectvalue);
        sessionStorage.setItem('color', color);
        sessionStorage.setItem('quantity', quan);
        const texture = getTextures();
        for (let i = 0; i < 6; ++i) {

            let idname = 'texture' + i;
            sessionStorage.setItem(idname, texture[i]);

        }

    }

    //確認ページへ移動
    location.href = '../../php/order_load.php';

}, false);