<?php

$issue = $_GET['issue'];

/**
 * ГЛАВНА СТАТИЯ
 * Избиране на заглавната статия.
 */
$mainQuery = "Select * from `articles` where `main` = 1 and `issue` = '$issue' Limit 1";
$mainQuery = mysql_query($mainQuery);
while($row = mysql_fetch_assoc($mainQuery)) {
   $row['link'] = "?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $row['text'] = nl2br($row['text']); 
   $row['text'] = mb_substr($row['text'], 0, 850, 'UTF-8');
   $main[] = $row;
}
$main = $main[0];
if($main['text'] == '') { $main['err'] = "Липсва главна новина"; }


/**
 * ЖУРНАЛ
 * Избира последните три по дата статии за категория журнал.
 */
$mainJournal = "Select * from `articles` where `cat` = 'journal' and `main` = 0 and `issue` = '$issue' order by `id` DESC Limit 3";
$mainJournal = mysql_query($mainJournal);
while($row = mysql_fetch_assoc($mainJournal)) {
   $row['link'] = "?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $row['text'] = mb_substr($row['text'], 0, 65, 'UTF-8');
   $journal[] = $row;
}


/**
 * ПОЕЗИЯ
 * Избира последните три творби по дата от категория поезия.
 */
$mainPoetry = "Select * from `articles` where `cat` = 'poetry' and `main` = 2 and `issue` = '$issue' order by `id` Limit 1";
$mainPoetry = mysql_query($mainPoetry);
while($row = mysql_fetch_assoc($mainPoetry)){
   $row['link'] = "?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $row['text'] = nl2br($row['text']);
	$poem = explode("<br />",$row['text']);
   $numWord = min(count($poem), 11);
   for($i=0; $i< $numWord; $i++)
      $text .= $poem[$i].'<br />';
   $row['text'] = $text;
   $poetry[] = $row;
}
$poetry = $poetry[0];


/**
 * ПРОЗА
 * Избира последните три по дата творби от категория проза.
 */
$mainFiction = "Select * from `articles` where `cat` = 'fiction' and `main` = 0 and `issue` = '$issue' order by `id` DESC Limit 3";
$mainFiction = mysql_query($mainFiction);
while($row = mysql_fetch_assoc($mainFiction)) {
   $row['link'] = "?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $row['text'] = mb_substr($row['text'], 0, 65, 'UTF-8');
   $fiction[] = $row;
}


/**
 * АРТ
 * Избира главната творба в категория арт.
 */
$mainArt = "Select * from `articles` where `cat` = 'art' and `main` = 3 and `issue` = '$issue' order by `id` Limit 1";
$mainArt = mysql_query($mainArt);
while($row = mysql_fetch_assoc($mainArt)) {
   $row['link'] = "?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $art[] = $row;
   
   list($width, $height) = getimagesize("$row[img]");
   $maxheight = 220;
   $maxwidth = 293;
   $ratio = ($maxwidth / $maxheight);
   $divided = ($width / $height);
   
   if(($width<=$maxwidth) and ($height<=$maxheight))
      $n = "width='$width' height='$height'";
   if(($width>$maxwidth) and ($height<$maxheight)) { 
      $percentage = ($maxwidth / $width);
      $width = round($width * $percentage); 
      $height = round($height * $percentage); 
      $n = "width='$width' height='$height'";
   }
   if(($width<$maxwidth) and ($height>$maxheight)) { 
      $percentage = ($maxheight / $height);
      $width = round($width * $percentage); 
      $height = round($height * $percentage); 
      $n = "width='$width' height='$height'";
   }
   else{ 
      if($divided<=$ratio) { 
         $percentage = ($maxheight / $height);
         $width = round($width * $percentage);
         $height = ($height * $percentage);
         $n = "width='$width' height='$height'"; 
      }
      else { 
         $percentage = ($maxwidth / $width);
         $width = round($width * $percentage);
         $height = ($height * $percentage);
         $n = "width='$width' height='$height'"; 
      }
   }
}
$art = $art[0];

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td colspan="2"><div id="main-head"><?php echo $main['err']; echo $main['title']; ?></div></td>
	<td><div id="heading">Арт</div></td>
  </tr>
  <tr>
   <!-- ГЛАВНА НОВИНА -->
    <td colspan="2" valign="top"><div id="main-box">
		<a href="<?php echo $row['link']; ?>">
		<img src="<?php echo $main['img']; ?>" width="285" height="220" class="pic" border="0"></a>
      <?php 
         echo $err; 
         echo $main['text']."...";
         if($err)
            $readmore = "#";
         else $readmore = $main['link'];
      ?>&nbsp;
		<a href="<?php echo($readmore); ?>" class="text-head">[чети още]</a><br /><br /></div></td>
    
    <!-- ГЛАВНА АРТ -->
    <td valign="top"><div id="box">
    <div id='art'><a href='<?php echo $art['link']; ?>'>
		<img src='<?php echo $art['img']; ?>' <?php echo $n; ?> class='art' border='0'></a><br>
	  <div id='text' style='text-align:left; padding-left: 4px;'>
	  <a href='<?php echo $art['link']; ?>' class='text-head'><?php echo $art['title']; ?></a><br />
	  Автор: <?php echo $art['author']; ?><br /><br />
	  </div>
	</div>
    </div></td>
  </tr>
  <tr>
  	<td><div id="heading">Журнал</div></td>
	<td><div id="heading">Поезия</div></td>
	<td><div id="heading">Проза</div></td>
  </tr>
  <tr>
   
   <!-- ЖУРНАЛ -->
   <td valign="top"><div id="box">
	<?php foreach($journal as $jbox): ?>
      <div id='article'><a href='<?php echo $jbox['link']; ?>'>
      <img src='<?php echo $jbox['ico']; ?>' width='60' height='60' class='ico' border='0'></a>
      <a href='<?php echo $jbox['link']; ?>' class='text-head'><?php echo $jbox['title']; ?></a><br>
      <div id='text'><?php echo $jbox['text']; ?></b></i></u>...</div></div>
   <?php endforeach; ?>
   </div></td>
   
   <!-- ПОЕЗИЯ -->
   <td valign="top"><div id="box">
   <div id='poem'><a href='<?php echo $poetry['link']; ?>' class='poem-head'><?php echo $poetry['title']; ?></a><br>
   <span class='poem-slogan'>(<?php echo $poetry['author']; ?>)</span><br><br /><?php echo $poetry['text']; ?></b></i></u>...</div>
   </div></td>
   
   <!-- ПРОЗА -->
   <td valign="top"><div id="box">
	<?php foreach($fiction as $fbox): ?>
   <div id='article'><a href='<?php echo $fbox['link']; ?>'>
   <img src='<?php echo $fbox['ico']; ?>' width='60' height='60' class='ico2' border='0'></a>
   <a href='<?php echo $fbox['link']; ?>' class='text-head'><?php echo $fbox['title']; ?></a><br>
   <div id='text'><?php echo $fbox['text']; ?></b></i></u>...</div></div>
   <?php endforeach; ?>
	</div></td>
  </tr>
</table>
