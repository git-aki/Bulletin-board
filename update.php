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
if($fileopen->flock(LOCK_SH)){
  foreach($fileopen as $lists[]){
  }
  if(empty($_COOKIE['file'])){
    echo "データがが正しく受け取れませんでした。";
    echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
    exit();
  }
  $file = $_COOKIE['file'];
  $id = $_POST['id']-1;
  $mode = "r";
  require("./fileopen.php");
  ?>
  <h2>編集</h2>
  <form action="update_do.php" method="post" enctype="multipart/form-data">
    <input type="text" name="author" placeholder="<?php echo $lists[$id][1]; ?>" value="<?php   echo $lists[$id][1]; ?>">
    <br>
    <textarea name="content" cols="50" rows="10" placeholder="<?php echo $lists[$id][2]; ?>"  value="<?php echo $lists[$id][2]; ?>"></textarea>
    <br>
    <p>画像投稿</p>
    <input type="file" name="image">
    <br>
    <button type="submit" name="id" value="<?php echo $id; ?>">投稿する</button>
  </form>
  <p><a href="index.php">スレッド<?php echo $filename; ?>へ戻る</a></P>
<?php  
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}
?>
</body>    
</html>