<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="./style.css">
<title>掲示板</title>
</head>
<body>
<header>
  <h1>掲示板</h1>
</header>
<?php
if(empty($_COOKIE['file'])){
  echo "データがが正しく受け取れませんでした。";
  echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
  exit();
}
$file = $_COOKIE['file'];
$id = $_POST['id']-1;
$mode = "r";
require("./fileopen.php");
if($fileopen->flock(LOCK_SH)){
  foreach($fileopen as $lists[]){
  }
  
  $lists[$id][0] = "";
  $lists[$id][1] = "";
  $lists[$id][2] = "";
  if($lists[$id][3]){
  unlink($lists[$id][3]);
  }
  $lists[$id][3] = "";
  $lists[$id][4] = "";
  $lists[$id][5] = "";
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}

$mode = "w";
require("./fileopen.php");
if($fileopen->flock(LOCK_EX)){
  foreach($lists as $list){
    $fileopen->fputcsv($list);
  }
} else {
  echo "他でファイルが編集されています。";
}

echo "削除しました。"
?>
<P><a href="index.php">スレッド<?php echo $filename; ?>へ戻る</a></P>
</body>    
</html>