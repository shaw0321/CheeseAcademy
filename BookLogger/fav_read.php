<?php

require_once('funcs.php');
$pdo = db_conn() ;

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_db_bookfavlist");
$status = $stmt->execute();


?>
