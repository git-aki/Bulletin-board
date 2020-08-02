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
$mode = "a+";
require("./fileopen.php");
if($fileopen->flock(LOCK_EX)){
  $author = htmlspecialchars($_POST['author']);
  if(empty($author)){
    $author = "名無し";
  }
  $content = htmlspecialchars($_POST['content']);
  
  $fileopen->seek(PHP_INT_MAX);
  $id = $fileopen->key() + 1;
  
  if(!empty($_FILES['image']['name'])){
    require("./image.php");
  } else {
    $image = "";
  }
  
  $today = date("Y/m/d H:i:s");
  $updatetime = "";
  
  $fileopen -> fputcsv(array($id,$author,$content,$image,$today,$updatetime));
  
  echo $author."<br>".$content."<br>".$image."<br>"."投稿日時"."&ensp;".$today."<br>"."投稿しました。";
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}
?>
<P><a href="index.php">スレッド<?php echo $filename; ?>へ戻る</a></P>
</body>    
</html>