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

$photo_main_path = "../takaraichi/erea/" .$_SESSION['add']['erea_id']. "/img/". $_SESSION['add']['photo_main'];
$photo_main_path2 = "../takaraichi/erea/" .$_SESSION['add']['erea_id']. "/img/". $_SESSION['add']['photo_main2'];
$photo_main_path3 = "../takaraichi/erea/" .$_SESSION['add']['erea_id']. "/img/". $_SESSION['add']['photo_main3'];
$photo_main_path4 = "../takaraichi/erea/" .$_SESSION['add']['erea_id']. "/img/". $_SESSION['add']['photo_main4'];

$photo_outside_path = "../takaraichi/erea/" .$_SESSION['add']['erea_id']. "/outside_img/". $_SESSION['add']['photo_outside'];


if(!empty($_POST)){
    header('Location: thanks.php');

  //登録処理をする


  $statement = $db->prepare('INSERT INTO facility
    SET erea_id=?, erea_number=?, name=?, category=?, phone=?, address=?, url=?,
    photo_main=?,	photo_main2=?, photo_main3=?, photo_main4=?, photo_outside=?, opening_hours=?, short_description=?, main_description=?');
    echo $ret = $statement->execute(array(
      $_SESSION['add']['erea_id'],
      $_SESSION['add']['erea_number'],
      $_SESSION['add']['name'],
      $_SESSION['add']['category'],
      $_SESSION['add']['phone'],
      $_SESSION['add']['address'],
      $_SESSION['add']['url'],
      $_SESSION['add']['photo_main'],
      $_SESSION['add']['photo_main2'],
      $_SESSION['add']['photo_main3'],
      $_SESSION['add']['photo_main4'],
      $_SESSION['add']['photo_outside'],
      $_SESSION['add']['opening_hours'],
      $_SESSION['add']['short_description'],
      $_SESSION['add']['main_description']
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
    <dt>名前</dt>
    <dd>
      <?php echo h($_SESSION['add']['name']);?>
    </dd>
    <dt>エリア</dt>
    <dd>
      <?php echo h($_SESSION['add']['erea_id']);?>
    </dd>
    <dt>エリア番号</dt>
    <dd>
      <?php echo h($_SESSION['add']['erea_number']);?>
    </dd>
    <dt>カテゴリ</dt>
    <dd>
      <?php echo h($_SESSION['add']['category']);?>
    </dd>
    <dt>電話</dt>
    <dd>
      <?php echo h($_SESSION['add']['phone']);?>
    </dd>
    <dt>住所</dt>
    <dd>
      <?php echo h($_SESSION['add']['address']);?>
    </dd>
    <dt>店舗URL</dt>
    <dd>
      <?php echo h($_SESSION['add']['url']);?>
    </dd>
    <dt>営業時間</dt>
    <dd>
      <?php echo h($_SESSION['add']['opening_hours']);?>
    </dd>
    <dt>短い説明文</dt>
    <dd>
      <?php echo h($_SESSION['add']['short_description']);?>
    </dd>
    <dt>メインの説明文</dt>
    <dd>
      <?php echo h($_SESSION['add']['main_description']);?>
    </dd>
    <dt>メイン写真</dt>
    <dd>
      <?php if (file_exists($photo_main_path)) :?>
        <img src ="<?php echo h($photo_main_path ) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../takaraichi/img/noimage.png" width="100" height="100"/>
      <?php endif;?>
    </dd>
    <dt>メイン写真2</dt>
    <dd>
      <?php if (file_exists($photo_main_path2)) :?>
        <img src ="<?php echo h($photo_main_path2 ) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../takaraichi/img/noimage.png" width="100" height="100"/>
      <?php endif;?>
    </dd>
    <dt>メイン写真3</dt>
    <dd>
      <?php if (file_exists($photo_main_path3)) :?>
        <img src ="<?php echo h($photo_main_path3 ) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../takaraichi/img/noimage.png" width="100" height="100"/>
      <?php endif;?>
    </dd>
    <dt>メイン写真4</dt>
    <dd>
      <?php if (file_exists($photo_main_path4)) :?>
        <img src ="<?php echo h($photo_main_path4 ) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../takaraichi/img/noimage.png" width="100" height="100"/>
      <?php endif;?>
    </dd>
    <dt>外観写真</dt>
    <dd>
      <?php if (file_exists($photo_outside_path)) :?>
        <img src ="<?php echo h($photo_outside_path) ;?>" width="100" height="100"/>
      <?php else :?>
        <img src ="../takaraichi/img/noimage.png" width="100" height="100"/>
      <?php endif;?>

    </dd>
  </dl>
  <div><a href="add.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する"></div>
</form>


  </body>
</html>
