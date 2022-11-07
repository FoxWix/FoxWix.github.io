document.getElementById('submit').addEventListener('click', () => {

    //セッションストレージにテクスチャを保存
    sessionStorage.setItem('texture', getTextures());

    //POSTデータ格納用変数
    let data = {};

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
        data = {

            //注文内容判別
            type: 'C_order',
            //長さ
            length: size['length'],
            //幅
            width: size['width'],
            //深さ
            depth: size['depth'],
            //厚み
            thickness: thicknessvalue,
            //数量
            quantity: quan

        }

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

        data = {

            //注文内容判定
            type: 'T_order',
            //選択形状
            tmpId: selectvalue,
            //指定色
            color: color,
            //厚み
            thickness: thicknessvalue,
            //数量
            quantity: quan

        }

    }

    //POSTデータを送信
    $.ajax({

        type: 'POST',
        url: '../order.html',
        data: data,
        dataType: 'json'

    });

    //確認ページへ移動
    location.href = '../order.html';

}, false);