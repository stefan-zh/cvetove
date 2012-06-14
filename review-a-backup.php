<?php
include("admin/connect.php");
$issue = $_GET['issue'];
$target = 295;
$query = mysql_query("Select * from `$mysql_table` where `cat` = 'art' and `issue` = '$issue' order by `id` DESC");
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$cat = $row['cat'];
$name = $row['name'];
$date = $row['date'];
$edit = $row['edit'];
$author = $row['author'];
$img = $row['img'];
$str = nl2br($row['text']);
$text = substr($str, 0, 950);

list($width, $height) = getimagesize("$img");
if(($width<$target) and ($height<$target)) { $in = "width='$width' height='$height'"; }
else if (($width > $height) and ($height > $target)) { $percentage = ($target / $width);
$width = round($width * $percentage);
$height = round($height * $percentage);
$in = "width='$width' height='$height'";} 
else { $percentage = ($target / $height); 
$width = round($width * $percentage);
$height = round($height * $percentage);
$in = "width='$width' height='$height'"; }

$info .= "
	<div id='full-box'><img src='$img'". $in ."class='pic'>$text... &nbsp;
		<a href='index.php?q=$cat&opt=$id&issue=$issue&method=full' class='text-head'>[разгледай]</a><br /><br /></div>
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
    <td><div id="main-head" style="width:920px">Арт</div></td>
  </tr>
  <tr>
    <td>
	<div id="artcontent"><?php echo($info); ?>			
	</div></td>
  </tr>
</table>

</body>
</html>
