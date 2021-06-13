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
$message = $_SESSION['message'];
unset($_SESSION['message']);
?>

<p><?php echo h($message);?></p>
<p><a href="index.php">もどる</a></p>
