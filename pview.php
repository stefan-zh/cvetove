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
 * Избраната статия
 */ 
$articleQuery = "Select * from `articles` where `id` = $id";
$articleQuery = mysql_query($articleQuery);
while($row = mysql_fetch_assoc($articleQuery)) {
   $row['text'] = nl2br($row['text']);
   $article[] = $row;
}
$article = $article[0];

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td>
	<div id="content">
   <div id="full-box-header"><?php echo $article['title']; ?></div>
	<div id="full-box">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
    		<td valign="top" width="285">
			<img src="<?php echo $article['img']; ?>" width="285" height="220" class="pic"></td>
			<td><?php echo $article['text']; ?><br /><br /><br />
	<span class="author">Автор: <?php echo $article['author']; ?></span><br /><br /></td></tr></table></div>
		<div id="info">
		<div id="edit">Инфо:<br /><br />
				Автор: <?php echo $article['author']; ?><br />Публукуване: <?php echo $article['date']; ?><br />
				Последна редакция:<br /><?php echo $article['edit']; ?><br /><br />
		</div></div>
		<div id="info">
		<div id="edit">Други статии от броя:<br /><br />
      <?php foreach($others as $otherTitle): ?>
      <a href="<?php echo $otherTitle['link']; ?>" class="text-head" style="line-height:20px;"><?php echo $otherTitle['title']; ?></a><br /><br />
      <?php endforeach; ?>
      </div></div>   
	</div></td>
  </tr>
</table>