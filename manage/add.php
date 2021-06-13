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

if (!empty($_POST)){
//エラー項目の確認
if($_POST['name']==''){
  $error['name'] = 'blank';
}
if($_POST['weight']==''){
  $error['weight'] = 'blank';
}
if($_POST['capacity']==''){
  $error['capacity'] = 'blank';
}
if($_POST['power']==''){
  $error['power'] = 'blank';
}
if($_POST['type']==''){
  $error['type'] = 'blank';
}
if($_POST['spec']==''){
  $error['spec'] = 'blank';
}
if($_POST['noise']==''){
  $error['noise'] = 'blank';
}
if($_POST['exhaust']==''){
  $error['exhaust'] = 'blank';
}



$fileName = $_FILES['photo_main']['name'];


if(!empty($fileName)){

  $fileSize = $_FILES['photo_main']['size'];
  //5MB以下でアップされた場合
  if($fileSize != 0 ){

  }
  //ファイルサイズオーバーでアップされた場合
  else{
  $error['photo_main']='size';
  }

  $ext = substr($fileName, -3);
  if($ext != 'jpg' && $ext !='png' && $ext !='gif'){
    $error['photo_main'] = 'type';
  }
}



if(empty($error)){
  //メイン画像をアップロードする
  if(!empty($fileName)){
    $photo_main = date('YmdHis') . $_FILES['photo_main']['name'];
    move_uploaded_file($_FILES['photo_main']['tmp_name'], '../images/'.$photo_main);
  }else{
    $photo_main = 'noimage.png';
  }


  $_SESSION['add'] = $_POST;
  $_SESSION['add']['photo_main'] = $photo_main;

  header('Location: add_do.php');
  exit();

}

}

//書き直し
if($_REQUEST['action'] == 'rewrite'){
  $_POST = $_SESSION['add'];
  $error['rewrite'] = true;
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
      <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <title></title>
  </head>
  <body>
    <h3>重機を追加</h3>
<form action="" method="post" enctype = "multipart/form-data">
  <dl>
    <dt>製品名<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="name" size="35" maxlength="255" value="<?php echo h ($_POST['name']);?>" />
      <?php if ($error['name'] == 'blank'): ?>
        <p class="error">*名前を入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>運転質量<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="weight" size="35" maxlength="255" oninput="value = value.replace(/[^0-9]+/i,'');" value="<?php echo h ($_POST['weight']);?>" />
      <?php if ($error['weight'] == 'blank'): ?>
        <p class="error">*運転質量を入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>標準バケット容量（新JIS）<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="capacity" size="35" maxlength="255" oninput="value = value.replace(/[^0-9]+/i,'');" value="<?php echo h ($_POST['capacity']);?>" />
      <?php if ($error['capacity'] == 'blank'): ?>
        <p class="error">*標準バケット容量（新JIS）</p>
      <?php endif; ?>
    </dd>
    <dt>定格出力<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="power" size="35" maxlength="255" oninput="value = value.replace(/[^0-9]+/i,'');" value="<?php echo h ($_POST['power']);?>" />
      <?php if ($error['power'] == 'blank'): ?>
        <p class="error">*定格出力を入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>タイプ<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="type" size="35" maxlength="255" value="<?php echo h ($_POST['type']);?>" />
      <?php if ($error['type'] == 'blank'): ?>
        <p class="error">*タイプを入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>仕様<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="spec" size="35" maxlength="255" value="<?php echo h ($_POST['spec']);?>" />
      <?php if ($error['spec'] == 'blank'): ?>
        <p class="error">*仕様を入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>騒音<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="noise" size="35" maxlength="255" value="<?php echo h ($_POST['noise']);?>" />
      <?php if ($error['noise'] == 'blank'): ?>
        <p class="error">*騒音を入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>排ガス規制<span class ="required"> 必須</span></dt>
    <dd>
      <input type="text" name="exhaust" size="35" maxlength="255" value="<?php echo h ($_POST['exhauset']);?>" />
      <?php if ($error['exhauset'] == 'blank'): ?>
        <p class="error">*排ガス規制を入力してください</p>
      <?php endif; ?>
    </dd>

    <dt>メイン写真　最大ファイルサイズは5MB</dt>
    <?php if (isset($error)): ?>
      <p class="error">＊恐れ入りますが、もう一度画像を指定してください</p>
    <?php endif; ?>
    <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
    <dd><input type="file" name="photo_main" size="35"/></dd>

  </dl>
  <div><input type="submit" value="入力内容を確認する"></div>
  </form>


  </body>
</html>
