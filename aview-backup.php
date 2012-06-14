<?php
include("admin/connect.php");
$q = $_GET['q'];
$issue = $_GET['issue'];
$opt = $_GET['opt'];
$method = $_GET['method'];

$titles = mysql_query("Select * from `$mysql_table` where `cat` = '$q' and `id` != $opt and `issue` = '$issue' order by `id` DESC");
while($all = mysql_fetch_array($titles)) {
$id = $all['id'];
$title = $all['name'];
$lines .="<a href='index.php?q=$q&opt=$id&issue=$issue&method=full' class='text-head' style='line-height:20px;'>$title</a><br /><br />"; }
		
$query = mysql_query("Select * from `$mysql_table` where `cat` = '$q' and `id` = $opt and `issue` = '$issue'");
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$name = $row['name'];
$date = $row['date'];
$edit = $row['edit'];
$author = $row['author'];
$img = $row['img'];

if($method == 'full') { $text = nl2br($row['text']); }

list($width, $height) = getimagesize("$img");
$maxheight = 650;
$maxwidth = 650;
$ratio = ($maxwidth / $maxheight);
$divided = ($width / $height);

if(($width<=$maxwidth) and ($height<=$maxheight)) { $n = "width='$width' height='$height'"; }
if(($width>$maxwidth) and ($height<$maxheight)) { $percentage = ($maxwidth / $width);
$width = round($width * $percentage); $height = round($height * $percentage); $n = "width='$width' height='$height'"; }
if(($width<$maxwidth) and ($height>$maxheight)) { $percentage = ($maxheight / $height);
$width = round($width * $percentage); $height = round($height * $percentage); $n = "width='$width' height='$height'"; }

else{
	if($divided<=$ratio) { $percentage = ($maxheight / $height); $width = round($width * $percentage);
						  $height = ($height * $percentage); $n = "width='$width' height='$height'"; }
	else { $percentage = ($maxwidth / $width); $width = round($width * $percentage);
						  $height = ($height * $percentage); $n = "width='$width' height='$height'"; }
}

$info .= "<div id='full-box-header'>$name</div>
	<div id='full-box'><center><img src='$img'". $n . "class='artt'></center>
	$text<br /><br /><br />
	<span class='author'>Автор: $author</span><br /><br /></div>
		<div id='info'>
		<div id='edit'>Инфо:<br /><br />
				Автор: $author<br />Публукуване: $date<br />
				Последна редакция:<br />$edit<br /><br />
				Коментари: 0<br /><br /></div></div>
		<div id='info'>
		<div id='edit'>Предишни творби:<br /><br />$lines<br /></div></div>" ; }
		

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