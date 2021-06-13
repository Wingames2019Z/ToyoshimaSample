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

//入力フォーマットに入力されてない（不正なアクセス）
if(!isset($_SESSION['add'])){
  header('Location: index.php');
  exit();
}

$photo_main_path = "../images/". $_SESSION['add']['photo_main'];

if(!empty($_POST)){
    header('Location: thanks.php');

  //登録処理をする


  $statement = $db->prepare('INSERT INTO machines
    SET name=?, weight=?, capacity=?, output_power=?, type=?, spec=?, noise=?,
    exhaust=?,	photo_main=?');
    echo $ret = $statement->execute(array(
      $_SESSION['add']['name'],
      $_SESSION['add']['weight'],
      $_SESSION['add']['capacity'],
      $_SESSION['add']['power'],
      $_SESSION['add']['type'],
      $_SESSION['add']['spec'],
      $_SESSION['add']['noise'],
      $_SESSION['add']['exhaust'],
      $_SESSION['add']['photo_main'],
    ));
    unset($_SESSION['add']);
    $_SESSION['message'] = "追加しました";

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
<form action="" method="post" enctype = "multipart/form-data">
  <input type = "hidden" name="action" value="submit" />
  <dl>
    <dt>製品名</dt>
    <dd>
      <?php echo h($_SESSION['add']['name']);?>
    </dd>
    <dt>運転質量</dt>
    <dd>
      <?php echo h($_SESSION['add']['weight']);?>
    </dd>
    <dt>標準バケット容量（新JIS）</dt>
    <dd>
      <?php echo h($_SESSION['add']['capacity']);?>
    </dd>
    <dt>定格出力</dt>
    <dd>
      <?php echo h($_SESSION['add']['power']);?>
    </dd>
    <dt>タイプ</dt>
    <dd>
      <?php echo h($_SESSION['add']['type']);?>
    </dd>
    <dt>仕様</dt>
    <dd>
      <?php echo h($_SESSION['add']['spec']);?>
    </dd>
    <dt>騒音</dt>
    <dd>
      <?php echo h($_SESSION['add']['noise']);?>
    </dd>
    <dt>排ガス規制</dt>
    <dd>
      <?php echo h($_SESSION['add']['exhaust']);?>
    </dd>
    <dt>メイン写真</dt>
    <dd>
      <?php if (file_exists($photo_main_path)) :?>
        <img src ="<?php echo h($photo_main_path ) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../images/noimage.png" width="100" height="100"/>
      <?php endif;?>
    </dd>
  </dl>
  <div><a href="add.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する"></div>
</form>


  </body>
</html>
