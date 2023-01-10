//*******************************************************************************
//  価格確認ボタンクリック時の処理
//*******************************************************************************
document.getElementById('submit').addEventListener('click', async () => {

    //厚みを取得
    let radio = document.getElementsByName('ThicknessSelect');
    let thic = -1;
    for (let i = 0; i < radio.length; ++i) {

        if (radio[i].checked) {

            if (i == 0) {

                thic = 3;

            }
            else if (i == 1) {

                thic = 5;

            }
            else if (i == 2) {

                thic = 8;

            }

        }

        if (thic > -1) break;

    }

    //数量を取得
    const quan = Math.floor(parseInt(document.getElementById('quantity').value));
    if (Check_e(quan)) {

        alert('数量は最大10個までです');

        return;

    }
    if (quan < 1 || quan == null) {

        alert('数量が選択されていません。');

        return;

    }
    if (quan > 10) {

        alert('数量は最大10個までです。');

        return;

    }


    if (document.getElementById('SW1').style.display != 'none') {

        //
        //  お客様プリント
        //

        //デザインされていない場合は実行終了
        for (let index = 0; index < 6; ++index) {

            if (document.getElementById('SW1').style.display != 'none') {

                if (GetImage(index) == null && DropListIsNone('DropColor' + index)) {

                    alert('注文には、すべての面がデザインされている必要があります。');

                    return;

                }

            }

        }

        //指定サイズの範囲確認
        const len = GetLength();
        const wid = GetWidth();
        const dep = GetDepth();
        let errroMessage = '長さは100mm～500mmの範囲で選択可能です';
        if (Check_e(len) || Check_e(wid) || Check_e(dep)) {

            alert(errroMessage);

            return;

        }
        if (len < 100 || len > 500) {

            alert(errroMessage);

            return;

        }
        if (wid < 100 || wid > 500) {

            alert(errroMessage);

            return;

        }
        if (dep < 100 || dep > 500) {

            alert(errroMessage);

            return;

        }

        //セッションストレージにデザイン内容を格納
        sessionStorage.clear();
        sessionStorage.setItem('type', 'C_order');
        sessionStorage.setItem('length', len);
        sessionStorage.setItem('width', wid);
        sessionStorage.setItem('depth', dep);
        sessionStorage.setItem('thickness', thic);
        sessionStorage.setItem('quantity', quan);

        //3Dオブジェクトのテクスチャを取得し、セッションストレージに格納
        let tex = getTextures();
        for (let j = 0; j < 6; ++j) {

            sessionStorage.setItem('texture' + j, tex[j].map.image.src);

        }

    } else {

        //
        //  デザインテンプレート
        //

        //選択形状取得
        let rb = document.getElementsByName('TemplateSelect');
        let selecttemp;
        for (let f = 0; f < rb.length; ++f) {

            if (rb[f].checked) {

                selecttemp = f;

            }

        }
        if (typeof selecttemp === 'undefined') {
            
            alert("商品が選択されていません");

            return;
            
        }
        const tempName = Template[Math.floor(selecttemp / 3)][Math.floor(selecttemp % 3)].fullname;

        //選択色取得
        let c = document.getElementsByName('ColorSelect');
        let selectcolor;
        for (let k = 0; k < c.length; ++k) {

            if (c[k].checked) {

                selectcolor = Color.ColorCode[c[k].value];

            }

        }
        if (typeof selectcolor ===  'undefined') {
             
            alert("色が選択されていません");

            return;
            
        }

        //セッションストレージに注文内容を保存
        sessionStorage.clear();
        sessionStorage.setItem('type', 'T_order');
        sessionStorage.setItem('tmpId', tempName);
        sessionStorage.setItem('color', selectcolor);
        sessionStorage.setItem('thickness', thic);
        sessionStorage.setItem('quantity', quan);

    }

    //確認ページへ移動
    location.href = 'order.php';

}, false);

//----------------------------------------------------------------------
//  NaNチェック関数
//----------------------------------------------------------------------
function Check_e(target) {

    return target.toString().indexOf('NaN') > -1 ? true : false;

}
