<?php
$user = $_COOKIE['ime'];
$pass = $_COOKIE['pass'];
$rem = $_COOKIE['remember'];
if(!$rem) { $rem = $_POST['rem']; setcookie( "remember", $rem, time() + 3600 ); } 
if(($user!='s.council') or ($pass!='1as35m')){ 
$username = $HTTP_POST_VARS['username'];
$password = $HTTP_POST_VARS['pas'];
$rem = $_POST['rem'];
if(($username!='s.council') or ($password!='1as35m')) {
setcookie('ime','',time()-3600);
setcookie('pass','',time()-3600);
setcookie('remember','',time()-3600);
echo "<meta http-equiv='Refresh'  content='0; url=index.php?status=wrong'>";
die();
}
else {
setcookie( "ime", $username, time() + 3600 );
setcookie( "pass", $password, time() + 3600 );
setcookie( "remember", $rem, time() + 3600 ); }
}

include("connect.php");

$q = $_GET['q'];
$main = $_GET['main'];
$opt = $_GET['opt'];
$method = $_GET['method'];

$issue = $_GET['issue'];
	if(!$issue){
$is = mysql_query("Select * from `issues` where `status` = '1' order by id DESC Limit 1");
while($tin = mysql_fetch_array($is)){
$lastissue = $tin['issue']; 
$issue = $lastissue;
}
}

if(!$q) { echo("<meta http-equiv='Refresh'  content='0; url=admin.php?q=journal&issue=$issue'>"); }

