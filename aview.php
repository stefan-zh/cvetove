<?php

$q = $_GET['q'];
$id = $_GET['id'];
$issue = $_GET['issue'];
$method = $_GET['method'];

/**
 * Други статии
 */
$otherTitles = "Select `id`, `title` from `articles` where `cat` = '$q' and `id` != $id and `issue` = '$issue' order by `id` DESC";
$otherTitles = mysql_query($otherTitles);
while($row = mysql_fetch_assoc($otherTitles)) {
   $row['link'] = "index.php?q=$q&id=$row[id]&issue=$issue&method=full";
   $others[] = $row;
}

/**
 * Избраната арт творба
 */ 
$pictureQuery = "Select * from `articles` where `id` = $id";
$pictureQuery = mysql_query($pictureQuery);
while($row = mysql_fetch_assoc($pictureQuery)) {
   if ($row['title'] != '-') { $row['title'] .= " <br /><br />"; }
   else { $row['title'] = ''; }
   if ($row['text'] != '-') { $row['text'] .= " <br />";}
   else { $row['text'] = '';  }
   $row['text'] = nl2br($row['text']);
   $picture[] = $row;
}
$picture = $picture[0];

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td>
	<div id="content">
   <div id="full-box"><center><img src="<?php echo $picture['img']; ?>" class="artt"></center>
	<b><?php echo $picture['title']; ?></b><?php echo $picture['text']; ?>
	<span class="author">Автор: <?php echo $picture['author']; ?></span><br /><br /></div>
		<div id="info">
		<div id="edit">Инфо:<br /><br />
				Автор: <?php echo $picture['author']; ?><br />Публукуване: <?php echo $picture['date']; ?><br />
				Последна редакция:<br /><?php echo $picture['edit']; ?><br /><br />
		</div></div>
		<div id="info">
      <div id="edit">Други творби от броя:<br /><br />
      <?php foreach($others as $otherTitle): ?>
      <a href="<?php echo $otherTitle['link']; ?>" class="text-head" style="line-height:20px;"><?php echo $otherTitle['title']; ?></a><br /><br />
      <?php endforeach; ?>
      </div></div>   
	</div></td>
  </tr>
</table>
