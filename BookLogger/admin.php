<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
loginCheck();



// 管理者の場合管理者ページへのリンクを表示する
$adminNav = "";
if ($_SESSION['kanri_flg'] == 1) {
  $adminNav .= '"<li class="nav-item active"><a class="nav-link" href="admin.php">管理者ページ</a></li>"';
} 
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>検索画面</title>

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
      <a class="navbar-brand" href="./">Book Logger</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto" id="navAppend">
          <li class="nav-item active">
            <a class="nav-link" href="favlist.php">お気に入り一覧</a>
          </li>
          <?= $adminNav ?>
          <li class="nav-item active">
              <a class="nav-link" href="logout.php">ログアウト</a>
          </li>
        </ul>

      </div>
    </nav>
    <!-- ナビゲーション終了-->

  </header>

  <main role="main">
    <!-- ジャンボとろん -->
    <section class="jumbotron text-center">
      <div class="container">
        <h1>管理者ページ</h1>
        <p class="lead text-muted">
          ユーザー管理を行いましょう
        </p>


      </div>
    </section>
    <!-- ジャンボとろん終了 -->

    <!-- アルバム -->
    <div class="album py-5 bg-light">

    </div>
    <!-- アルバム終了 -->


 
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
