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
$filename = htmlspecialchars($_POST['filename']);
$file = "./list/".$filename.".csv";

if(empty($filename)){
  echo "入力されていません。";
  echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
  exit();
}elseif(file_exists($file)){
  echo "既に存在しています。\n別の名前で再度作成し直してください。";
  echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
  exit();
}else{
  $mode = "w";
  require("./fileopen.php");
  if($fileopen->flock(LOCK_EX)){
    mkdir("./image/".$filename, 0777);
    echo $filename."を作成しました。";  
    $fileopen->flock(LOCK_UN);
  } else {
    echo "他でファイルが編集されています。";
  }
}
?>
<P><a href="threadIndex.php">スレッド一覧へ戻る</a></P>
</body>    
</html>