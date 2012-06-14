<?php
include("admin/connect.php");
$issue = $_GET['issue'];
$qqq = "Select * from `$mysql_table` where `main` = 1 and `issue` = '$issue' Limit 1";
$query = mysql_query($qqq);
while($row = mysql_fetch_array($query)) {
$id = $row['id'];
$cat = $row['cat'];
$name = $row['name'];
$img = $row['img'];
$str = nl2br($row['text']);
$text = substr($str, 0, 850);
}
if($text =='') { $err = "Липсва главна новина"; }

//journal review
$jjj = mysql_query("Select * from `$mysql_table` where `cat` = 'journal' and `main` = 0 and `issue` = '$issue' order by `id` DESC Limit 3");
while($box = mysql_fetch_array($jjj)) {
$jcat = $box['cat'];
$idd = $box['id'];
$title = $box['name'];
$txt = $box['text'];
$content = substr($txt, 0, 65);
$ico = $box['ico'];
$jview .= "<div id='article'><a href='?q=$jcat&opt=$idd&issue=$issue&method=full'>
	<img src=$ico width='60' height='60' class='ico' border='0'></a>
	<a href='?q=$jcat&opt=$idd&issue=$issue&method=full' class='text-head'>$title</a><br>
	<div id='text'>$content</b></i></u>...</div></div>";
}

//fiction review
$fff = mysql_query("Select * from `$mysql_table` where `cat` = 'fiction' and `main` = 0 and `issue` = '$issue' order by `id` DESC Limit 3");
while($fbox = mysql_fetch_array($fff)) {
$fcat = $fbox['cat'];
$fid = $fbox['id'];
$fname = $fbox['name'];
$ftxt = $fbox['text'];
$ftext = substr($ftxt, 0, 65);
$fico = $fbox['ico'];
$fview .= "<div id='article'><a href='?q=$fcat&opt=$fid&issue=$issue&method=full'>
	<img src=$fico width='60' height='60' class='ico2' border='0'></a>
	<a href='?q=$fcat&opt=$fid&issue=$issue&method=full' class='text-head'>$fname</a><br>
	<div id='text'>$ftext</b></i></u>...</div></div>";
}

//poetry review
$ppp = mysql_query("Select * from `$mysql_table` where `cat` = 'poetry' and `main` = 2 and `issue` = '$issue' order by `id` Limit 1");
while($pbox = mysql_fetch_array($ppp)) {
$pcat = $pbox['cat'];
$pid = $pbox['id'];
$pname = $pbox['name'];
$pauthor = $pbox['author'];
$ptxt = $pbox['text'];
$ptext = nl2br($ptxt);
		$numWord = 11;
		$poem = explode("<br />",$ptext);
      	for($i=0;$i<=$numWord-1;$i++){
	 	$t .= $poem[$i].'<br />'; }
$pview .="<div id='poem'><a href='?q=$pcat&opt=$pid&issue=$issue&method=full' class='poem-head'>$pname</a><br>
	  <span class='poem-slogan'>($pauthor)</span><br><br />$t</b></i></u>...</div>";
}

//art review
$aaa = mysql_query("Select * from `$mysql_table` where `cat` = 'art' and `main` = 3 and `issue` = '$issue' order by `id` Limit 1");
while($abox = mysql_fetch_array($aaa)) {
$acat = $abox['cat'];
$aid = $abox['id'];
$aname = $abox['name'];
$aauthor = $abox['author'];
$atxt = $abox['text'];
$atext = nl2br($atxt);
$aimg = $abox['img'];


list($width, $height) = getimagesize("$aimg");
$maxheight = 220;
$maxwidth = 293;
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


$aview .="<div id='art'><a href='?q=$acat&opt=$aid&issue=$issue&method=full'>
		<img src='$aimg' ". $n ." class='art' border='0'></a><br>
	  <div id='text' style='text-align:left; padding-left: 4px;'>
	  <a href='?q=$acat&opt=$aid&issue=$issue&method=full' class='text-head'>$aname</a><br />
	  Автор: $aauthor<br /><br />
	  </div>
	</div>";
}

$impressions = mysql_query("Select `imp` from `link`");
while($bow = mysql_fetch_array($impressions)){
$imp = $bow['imp'];
}
$imp = $imp + 1;
$impq = mysql_query("UPDATE `link` set `imp` = '$imp'");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Училищен вестник</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>


<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td colspan="2"><div id="main-head"><?php echo($err); echo($name); ?></div></td>
	<td><div id="heading">Арт</div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><div id="main-box">
		<a href="<?php echo("?q=$cat&opt=$id&issue=$issue&method=full"); ?>">
		<img src="<?php echo($img); ?>" width="285" height="220" class="pic" border="0"></a>
	<?php echo($err); echo($text . "...");
	 if($err) { $readmore = "#"; }else { $readmore = "?q=$cat&opt=$id&issue=$issue&method=full"; } ?>&nbsp;
		<a href="<?php echo($readmore); ?>" class="text-head">[чети още]</a><br /><br /></div></td>
    <td valign="top"><div id="box">
	<?php echo($aview); ?>
    </div></td>
  </tr>
  <tr>
  	<td><div id="heading">Журнал</div></td>
	<td><div id="heading">Поезия</div></td>
	<td><div id="heading">Проза</div></td>
  </tr>
  <tr>
    <td valign="top"><div id="box">
	<?php echo($jview); ?>
    </div></td>
    <td valign="top"><div id="box">
	<?php echo($pview); ?>
    </div></td>
    <td valign="top"><div id="box">
	<?php echo($fview); ?>
	</div></td>
  </tr>
</table>
</body>
