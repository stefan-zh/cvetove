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
$is = mysql_query("Select * from `issues` order by id DESC Limit 1");
while($tin = mysql_fetch_array($is)){
$lastissue = $tin['issue']; 
$issue = $lastissue;
}
}

if(!$q) { echo("<meta http-equiv='Refresh'  content='0; url=admin.php?q=journal&issue=$issue'>"); }

if(($q!='poetry') and ($q!='art') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `main` = 1 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 1 where `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1'>");  }

if(($q=='poetry') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `cat` = 'poetry' and `main` = 2 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 2 where `cat` = 'poetry' and `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1'>");  }

if(($q=='art') and ($main=='main')) { 
$del = mysql_query("UPDATE `$mysql_table` set `main` = 0 where `cat` = 'art' and `main` = 3 and `issue` = '$issue'");
$change = mysql_query("UPDATE `$mysql_table` set `main` = 3 where `cat` = 'art' and `id` = '$opt'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=1'>");  }

if($main=='del') {
if($q=='art'){
$imgsql = mysql_query("Select `img` from `$mysql_table` where `cat` = 'art' and `id` = '$opt' and `issue` = '$issue'");
while($kk = mysql_fetch_array($imgsql)){
$img = $kk['img'];
$myfile = "../$img";
unlink($myfile); }
}
$del = mysql_query("DELETE FROM `$mysql_table` where `cat` = '$q' and `id` = '$opt' and `issue` = '$issue'");
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=2'>"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="java/pngfix.js"></script>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Цветове | Администрация</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../java/category.js"></script>
<script type="text/javascript" src="../java/limiter.js"></script>
<script type="text/javascript" src="../java/bbcode.js"></script>
</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<div id="menu">
	<div id="nav"><a href="admin.php?q=journal&issue=<?php echo($issue); ?>" class="menu-text">журнал</a></div>
	<div id="nav"><a href="admin.php?q=poetry&issue=<?php echo($issue); ?>" class="menu-text">поезия</a></div>
	<div id="nav"><a href="admin.php?q=fiction&issue=<?php echo($issue); ?>" class="menu-text">проза</a></div>
	<div id="nav"><a href="admin.php?q=art&issue=<?php echo($issue); ?>" class="menu-text">арт</a></div>
	<div id="nav"><a href="admin.php?q=add" class="add">добави +</a></div>
	<div id="issue">
	  <form id="form1" name="form1" method="post" action="">
	    <label>Избери брой: </label><select name="issue" class="drop-menu" onchange="reload(this.form)">
			<option value="addissue" <?php if($q=='addissue'){ print("selected='selected'"); } ?>>нов брой</option>
	      	<?php
			$sql = mysql_query("Select * from `$issues`");
			while($sel = mysql_fetch_array($sql)) {
			$v = $sel['issue'];
			if(($v == $issue) and ($q!='addissue')) { $p = "selected='selected'"; }
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
		if($main=='edit') {include("edit.php"); }
		if($q=='middle'){ include("correct.php"); }?></div>
	<div id="footer">
	<a href="../index.php" target="_self" class="foot">Начало</a> | 
	<a href="../index.php?q=journal&issue=<?php echo($issue); ?>" target="_self" class="foot">Журнал</a> | 
	<a href="../index.php?q=poetry&issue=<?php echo($issue); ?>" target="_self" class="foot">Поезия</a> | 
	<a href="../index.php?q=fiction&issue=<?php echo($issue); ?>" target="_self" class="foot">Проза</a> | 
	<a href="../index.php?q=art&issue=<?php echo($issue); ?>" target="_self" class="foot">Арт</a> | 
	<a href="#" target="_self" class="foot">Лингвистика</a> | 
	<a href="../index.php?q=us&issue=<?php echo($issue); ?>" target="_self" class="foot">За нас</a> | 
	<a href="http://www.romainrolland.org" class="foot" target="_blank">ГПЧЕ "Ромен Ролан"</a><br />
	<span class="footer">&copy;2008 Ученически вестник. Всички права запазени.</span></div>
	</td>
  </tr>
</table>

</body>
</html>