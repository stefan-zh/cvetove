<?php
include("admin/connect.php");
$issue = $_GET['issue'];
$query = mysql_query("Select * from `$mysql_table` where `cat` = 'journal' and `issue` = '$issue' order by `id` DESC");
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$name = $row['name'];
$date = $row['date'];
$edit = $row['edit'];
$author = $row['author'];
$img = $row['img'];
$str = nl2br($row['text']);
$text = substr($str, 0, 950);

$info .= "<div id='full-box-header'>$name</div>
	<div id='full-box'><img src='$img' width='285' height='220' class='pic'>$text</b></i></u>... &nbsp;
		<a href='index.php?q=journal&opt=$id&issue=$issue&method=full' class='text-head'>[чети още]</a><br /><br /></div>
		<div id='info'>
		<div id='edit'>Инфо:<br /><br />
				Автор: $author<br />Публукуване: $date<br />
				Последна редакция:<br />$edit<br /><br />
				Коментари: 0<br /><br /></div></div>" ; }	
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
    <td><div id="main-head" style="width:920px">Журнал</div></td>
  </tr>
  <tr>
    <td>
	<div id="content"><?php echo($info); ?>			
	</div></td>
  </tr>
</table>

</body>
</html>
