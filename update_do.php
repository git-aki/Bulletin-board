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
$id = $_POST['id'];
$mode = "r";
require("./fileopen.php");
if($fileopen->flock(LOCK_SH)){
  foreach($fileopen as $lists[]){
  }

  $author = htmlspecialchars($_POST['author']);
  if(empty($author)){
    $author = "名無し";
  }
  $lists[$id][1] = $author;
  if(!empty($_POST['content'])){
    $content = htmlspecialchars($_POST['content']);
    $lists[$id][2] = $content;
  }
  if(!empty($_FILES['image']['name']) && !empty($lists[$id][3])){
    unlink($lists[$id][3]);
    $id+=1;
    require("./image.php");
    $id-=1;
  } elseif(empty($_FILES['image']['name']) && !empty($lists[$id][3])){
    $image = $lists[$id][3];
  } elseif(!empty($_FILES['image']['name']) && empty($lists[$id][3])){
    $id+=1;
    require("./image.php");
    $id-=1;
  } elseif(empty($_FILES['image']['name']) && empty($lists[$id][3])){
    $image = "";
  }
  $lists[$id][3] = $image;
  $lists[$id][5] = date("Y/m/d H:i:s");
  echo $lists[$id][1]."<br>".$lists[$id][2]."<br>".$lists[$id][3]."<br>"."編集日時"."&ensp;".$lists[$id][5]."<br>"."投稿しました。";
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
  $fileopen->flock(LOCK_UN);
} else {
  echo "他でファイルが編集されています。";
}
?>
<P><a href="index.php">スレッド<?php echo $filename; ?>へ戻る</a></P>
</body>    
</html>