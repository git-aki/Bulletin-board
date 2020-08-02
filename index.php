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
<h2>投稿内容</h2>
<?php
if(empty($_COOKIE['file'])){
 $file = $_GET['file'];
 setcookie("file",$file,time()+60*60);
} else {
  $file = $_COOKIE['file'];
}

$mode = "r";
require("./fileopen.php");
if($fileopen->flock(LOCK_SH)){
  foreach ($fileopen as $list):
    if($list[1] !== ""):
    ?>
<main>
          <?php  echo $list[1]."&nbsp;".$list[2]."&nbsp;".$list[4]."&nbsp;".$list[5]; ?>
          <form action="update.php" method="post" style="display: inline"><button type="submit" name="id" value="<?php echo $list[0]; ?>">編集</button></form>
          <form action="delete.php"method="post" style="display: inline"><button type="submit" name="id" value="<?php echo $list[0]; ?>">消去</button></form>
          <br>
    <?php if(!empty($list[3])){ echo "<img src='".$list[3]."'>"; } ?>
          <br>
<?php 
    endif;
  endforeach; 
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}
?>
</main>


<h2>投稿</h2>
<form action="input_do.php" method="post" enctype="multipart/form-data">
  <input type="text" name="author" placeholder="名無し">
  <br>
  <textarea name="content" cols="50" rows="10" placeholder="投稿内容" value=""></textarea>
  <br>
  <p>画像投稿</p>
  <input type="file" name="image">
  <br>
  <button type="submit">投稿する</button>
</form>

<P><a href="threadIndex.php">スレッド一覧へ戻る</a></P>
</body>    
</html>