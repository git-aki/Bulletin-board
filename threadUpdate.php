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
setcookie("file",$file,time()+60*60);
?>

<form action="threadUpdate_do.php" method="post">
  <textarea name="update" cols="50" rows="1" placeholder="新しいスレッド名を入力してください" value=""></textarea><br>
  <button type="submit">変更する</button>
</form>
<P><a href="threadIndex.php">スレッド一覧へ戻る</a></P>
</body>    
</html>