<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
loginCheck();


// DBに接続
$pdo = db_conn() ;

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table ");
$status = $stmt->execute();


//３．データ表示
$userlist = "";
$kengen =array("0" => "一般", "1" =>"管理者");
$state = array("0" => "利用中", "1" =>"停止");


if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

      if($result["life_flg"] == 0){
        $userlist .= '<tr><td>';
        $userlist .= $result["id"];
        $userlist .= '</td><td>';
        $userlist .= $result["name"];
        $userlist .= '</td><td>';
        $userlist .= $result["lid"];
        $userlist .= '</td><td>';
        $userlist .= $kengen[$result["kanri_flg"]];
        $userlist .= '</td><td>';
        $userlist .= $state[$result["life_flg"]];
        $userlist .= '</td><td><button class="btn btn-sm btn-outline-primary ">変更</button><form class="form-signin" action="user_delete.php" method="post"><input type="hidden" name="id" value="';
        $userlist .= $result["id"];
        $userlist .= '"><button  class="btn btn-sm btn-outline-danger">削除</button></form></td></tr>';

      }else{
        $userlist .= '<tr><td>';
        $userlist .= $result["id"];
        $userlist .= '</td><td>';
        $userlist .= $result["name"];
        $userlist .= '</td><td>';
        $userlist .= $result["lid"];
        $userlist .= '</td><td>';
        $userlist .= $kengen[$result["kanri_flg"]];
        $userlist .= '</td><td>';
        $userlist .= $state[$result["life_flg"]];
        $userlist .= '</td><td><button class="btn btn-sm btn-outline-primary ">変更</button><form class="form-signin" action="user_revival.php" method="post"><input type="hidden" name="id" value="';
        $userlist .= $result["id"];
        $userlist .= '"><button  class="btn btn-sm btn-outline-success">復活</button></form></td></tr>';

      }
    }
}

// $bookObject .= '<form class="form-signin" action="user_delete.php" method="post"><input type="hidden" name="id" value="';
// $bookObject .= $result["id"] ;
// $bookObject .= '"><button  class="btn btn-sm btn-outline-danger">削除</button></form>


// <tbody><tr><td>
// $result["id"]
// </td><td>
// $result["name"]
// </td><td>
// $result["lid"]
// </td><td>
// $kengen[$result["kanri_flg"]]
// </td><td>
// $state[$result["life_flg"]]
// </td><td><button class="btn btn-sm btn-outline-primary ">変更</button><button class="btn btn-sm btn-outline-danger">削除</button></td></tr></tbody>


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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template · Bootstrap v4.6</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



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
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <header>
<!-- <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav> -->
    <!-- ナビゲーション -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
      <a class="navbar-brand" href="./">Book Logger</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto " id="navAppend">
          <li class="nav-item active">
            <a class="nav-link" href="favlist.php">お気に入り一覧</a>
          </li>
          <?= $adminNav ?>
          <li class="nav-item active ">
              <a class="nav-link " href="logout.php">ログアウト</a>
          </li>
        </ul>

      </div>
    </nav>
    <!-- ナビゲーション終了-->

  </header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              users
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li> -->
        </ul>

        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul> -->
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">ユーザー登録</h1>
        <!-- <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div> -->
      </div>
      
      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
      <!-- ユーザー登録に関する記述、lid,lpw,lpw確認、管理フラグの登録 -->
      <div class="col ">
        <form class="form-signin" action="user_create.php" method="post">
          <div class="form-group row">
            <label for="signinUsername" class="col-sm-2 col-form-label">ユーザー名</label>
            <input type="text" id="signinUsername" class="form-control col-sm-8" placeholder="ユーザー名" name="name" >
          </div>
          <div class="form-group row">
            <label for="signinUsername" class="col-sm-2 col-form-label">ユーザーID</label>
            <input type="text" id="signinUsername" class="form-control col-sm-8" placeholder="ユーザーID" name="lid">

          </div>
          <div class="form-group row">
            <label for="signinPassword" class="col-sm-2 col-form-label">Password</label>
            <input type="text" id="signinPassword" class="form-control col-sm-8" placeholder="パスワード" name="lpw" >

          </div>
          <div class="form-group row">
            <label for="signinPasswordComfirm" class="col-sm-2 col-form-label">Password確認</label>
            <input type="text" id="signinPasswordComfirm" class="form-control col-sm-8" placeholder="パスワード確認" name="lpw_confirm">

          </div>
          <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">ユーザー権限</label>
            <select class="form-control col-sm-8" id="exampleFormControlSelect1" name="kanri_flg">
              <option value="1">管理者</option>
              <option value="0">一般</option>
            </select>

          </div>
        

          <div class="d-flex">
          <button class="btn btn-lg btn-primary ml-auto" type="submit" id="signinbtn">登録</button>

          </div>
          </form>
    </div>


      <h2>ユーザー一覧</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>ユーザー名</th>
              <th>ログインID</th>
              <th>権限</th>
              <th>ステータス</th>
              <th>処理</th>

            </tr>
          </thead>
          <tbody>
            <!-- <tr>
              <td>1,001</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>text</td>
              <td><button class="btn btn-sm btn-outline-primary ">変更</button><button class="btn btn-sm btn-outline-danger">削除</button></td>

            </tr> -->

            <?= $userlist ?>

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="js/dashboard.js"></script>
  </body>
</html>
