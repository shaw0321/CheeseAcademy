<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$bookname = $_POST['bookname'];
$bookURL = $_POST['bookURL'];
$bookComment = $_POST['bookComment'];
// $test = "testtest";

// echo $bookname ;
// echo $bookURL ;
// echo $bookComment ; 
// echo "test" ; 
// echo $test ; 






// // 2. DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

// DBに接続する
try{
    $pdo = new PDO('mysql:dbname=PHP02_kadai;charset=utf8;host=localhost','root','root');
} catch (PDOException $e){
    exit('DBConnectError:'.$e->getMessage());
}



// // ３．SQL文を用意(データ登録：INSERT)
// $stmt = $pdo->prepare(
//   "INSERT INTO gs_an_table(id,name,email,naiyou,indate)
//   VALUES(NULL, :name, :email,:naiyou, sysdate())"
// );

// SQL文を用意
$stmt = $pdo->prepare(
    "INSERT INTO bookmark(bookId,bookname,bookURL,bookComment,registerDate)
    VALUES(NULL, :bookname, :bookURL, :bookComment, sysdate())"
);




// 4. バインド変数を用意
$stmt->bindValue(':bookname', $bookname , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookURL', $bookURL, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookComment', $bookComment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)



// 5. 実行
$status = $stmt->execute();



// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: http://localhost/PHP02_kadai/index.html');
}


?>
