<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw  = $_POST["lpw"];
$lpw_confirm  = $_POST["lpw_confirm"];
$kanri_flg = $_POST["kanri_flg"];

$lpw = password_hash($lpw,PASSWORD_DEFAULT);


//2. DB接続します
//以下を関数化！
require_once('funcs.php');
$pdo = db_conn() ;


//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_user_table ( id, name, lid,lpw ,kanri_flg, life_flg)
  VALUES( NULL, :name,:lid, :lpw, :kanri_flg,0 )"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）

    $error = $stmt->errorInfo();
    sql_error($stmt);
  }else{
    //５．index.phpへリダイレクト
    redirect('admin2.php');
  }