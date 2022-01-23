<?php 

// POSTデータを受領 unsername とPWを変数に格納

$username = $_POST['username'];
$password = $_POST['password'];



// DBに接続
// DBに接続する
try{
    $pdo = new PDO('mysql:dbname=SankeyDiagram;charset=utf8;host=localhost','root','root');
} catch (PDOException $e){
    exit('DBConnectError:'.$e->getMessage());
}


// SQL文を記述
$stmt = $pdo->prepare(
    "INSERT INTO users(id,username, password)
    VALUES(NULL, :username, :password )"
);


// バインド変数の記述
$stmt->bindValue(':username', $username , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 登録を実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
  }else{
    //５．index.phpへリダイレクト
    header('Location: file:///Users/ikebeshaw/Documents/%E7%A4%BE%E4%BC%9A%E4%BA%BA/MIL/code/CheeseAcademy/phptest/createDiagram.html');
  }
  



?>