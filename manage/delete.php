<?php
session_start();
require('dbconnect.php');
date_default_timezone_set('Asia/Tokyo');
if(isset($_SESSION['manager_id']) && $_SESSION['time'] + 3600 > time()){
//ログインしている
$_SESSION['time'] = time();
}else{
//ログインしていない
header('Location: login.php');
exit();
}

//不正なアクセスかチェック
if($_REQUEST['id'] == ""){
  header('Location: index.php');
}else{
  $id = $_REQUEST['id'];
}

$machines = $db->prepare('SELECT * FROM machines WHERE id=?');
$machines->execute(array($id));
$machine = $machines->fetch();

if(!empty($_POST)){
    header('Location: thanks.php');

  $statement = $db->prepare('DELETE FROM machines
    WHERE id=?');
    echo $ret = $statement->execute(array($id));
    $_SESSION['message'] = "削除しました";
    exit();

}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <title></title>
  </head>
  <body>
    <h3>以下のデータを削除しますか？</h3>
    <p>削除後はデータは元に戻せません</p>
<form action="" method="post" enctype = "multipart/form-data">
  <input type = "hidden" name="action" value="submit" />
  <dl>
    <dt>製品名</dt>
    <dd>
      <?php echo h($machine['name']);?>
    </dd>
    <dt>運転質量</dt>
    <dd>
      <?php echo h($machine['weight']);?>
    </dd>
    <dt>標準バケット容量（新JIS）</dt>
    <dd>
      <?php echo h($machine['capacity']);?>
    </dd>
    <dt>定格出力</dt>
    <dd>
      <?php echo h($machine['output_power']);?>
    </dd>
    <dt>タイプ</dt>
    <dd>
      <?php echo h($machine['type']);?>
    </dd>
    <dt>仕様</dt>
    <dd>
      <?php echo h($machine['spec']);?>
    </dd>
    <dt>騒音</dt>
    <dd>
      <?php echo h($machine['noise']);?>
    </dd>
    <dt>排ガス規制</dt>
    <dd>
      <?php echo h($machine['exhaust']);?>
    </dd>
  </dl>
  <div><input type="submit" value="削除する"></div>
</form>


  </body>
</html>
