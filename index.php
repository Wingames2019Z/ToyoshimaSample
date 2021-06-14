<?php
session_start();
require('./manage/dbconnect.php');
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

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>株式会社 豊島重機</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slide.css">
<script src="js/openclose.js"></script>
<script src="js/fixmenu.js"></script>
<script src="js/fixmenu_pagetop.js"></script>
<script src="js/ddmenu_min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="home">

<div id="container">

<header>
<h1 id="logo"><a href="index.html"><img src="images/logo.png" alt="SAMPLE COMPANY"></a></h1>
<!--スライドショー-->
<aside id="mainimg">
<img src="images/0.png" alt="" class="slide0">
<img src="images/1.jpg" alt="" class="slide1">
<img src="images/2.jpg" alt="" class="slide2">
<img src="images/3.jpg" alt="" class="slide3">
</aside>
</header>

<!--PC用（801px以上端末）メニュー-->
<nav id="menubar" class="nav-fix-pos">
<ul class="inner">
<li><a href="index.html">ホーム<span>HOME</span></a></li>
<li><a href="#">レンタル機ラインナップ<span>LINE UP</span></a></li>
<li><a href="javascript:void(0)" class="cursor-default">重機回送<span>HEAVY MACHINE CARRIAGE</span></span>
	<ul class="ddmenu">
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	</ul>
</li>
<li><a href="#">会社概要<span>COMPANY INFO</span></a></li>
<li><a href="#">アクセス<span>ACCESS</span></a></li>
</ul>
</nav>

<!--小さな端末用（800px以下端末）メニュー-->
<nav id="menubar-s">
<ul>
<li><a href="index.html">HOME<span>ホーム</span></a></li>
<li><a href="about.html">LINE UP<span>レンタル機ラインナップ</span></a></li>
<li id="menubar_hdr2" class="close">HEAVY MACHINE CARRIAGE<span>重機回送</span>
	<ul id="menubar-s2">
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	<li><a href="#">メニュー</a></li>
	</ul>
</li>
<li><a href="recruit.html">COMPANY INFORMATION<span>会社概要</span></a></li>
<li><a href="contact.html">ACCESS<span>アクセス</span></a></li>
</ul>
</nav>

<div id="contents">

<div class="inner">

<section>

<h2>ラインナップ<span>LINE UP</span></h2>

<div class="list-column-container">
    <?php foreach ($machines as $machine):?>
			<div class="list-column">
				<figure>
					<?php $photo_main_path = "images/" .$machine['photo']; if (file_exists($photo_main_path)) :?>
						<img src ="<?php echo h($photo_main_path ) ;?>"/>
					<?php else :?>
						<img src ="images/noimage.png"/>
					<?php endif;?>
				</figure>
				<div class="text">
					<h4><?php echo  h($machine['name']); ?></h4>
					      <table border="1">
									<tr>
										<th>運転質量</th>
										<th>標準バケット容量（新JIS）</th>
										<th>定格出力</th>
										<th>タイプ</th>
										<th>仕様</th>
										<th>騒音</th>
										<th>排ガス規制</th>
									</tr>
									<tr>
										<th><?php echo  h($machine['weight']); ?></th>
										<th><?php echo  h($machine['capacity']); ?></th>
										<th><?php echo  h($machine['output_power']); ?></th>
										<th><?php echo  h($machine['type']); ?></th>
										<th><?php echo  h($machine['spec']); ?></th>
										<th><?php echo  h($machine['noise']); ?></th>
										<th><?php echo  h($machine['exhaust']); ?></th>
									</tr>
								</table>
				</div>
				<p class="btn1"><a href="#">詳細を見る</a></p>
			</div>
    <?php endforeach;?>

</div>
<!--/.list-column-container-->

</section>

<section id="new">

<h2>News<span>お知らせ</span></h2>
<dl>
<dt>2021/04/07</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
</dl>
<p class="r">&raquo;&nbsp;<a href="#">過去ログ</a></p>

