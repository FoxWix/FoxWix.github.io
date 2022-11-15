# FoxWix.github.io

22/11/04
[register.html]
41  <!-- <form action="user_register.php" method="POST"> 処理追加 -->
278 <!-- </form> 処理追加 -->

80  <!-- <form> を <div> に変更 -->
134 <!-- </form> を </div> に変更 -->

273 <!-- <form action="" method=""> 削除 -->
275 <!-- </form> 削除 -->

[workDB_MF.php]
319 ~ 484   処理追加

[workDB_MF.ini]
自分の環境に合わせていじりました

パスの修正


22/11/06
[style-php_error.css]
エラーメッセージ関係で追加
[style-register.css]
144 /* エラーメッセージ挿入で * の位置がずれるためコメントアウト

ファイル名変更
[php/login.php] > [php/user_login.php]
[login.html] > [login.php]
[register.html] > [register.php]

22/11/10
[js/event/designOrder.js]
色々変更
[order.html]
152~ id追加
[cart.html] > [cart.php]
76 //カートデータをリスト表示
237 //カート内データ削除処理追加
[php/cart_add.php]
[php/cart_remove.php]
追加

22/11/14 [cart.html] 削除

22/11/15
注文処理追加
html を php に変更
ユーザーセッション情報を追加
[order.php] ユーザー情報反映