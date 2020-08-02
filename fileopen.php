<?php
if(!empty($mode)){
    try {
        $fileopen = new SplFileObject($file,$mode);
    } catch (Exception $e) {
        echo  $e->getMessage();
        echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
        exit();
    }
    $filename = $fileopen->getBasename('.csv');
    if($mode === 'r'){
      $fileopen->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY | \SplFileObject::READ_AHEAD);
    }
} else {
    try {
      $fileopen = new SplFileObject($file);
  } catch (Exception $e) {
      echo  $e->getMessage();
      echo "<P><a href='threadIndex.php'>スレッド一覧へ戻る</a></P>";
      exit();
  }
  $filename = $fileopen->getBasename('.csv');
}
?>