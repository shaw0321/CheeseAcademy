<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$id = $_POST["id"];
$favFlag = "0";


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn() ;

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare(
    "UPDATE gs_db_bookfavlist SET updateDate = sysdate(), favFlag= :favFlag WHERE id = :id"
  );

$stmt->bindValue(':favFlag', $favFlag, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

  

//４．データ登録処理後
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    sql_error($stmt);
  }else{
    redirect('favlist.php');
  }
?>