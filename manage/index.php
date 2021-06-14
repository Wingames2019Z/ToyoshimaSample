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
//登録者情報を取得
$machines = $db->query('SELECT * FROM machines');

$counts = $db->query('SELECT COUNT(*) AS num FROM machines');
$count = $counts->fetch();



?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>豊島重機ホームページ作成 管理画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="greet">
      <a href="logout.php">ログアウト</a>
    </div>
    <div class ="main">
    <h1>豊島重機ホームページ作成 管理画面</h1>
    <div class ="facility">
    <h2>重機登録総数<?php echo  h($count['num']); ?>件</h2>
      <table border="1">
        <tr>
          <th>ID</th>
          <th>製品名</th>
          <th>運転質量</th>
          <th>標準バケット容量（新JIS）</th>
          <th>定格出力</th>
          <th>タイプ</th>
          <th>仕様</th>
          <th>騒音</th>
          <th>排ガス規制</th>
          <th>写真</th>
          <th></th>
        </tr>
    <?php foreach ($machines as $machine):?>
      <tr>
        <th><?php echo  h($machine['id']); ?></th>
        <th><?php echo  h($machine['name']); ?></th>
        <th><?php echo  h($machine['weight']); ?></th>
        <th><?php echo  h($machine['capacity']); ?></th>
        <th><?php echo  h($machine['output_power']); ?></th>
        <th><?php echo  h($machine['type']); ?></th>
        <th><?php echo  h($machine['spec']); ?></th>
        <th><?php echo  h($machine['noise']); ?></th>
        <th><?php echo  h($machine['exhaust']); ?></th>
        <th><?php $photo_main_path = "../images/" .$machine['photo'];
            if (file_exists($photo_main_path)) :?>
            <img src ="<?php echo h($photo_main_path ) ;?>" width="100" height="100"/>
            <?php else :?>
            <img src ="../images/noimage.png" width="100" height="100"/>
            <?php endif;?></th>
        <th><a href="delete.php?id=<?php echo h($machine['id']);?>" >削除</th>
      </tr>
    <?php endforeach;?>
  </table>
  </div>
    <a href="add.php" >重機追加</a>
  </div>

</body>
</html>
