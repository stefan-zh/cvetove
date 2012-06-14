<?php
include("connect.php");
$issue = $_GET['issue'];
$q = $_GET['q'];

$qq = "Select * from `$mysql_table` where `main` = '3' and `issue` = '$issue'";
$req = mysql_query($qq);
$rr = mysql_fetch_array($req);
$main = $rr['main'];
if($main=='') { 
$err="<tr><td><div id='reply-n'>В тази категория няма главна новина!<br />
Моля, изберете някоя новина за главна!$main</div></td></tr>"; }

$target = 295;

$query = mysql_query("Select * from `$mysql_table` where `cat` = '$q' and `issue` = '$issue' order by `id` DESC");
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$name = $row['name'];
$date = $row['date'];
$edit = $row['edit'];
$author = $row['author'];
$img = $row['img'];
$str = nl2br($row['text']);
$text = substr($str, 0, 950);

$main = $row['main'];
if($main == '3') { $message = "[статията е главна]"; }
else { $message = "" ; }

list($width, $height) = getimagesize("../$img");
if(($width<$target) and ($height<$target)) { $in = "width='$width' height='$height'"; }
else if (($width > $height) and ($height > $target)) { $percentage = ($target / $width);
$width = round($width * $percentage);
$height = round($height * $percentage);
$in = "width='$width' height='$height'";} 
else { $percentage = ($target / $height); 
$width = round($width * $percentage);
$height = round($height * $percentage);
$in = "width='$width' height='$height'"; }


$info .= "<div id='main-box-header'>$name <div class='boom'>$message</div></div>
	<div id='main-box'><img src='../$img'". $in ."class='pic'>$text... &nbsp;
		<a href='admin.php?q=$q&opt=$id&method=full&issue=$issue' class='text-head'>[разгледай]</a><br /><br /></div>
		<div id='box'>
		<div id='edit'>Инфо:<br /><br />
				Автор: $author<br />Публукуване: $date<br />
				Последна редакция:<br />$edit<br /><br />
				Коментари: 0<br /><br /><a href='admin.php?q=$q&main=edit&opt=$id&issue=$issue' class='text-head'>Редактирай:</a>
		<a href='admin.php?q=$q&main=edit&opt=$id&issue=$issue'><img src='../images/icons/edit.png' border='0' /></a><br /><br />
		<a href='admin.php?q=$q&main=del&opt=$id&issue=$issue' class='text-head'>Изтрий:</a>&nbsp;
		<a href='admin.php?q=$q&main=del&opt=$id&issue=$issue'><img src='../images/icons/x.png' border='0' /></a><br /><br />
		<a href='admin.php?q=$q&main=main&opt=$id&issue=$issue' class='text-head'>Направи главна</a><br /><br />
		<form name='updown' action='$self' method='post' style='margin:0px;'>
		<input name='up[]' type='image' src='../images/icons/up.jpg' />
		<input name='down[]' type='image' src='../images/icons/down.jpg' />
		<input name='number' type='hidden' value='$id' />
		</form></div></div>" ; }	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td><div id="main-head">Арт</div></td>
  </tr>
  <tr>
    <td>
	<div id="content"><?php echo($info); ?>			
	</div></td>
  </tr>
</table>

</body>
</html>

<?php
$self = $_SERVER['PHP_SELF'];
$number = $_POST['number'];

if(isset($HTTP_POST_VARS['up'])) {
$downq = mysql_query("SELECT `id` from `$mysql_table` where `cat` = '$q' and `issue` = '$issue' and `id` > '$number' order by id ASC Limit 1");
while($boom = mysql_fetch_array($downq)){
$up = $boom['id'];}
$change = mysql_query("UPDATE `$mysql_table` set `id` = '0' where `id` = '$number'");
$change = mysql_query("UPDATE `$mysql_table` set `id` = '$number' where `id` = '$up'");
$change = mysql_query("UPDATE `$mysql_table` set `id` = '$up' where `id` = '0'");
echo("<meta http-equiv='refresh' content='0'>");  
}

if(isset($HTTP_POST_VARS['down'])){
$downq = mysql_query("SELECT `id` from `$mysql_table` where `cat` = '$q' and `issue` = '$issue' and `id` < '$number' order by id DESC Limit 1");
while($boom = mysql_fetch_array($downq)){
$down = $boom['id'];}
$change = mysql_query("UPDATE `$mysql_table` set `id` = '0' where `id` = '$number'");
$change = mysql_query("UPDATE `$mysql_table` set `id` = '$number' where `id` = '$down'");
$change = mysql_query("UPDATE `$mysql_table` set `id` = '$down' where `id` = '0'");
echo("<meta http-equiv='refresh' content='0'>");
  }
?>