</section>
<!--/#new-->

<section>

<!-- <h2>Read Me<span>テンプレートのご利用前に必ずお読み下さい</span></h2>

<h3>利用規約のご案内</h3>
<p>このテンプレートは、<a href="https://template-party.com/">Template Party</a>にて無料配布している『企業・ビジネスサイト向け 無料ホームページテンプレート tp_biz55』です。必ずダウンロード先のサイトの<a href="https://template-party.com/read.html">利用規約</a>をご一読の上でご利用下さい。</p>
<p><strong class="color1">HP最下部の著作表示『Web Design:Template-Party』は無断で削除しないで下さい。</strong><br>
わざと見えなく加工する事も禁止です。</p>
<p><strong class="color1">下部の著作を外したい場合は</strong><br>
<a href="https://template-party.com/">Template-Party</a>の<a href="https://template-party.com/member.html">ライセンス契約</a>を行う事でHP下部の著作を外す事ができます。</p>

<h3>※当テンプレートにはお問い合わせフォーム（自動フォーム：試用版）がセットされています</h3>
<p><a href="contact.html">contact.html</a>と同じ３項目のお問い合わせフォームを簡単に使えるようにセットしています。</p>
<p><strong class="color1">自動フォームを使う場合（※編集に入る前にご確認下さい）</strong><br>
あなたのメールアドレス設定と、簡単な編集だけで使えます。<a href="https://template-party.com/file/formgen_manual_set2.html" target="_blank">詳しくはこちらのマニュアルをご覧下さい。</a></p>
<p><strong class="color1">自動フォームを使わない場合</strong><br>
テンプレートに梱包されている「form.html」「confirm.html」「finish.html」の3枚のファイルを削除して下さい。</p>

<h3>テンプレートに梱包されているjavascriptファイル（jsファイル）について</h3>
<p>当テンプレートに梱包されているjavascriptファイルは全て<a href="https://www.crytus.info/" target="_blank">クリタス様</a>提供のものです。jsファイルは改変せずにご利用下さい。<br>
また、当サイトのテンプレート「以外」に使いたいなど、「プログラムのみ」を使う場合は<a href="https://template-party.com/free_program/openclose_license.html">こちらの規約</a>をお守り下さい。</p>

<h3>当テンプレートの詳しい使い方は</h3>
<p><a href="about.html">こちらをご覧下さい。</a></p> -->

</section>

</div>
<!--/.inner-->

</div>
<!--/#contents-->

<footer>

<div id="footermenu" class="inner">
<ul>
<li class="title">タイトル</li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
</ul>
<ul>
<li class="title">タイトル</li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
</ul>
<ul>
<li class="title">タイトル</li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
</ul>
<ul>
<li class="title">タイトル</li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
<li><a href="#">メニューサンプル</a></li>
</ul>
</div>
<!--/#footermenu-->

<div id="copyright">
<ul class="icon">
<li><a href="#"><img src="images/icon_facebook.png" alt="Facebook"></a></li>
<li><a href="#"><img src="images/icon_twitter.png" alt="Twitter"></a></li>
<li><a href="#"><img src="images/icon_instagram.png" alt="Instagram"></a></li>
<li><a href="#"><img src="images/icon_youtube.png" alt="TouTube"></a></li>
</ul>
<small>Copyright&copy; <a href="index.html">SAMPLE COMPANY</a> All Rights Reserved.</small>
<span class="pr"><a href="https://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
</div>
<!--/#copyright-->

</footer>

</div>
<!--/#container-->

<p class="nav-fix-pos-pagetop"><a href="#">↑</a></p>

<!--メニュー開閉ボタン-->
<div id="menubar_hdr" class="close"></div>

<!--メニューの開閉処理-->
<script>
open_close("menubar_hdr", "menubar-s");
</script>

<!--「WORKS」の子メニュー-->
<script>
	open_close("menubar_hdr2", "menubar-s2");
</script>

</body>
</html>
