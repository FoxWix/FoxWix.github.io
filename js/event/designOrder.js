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

    document.getElementById('ordertype').innerHTML = type +" "+ color +" "+ tmpId;
    
    document.getElementById('sl').innerHTML = length + "<span> mm</span>";
    document.getElementById('sw').innerHTML = width + "<span> mm</span>";
    document.getElementById('sd').innerHTML = depth + "<span> mm</span>";
    document.getElementById('sth').innerHTML = thickness + "<span> mm</span>";
    document.getElementById('sq').innerHTML = quantity + "<span> 枚</span>";

    document.getElementById('price').innerHTML = depth + "<span> 円</span>";
    document.getElementById('total').innerHTML = depth + "<span> 円</span>";
    document.getElementById('with-tax').innerHTML = depth + '<span class="total-last-span"> 円</span>';

    //formに設定
    if(type == "")
        document.getElementById('type').value = type;
    else
        document.getElementById('type').value = type;
    document.getElementById('length').value = length != null ? length : '';
    document.getElementById('width').value = width != null ? width : '';
    document.getElementById('depth').value = depth != null ? depth : '';
    document.getElementById('tmpId').value = tmpId != null ? tmpId : '';
    document.getElementById('color').value = color != null ? color : '';
    document.getElementById('thickness').value = thickness;
    document.getElementById('quantity').value = quantity;

    console.log(type);
    console.log(length);
    console.log(width);
    console.log(depth);
    console.log(type);



}, false);