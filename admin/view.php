<?php
include("connect.php");
$issue = $_GET['issue'];
$q = $_GET['q'];
$opt = $_GET['opt'];
$method = $_GET['method'];

//previous news
$titles = mysql_query("Select * from `$mysql_table` where `cat` = '$q' and `id` != $opt and `issue` = '$issue' order by `id` DESC");
while($all = mysql_fetch_array($titles)) {
$id = $all['id'];
$title = $all['name'];
$lines .="<a href='admin.php?q=$q&opt=$id&method=full&issue=$issue' class='text-head' style='line-height:20px;'>$title</a><br /><br />"; }
//-->
		
$query = mysql_query("Select * from `$mysql_table` where `id` = $opt and `issue` = '$issue'");
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$name = $row['name'];
$date = $row['date'];
$edit = $row['edit'];
$author = $row['author'];
$img = $row['img'];

if($method == 'full') { $text = nl2br($row['text']); }

//няма главна новина
$qq = "Select * from `$mysql_table` where `main` = '1' and `issue` = '$issue'";
$req = mysql_query($qq);
$rr = mysql_fetch_array($req);
$main = $rr['main'];
if($main=='') { 
$err="<tr><td><div id='reply-n'>Няма главна новина!<br />
Моля, изберете някоя новина за главна!$main</div></td></tr>"; }
//-->

$info .= "<div id='main-box-header'>$name</div>
	<div id='main-box'><img src='../$img' width='285' height='220' class='pic'>$text<br /><br /><br />
	<span class='author'>Автор: $author</span><br /><br /></div>
		<div id='box'>
		<div id='edit' >Инфо:<br /><br />
				Автор: $author<br />Публукуване: $date<br />
				Последна редакция:<br />$edit<br /><br />
				Коментари: 0<br /><br /><a href='admin.php?q=$q&main=edit&opt=$id&issue=$issue' class='text-head'>Редактирай:</a>
		<a href='admin.php?q=$q&main=edit&opt=$id&issue=$issue'><img src='../images/icons/edit.png' border='0' /></a><br /><br />
		<a href='admin.php?q=$q&main=del&opt=$id&issue=$issue' class='text-head'>Изтрий:</a>&nbsp;
		<a href='admin.php?q=$q&main=del&opt=$id&issue=$issue'><img src='../images/icons/x.png' border='0' /></a><br /><br />
		<a href='admin.php?q=$q&main=main&opt=$id&issue=$issue' class='text-head'>Направи главна</a><br /><br />
				</div></div>
		<div id='box'>
		<div id='edit'>Предишни статии:<br /><br />$lines<br /></div>" ; }
		

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
    <td>
	<div id="content"><?php echo($info); ?>			
	</div></td>
  </tr>
</table>

</body>
</html>
