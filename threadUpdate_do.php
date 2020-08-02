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
$mode = "";
require("./fileopen.php");
if($fileopen->flock(LOCK_SH)){
  $updatefilename = htmlspecialchars($_POST['update']);
  $updatefile = "./list/".$updatefilename.".csv";
  
  if(empty($updatefilename)){
    echo "入力されていません。";
    echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
    exit();
  }elseif(file_exists($updatefile)){
    echo "既に存在しています。\n別の名前で再度変更し直してください。";
    echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
    exit();
  }else{
    rename($file,$updatefile);
    rename("./image/".$filename,"./image/".$updatefilename);
    echo $filename."を".$updatefilename."に変更しました。";
  }  
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}
?>
<P><a href="threadIndex.php">スレッド一覧へ戻る</a></P>
</body>    
</html>