if(($q!='poetry') and ($q!='art') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `main` = 1 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 1 where `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1&issue=$issue'>");  }

if(($q=='poetry') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `cat` = 'poetry' and `main` = 2 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 2 where `cat` = 'poetry' and `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1&issue=$issue'>");  }

if(($q=='art') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `cat` = 'art' and `main` = 3 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 3 where `cat` = 'art' and `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1&issue=$issue'>");  }

if($main=='del') {
if($q=='art'){
$imgsql = mysql_query("Select `img` from `$mysql_table` where `cat` = 'art' and `id` = '$opt' and `issue` = '$issue'");
while($kk = mysql_fetch_array($imgsql)){
$img = $kk['img'];
$myfile = "../$img";
unlink($myfile); 
}
}
else {
$findimg = mysql_query("Select * from `$mysql_table` where `id` = '$opt'");
while($getimg = mysql_fetch_array($findimg)){
$imgurl = $getimg['img'];
$icourl = $getimg['ico'];
}
$imgurl = "../$imgurl";
$icourl = "../$icourl";
unlink($imgurl);
unlink($icourl);
}
$del = mysql_query("DELETE FROM `$mysql_table` where `cat` = '$q' and `id` = '$opt' and `issue` = '$issue'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=2&issue=$issue'>"); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="java/pngfix.js"></script>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Цветове | Администрация</title>
<meta name="resource-type" content="document" />
<meta http-equiv="content-language" content="bg" />
<meta content="Stefan Zhelyazkov" name="author" />
<meta name="copyright" content="Copyright © 2008 Stefan Zhelyazkov and Romain Rolland FLS, All Rights Reserved" />
<meta name="keywords" content="цветове, вестник, електронен вестник, ГПЧЕ Ромен Ролан, журнал, поезия, проза, арт" />
<meta name="description" content="Вестник Цветове - електронен вестник на Гимназия с преподаване на чужди езици Ромен Ролан, град Стара Загора" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="noarchive" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/chromestyle.css" />
<script type="text/javascript" src="../java/chrome.js"></script>
<script type="text/javascript" src="../java/category.js"></script>
<script type="text/javascript" src="../java/limiter.js"></script>
<script type="text/javascript" src="../java/bbcode.js"></script>
</head>
<body>
<script type="text/javascript" src="../java/wz_tooltip/wz_tooltip.js"></script>
<script type="text/javascript" src="../java/wz_tooltip/tip_balloon.js"></script>

<div id="manager">
	<div class="homeText"><a href="../index.php" target="_self" class="foot">начална страница</a></div>
	<?php
	$allissues = mysql_query("Select * from issues");
	$allissuesrows = mysql_num_rows($allissues);
	if($allissuesrows > 0) { $mess = "<a href='?q=manager' class='foot'>мениджър броеве</a>"; }
	$unactiveissues = mysql_query("Select * from `issues` where `status` = '0' ");
	$unactive = mysql_num_rows($unactiveissues);
	if($unactive > 0) { $icowarn = "<img src='../images/icons/warnedbig.gif' align='left' onmouseover=\"Tip('Това <b>предупреждение</b> показва, че този <br>вестник съдържа неактивни броеве.', BALLOON, true, ABOVE, true, OFFSETX, -17, FADEIN, 350, FADEOUT, 400, PADDING, 8)\" onmouseout=\"UnTip()\" />&nbsp;"; }
	?>
	<div id="issueManager"><?php echo($icowarn . $mess); ?></div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<div id="menu">
	<div id="nav"><a href="admin.php?q=journal&amp;issue=<?php echo($issue); ?>" class="menu-text">журнал</a></div>
	<div id="nav"><a href="admin.php?q=poetry&amp;issue=<?php echo($issue); ?>" class="menu-text">поезия</a></div>
	<div id="nav"><a href="admin.php?q=fiction&amp;issue=<?php echo($issue); ?>" class="menu-text">проза</a></div>
	<div id="nav"><a href="admin.php?q=art&amp;issue=<?php echo($issue); ?>" class="menu-text">арт</a></div>
	<div class="chromestyle" id="chromemenu">
		<ul>
		<li><a href="#" rel="dropmenu1">добави</a></li>
		</ul>
	</div>
		<!--1st drop down menu -->                                                   
	<div id="dropmenu1" class="dropmenudiv">
		<a href="?q=add">статия</a>
		<a href="?q=addimage" target="_blank">картинка</a>
		<a href="?q=addissue">нов брой</a>
	</div>
		<script type="text/javascript">cssdropdown.startchrome("chromemenu")</script>
	<div id="issue">
	  <form id="form1" name="form1" action="" method="post">
	    <label>Избери брой: </label><select name="issue" class="drop-menu" onchange="reload(form1)">
	      	<?php
			$sql = mysql_query("Select * from `$issues`");
			while($sel = mysql_fetch_array($sql)) {
			$v = $sel['issue'];
			if($v == $issue) { $p = "selected='selected'"; }
			else { $p = " "; }
			$n = $sel['name'];
			echo("<option value=$v $p>$n</option>\n"); }
			?>
	    </select>
	  </form>
	  </div>
	</div>
	<div id="body1"><?php 
		if(($q=='journal') and ($method!='full') and ($main=='')){ include("journal-b.php"); }
		if(($q=='fiction') and ($method!='full') and ($main=='')){ include("fiction-b.php"); }
		if(($q=='poetry') and ($method!='full') and ($main=='')){ include("poetry-b.php"); }
		if(($q=='art') and ($method!='full') and ($main=='')){ include("art-b.php"); }
		if(($q!='poetry') and ($q!='art') and ($method=='full')) { include("view.php"); }
		if(($q=='poetry') and ($method=='full')) { include("pview.php"); }
		if(($q=='art') and ($method=='full')) { include("aview.php"); }
		if($q=='add'){ include("add.php"); }
		if($q=='addissue') { include("addissue.php"); }
		if($q=='addimage') { include("image.php"); }
		if($q=='manager') { include("manager.php"); }
		if($main=='edit') {include("edit.php"); }
		if($q=='middle'){ include("correct.php"); }?></div>
	<div id="footer">
	<a href="../index.php" target="_self" class="foot">Начало</a> | 
	<a href="../index.php?q=journal&amp;issue=<?php echo($issue); ?>" target="_self" class="foot">Журнал</a> | 
	<a href="../index.php?q=poetry&amp;issue=<?php echo($issue); ?>" target="_self" class="foot">Поезия</a> | 
	<a href="../index.php?q=fiction&amp;issue=<?php echo($issue); ?>" target="_self" class="foot">Проза</a> | 
	<a href="../index.php?q=art&amp;issue=<?php echo($issue); ?>" target="_self" class="foot">Арт</a> | 
	<a href="../index.php?q=us&amp;issue=<?php echo($issue); ?>" target="_self" class="foot">За нас</a> | 
	<a href="http://www.romainrolland.org" class="foot" target="_blank">ГПЧЕ &quot;Ромен Ролан&quot;</a><br />
	<span class="footer">&copy;2008 Ученически вестник. Всички права запазени.</span></div>
	</td>
  </tr>
</table>

</body>
</html>