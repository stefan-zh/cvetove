<?php

$issue = $_GET['issue'];

/**
 * Съдържание на статии от категория поезия.
 */
$articlesQuery = "Select * from `articles` where `cat` = 'poetry' and `issue` = '$issue' order by `id` DESC";
$articlesQuery = mysql_query($articlesQuery);
while($row = mysql_fetch_assoc($articlesQuery)) {
   $row['text'] = nl2br($row['text']);
   $row['text'] = mb_substr($row['text'], 0, 350, 'UTF-8');
   $row['text'] = closetags($row['text']);
   $row['link'] = "index.php?q=poetry&id=$row[id]&issue=$issue&method=full";
   $articles[] = $row;
}

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td><div id="main-head" style="width:920px;">Поезия</div></td>
  </tr>
  <tr>
    <td>
	<div id="content">
   <?php foreach($articles as $article): ?>
   <div id="full-box-header"><?php echo $article['title']; ?></div>
	<div id="full-box">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
    		<td valign="top" width="285"><img src="<?php echo $article['img']; ?>" width="285" height="220" class="pic"></td>
			<td><?php echo $article['text']; ?>... &nbsp;<br />
		<a href="<?php echo $article['link']; ?>" class="text-head">[чети още]</a><br /><br /></td>
		</tr>
		</table>
		</div>
		<div id="info">
		<div id="edit">Инфо:<br /><br />
				Автор: <?php echo $article['author']; ?><br />Публукуване: <?php echo $article['date']; ?><br />
				Последна редакция:<br /><?php echo $article['edit']; ?><br /><br />
		</div></div>
   <?php endforeach; ?>
   </div></td>
  </tr>
</table>
