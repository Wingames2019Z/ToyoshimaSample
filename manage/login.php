<?php
ob_start();
require('dbconnect.php');
session_start();

if($_COOKIE['email'] !=''){
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
}

if(!empty($_POST)){
//ログイン
$manager_id = "0";
  if($_POST['password'] !=''){
    $login = $db->prepare('SELECT * FROM pass WHERE id=? AND password=?');
    $login->execute(array($manager_id,sha1($_POST['password'])));
    $manager = $login->fetch();

    if($manager){
      //ログイン成功
    $_SESSION['manager_id'] = $manager['id'];
    $_SESSION['time'] = time();

      //ログイン情報を記録する
    if($_POST['save'] == 'on'){
      setcookie('password',$_POST['password'],time()+60*60*24*14);
    }

    header('Location: index.php');
    exit();
    }else{
      $error['login'] = 'failed';
    }
  }else{
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title></title>
  </head>
  <body>
  <div class="login">
  <div class="login-box">
    <h3>豊島重機　管理システム</h3>
    <div class="login-item">
    <div class="login-cell1">
    </div>
    <div class="login-cell">
      <form action ="" method="post">
            <?php if($error['login'] == 'blank'): ?>
          <p class = "error">*パスワードをご記入ください</P>
           <?php endif; ?>
           <?php if ($error['login'] == 'failed'): ?>
          <p class = "error">*ログインに失敗しました。正しくご記入ください</P>
            <?php endif; ?>
            <p>パスワード</p>
              <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"/><br>
              <input id ="save" type="checkbox" name="save" value="on" />
              <label for="save">次回からは自動的にログインする</label><br>
              <input type="submit" value="ログイン" />
          </form>
      </div>

    </div>

  </div>
  </div>
  </body>
  </html>
