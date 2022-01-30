<?php
//【重要】
/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */
require_once('funcs.php');
$pdo = db_conn() ;

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_db_bookfavlist WHERE favFlag = 1");
$status = $stmt->execute();


//３．データ表示
$bookObject = "";
$bookDialog = "";

if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $bookObject .= '<div class="col-md-3"><div class="card mb-4 shadow-sm"><img src="';
        $bookObject .= $result["thumbnail"] ;
        $bookObject .= '"><div class="card-body"><p class="card-text">';
        $bookObject .= $result["bookName"] ;
        $bookObject .= '</p><div class="d-flex justify-content-between align-items-center"><div class="btn-group"><a href="';
        $bookObject .= $result["bookURL"] ;
        $bookObject .= '"><button type="button" class="btn btn-sm btn-outline-secondary" id="viewbtn" name=" ">URL</button></a><button type="button" class="btn btn-sm btn-outline-secondary" id="updatebtn" data-toggle="modal" data-target="#modal';
        $bookObject .= $result["id"] ;
        $bookObject .= '">編集</button></div><div class="btn-group"><form class="form-signin" action="fav_delete.php" method="post"><input type="hidden" name="id" value="';
        $bookObject .= $result["id"] ;
        $bookObject .= '"><button  class="btn btn-sm btn-outline-danger">削除</button></form></div></div></div></div></div>';

        $bookDialog .= '<div class="modal fade" id="modal';
        $bookDialog .= $result["id"];
        $bookDialog .= '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">お気に入り登録画面</h5>';
        $bookDialog .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><section class="container"> ';
        $bookDialog .= '<div class="row"><div class="col border-right"><form class="form-signin" action="fav_update.php" method="post"><img class="mb-4" src="';
        $bookDialog .= $result["thumbnail"];
        $bookDialog .= '" alt="" width=50% ><h1 class="h3 mb-3 font-weight-normal">';
        $bookDialog .= $result["bookName"];
        $bookDialog .= '</h1><label for="bookComment" class="sr-only">コメント</label><input type="text" id="bookComment" class="form-control" placeholder="コメント" name="bookComment" value="';
        $bookDialog .= $result["bookComment"];
        $bookDialog .= '" ><input type="hidden" name="id" value="';
        $bookDialog .= $result["id"];
        $bookDialog .= '"><button class="btn btn-lg btn-primary btn-block" >更新</button></form></div></div></section></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div></div></div></div>';

    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>お気に入り一覧</title>

    <!-- bootstrapの記述 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>

    <!-- Custom styles for this template -->
    <link href="./css/album.css" rel="stylesheet">
    <!-- <link href="./css/signin.css" rel="stylesheet"> -->
    <link href="./css/navbar.css" rel="stylesheet">

    <!-- Jqueryのインストール -->
    <script src="./js/jquery-2.1.3.min.js"></script>

  </head>

<body>  
  <header>
    <!-- ナビゲーション -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="./index.html">Book Logger</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto" id="navAppend">
          <li class="nav-item active">
            <a class="nav-link" href="favlist.php">お気に入り一覧</a>
          </li>
        </ul>

      </div>
    </nav>
    <!-- ナビゲーション終了-->

  </header>

  <main role="main">
    <!-- ジャンボとろん -->
    <!-- <section class="jumbotron text-center">
      <div class="container">
        <h1>Book Logger</h1>
        <p class="lead text-muted">
          気になる単語を入力して本を探そう
        </p> -->

        <!-- 検索ウィンドウと検索ボタン -->
   
          <!-- <div class="form-group">
            <label for="search"></label>
            <input type="text" name="search" id="search" class="form-control" placeholder="put in words" aria-describedby="helpId">
            <small id="helpId" class="text-muted">１単語のみ入力してください</small>
            <input type="submit" id="searchbtn" value="検索">
          </div>


      </div>
    </section> -->
    <!-- ジャンボとろん終了 -->

    <!-- アルバム -->
    <div class="album py-5 bg-light">
      <div class="container">
        <!-- <div class="row">
          自分のエリア
        </div> -->
        <!-- 自分のRow -->
        <div class="row row-scrollable" id="bookArea">
        <?= $bookObject ?>

        </div>
        
      </div>
    </div>
    <!-- アルバム終了 -->


    <!-- モーダルダイアログ -->
    <div class="container" id="dialogArea">
        <?= $bookDialog ?>
    </div>

    <!-- モーダルダイアログ終了 -->   
  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
      <p>New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
    </div>
  </footer>


</body>

<script type="module">

  //■ページを読み込んだときの処理を記載する


 
  // ■関数を記載する


  // ■ユーザーの操作に関する処理を記載する

    
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

