<?php
try {
  $user = "win8kat";
  $pass = "ninja900";
  $db = new PDO('mysql:host=mysql729.db.sakura.ne.jp;dbname=win8kat_toyoshima_sample;charset=utf8', $user, $pass);
} catch(PDOException $e) {
  echo 'DB接続エラー:'. $e->getMessage();
}

//htmlspecialcharsのショートカット
function h($value){
  return htmlspecialchars($value, ENT_QUOTES);
}
?>
