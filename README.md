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
[cart_add.php]
[user_login.php]
[user_register.php]
[order_cat.php]
[js/event/designSubmit.js]
画面遷移処理追加


22/11/18
注文処理
セッションからデータベースへ修正
[workDB_MF.php]
[order_registration.php]
[cart_remove.php]
[cart_add.php]
[cart.php]

22/11/22
注文処理
[workDB_MF.php]
[cart.php]
[cart_add.php]
[order_registration.php]

22/11/30
[order.php]フォームタグ編集
[designSubmit.js]NaNチェック追加
[designImage.js]画像データ（拡張子、画像名）をフォームに設定する処理を追加
[designOrder.js]

22/12/01
[cart.php] 画像処理追加
[cart_add.php] 画像処理追加 画像のパスを images/designTextures/ に変更
[order.php] form に id 追加

22/12/03
[index.php]
・サイトの最新版に合わせ、更新
[js/designEvent.js]
・テンプレートの配色選択処理の改修

22/12/04
[js/render.js]
・プレビューにナビゲーション機能を追加
・プレビューオブジェクトの初期テクスチャを変更
[js/designEvent.js]
・リセットボタンを押すとnone画像の位置が適切に表示されない問題を修正


22/12/08
phpファイルにログイン処理を追加
[register.php] テスト結果に合わせて修正
[cart.php] テスト結果に合わせて修正、個数更新機能追加、送料処理追加
[cart.update] 処理追加
[workDB_MF.php] 処理追加
[order.php]
[designOrder.js] 価格処理

22/12/09
[js/event/designSubmit.js]
・セッションストレージの内容を変更
  type -> お客様プリント/デザインテンプレート
  tmpId -> ユーザが選択したテンプレートの名前
  color -> ユーザが選択したテンプレートの配色(カラーコード)
  quantity -> 数量
[js/common/designCommon.js]
・デザインテンプレートのテンプレート名を格納

22/12/12
[js/object/render.js]
[js/event/designEvent.js]
[js/dom/designDom.js]
・プレビューのリセット機能を追加
・プレビューナビゲーションの表示／非表示機能を追加
・お客様プリントで色未選択ボタンを押したとき正しい未選択画像が表示されない問題を修正

22/12/13
[js/object/render.js]
[js/event/designEvent.js]
[js/common/designCommon.js]
・テンプレート注文の際のプレビュー機能を追加

22/12/16
[js/event/designSubmit.js]
デザインテンプレート注文で注文した際に厚みがセッションストレージに格納されていない問題を修正
