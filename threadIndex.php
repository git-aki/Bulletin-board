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
<main>
<h2>スレッド一覧</h2>
  <?php
  if(isset($_COOKIE['file'])){
    setcookie("file","",time()-60*60);
  }
  $files = glob("./list/*");
  $sort = function($a, $b) {
    return filemtime($b) - filemtime($a);
  };
  usort($files,$sort);
  foreach ($files as $file):
    $filename = pathinfo($file, PATHINFO_FILENAME);
  ?>
        <form action="index.php" method="get" style="display: inline">
          <a href="./index.php?file=<?php echo urlencode($file); ?>">
            ・<?php echo $filename; ?>
          </a>
        </form>
        &nbsp;
        <form action="threadUpdate.php" method="post" style="display: inline"><button type="submit" name="file" value="<?php echo $file; ?>">名前変更</button></form>
        <form action="threadDelete.php"method="post" style="display: inline"><button type="submit" name="file" value="<?php echo $file; ?>">消去</button></form>
        <br>
<?php endforeach; ?>
</main>
  <h2>スレッド作成</h2>
<form action="threadInput_do.php" method="post">
  <textarea name="filename" cols="50" rows="1" placeholder="スレッド名を入力してください" value=""></textarea>
  <button type="submit" style="display: inline">作成する</button>
</form>
</body>    
</html>