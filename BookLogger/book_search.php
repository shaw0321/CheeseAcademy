<?php


function MakeUrl($Keyword) {
    $baseurl               = 'https://www.googleapis.com/books/v1/volumes';
    $params                = array();
    // $params['key']         = '作成したAPIキー';
    // $params['maxResults']  = 1;
    // $params['orderBy']     = 'relevance';
    // $params['country']     = 'JP';
    $params['q']           = $Keyword;
  
    // パラメータの順序を昇順に並び替え
    ksort($params);
  
    // canonical string を作成
    $canonical_string = '';
    foreach ($params as $k => $v) {
    //   $canonical_string .= '&'. urlencode_rfc3986($k) .'='. urlencode_rfc3986($v);
      $canonical_string .= '&'. $k .'='. $v;

    }
    $canonical_string = substr($canonical_string, 1);
  
    // URL を作成
    $url = $baseurl.'?'.$canonical_string;
  
    return $url;
  }

  function cURL_GetSite($url) {
    $MediumImage = '';
    $retArray = new stdClass();
  
    // 指定されたURL情報の取得
    $ch = curl_init( $url );
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
  
    // JSON情報パース
    $json = mb_convert_encoding($result, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    // var_dump($json);
    return $json;
  

    // // 画像URL, 検索ページの取得
    // $retArray->thumbnail = '';
    // $retArray->previewLink = '';
    // $retArray->ResultXML = $result;
  
    // $obj = json_decode($json, true);
    // $obj2 = $obj["items"][0];
  
    // $retArray->thumbnail = $obj2["volumeInfo"]["imageLinks"]["thumbnail"];
    // $retArray->previewLink = $obj2["volumeInfo"]["previewLink"];
  
    // return $retArray;
  }

$keyword = $_GET["search"];
$make_url = MakeUrl($keyword);    // スクレイピングURL作成
// echo $make_url;
$resultArray = cURL_GetSite($make_url);   // 問い合わせ

// $jsonData = json_encode($resultArray,true);

// var_dump($resultArray);
// echo $resultArray->thumbnail;
// echo $resultArray->previewLink;

echo $resultArray;



?>