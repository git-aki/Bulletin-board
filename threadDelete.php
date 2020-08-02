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

$file = $_POST['file'];
$mode = "";
require("./fileopen.php");
if($fileopen->flock(LOCK_SH)){
  unlink($file);
  $files = glob("./image/".$filename."/*");
  if($files){
    foreach($files as $file){
      unlink($file);
    }
  }
  rmdir('./image/'.$filename);
  
  echo $filename."を消去しました。";
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}

?>
<P><a href="threadIndex.php">スレッド一覧へ戻る</a></P>
</body>    
</html>