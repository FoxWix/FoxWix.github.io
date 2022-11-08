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

    //formに設定
    document.getElementById('type').value = type;
    document.getElementById('length').value = length != null ? length : '';
    document.getElementById('width').value = width != null ? width : '';
    document.getElementById('depth').value = depth != null ? depth : '';
    document.getElementById('tmpId').value = tmpId != null ? tmpId : '';
    document.getElementById('color').value = color != null ? color : '';
    document.getElementById('thickness').value = thickness;
    document.getElementById('quantity').value = quantity;

}, false);