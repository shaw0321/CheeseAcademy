<?php
//1. POSTデータ取得
$bookName   = $_POST["bookName"];
$bookURL  = $_POST["bookURL"];
$thumbnail = $_POST["thumbnail"];
$bookComment    = $_POST["bookComment"];
$favFlag = "1";

// $bookName   = "test";
// $bookURL  = "test";
// $thumbnail = "test";
// $bookComment  = "test";
// $favFlag = "1";


//2. DB接続します
//以下を関数化！
require_once('funcs.php');
$pdo = db_conn() ;


//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_db_bookfavlist ( id, bookName, bookURL,thumbnail ,bookComment, registerDate, updateDate , favFlag)
  VALUES( NULL, :bookName, :bookURL, :thumbnail,:bookComment, sysdate(),NULL, :favFlag )"
);

// 4. バインド変数を用意
$stmt->bindValue(':bookName', $bookName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookURL', $bookURL, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':thumbnail', $thumbnail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookComment', $bookComment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':favFlag', $favFlag, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）

    $error = $stmt->errorInfo();
    sql_error($stmt);
  }else{
    //５．index.phpへリダイレクト
    redirect('index.html');
  }