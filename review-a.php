<?php

$issue = $_GET['issue'];

/**
 * Съдържание с творбите от раздел арт.
 */
$articlesQuery = "Select * from `articles` where `cat` = 'art' and `issue` = '$issue' order by `id` DESC";
$articlesQuery = mysql_query($articlesQuery);
while($row = mysql_fetch_assoc($articlesQuery)) {
   $row['text'] = nl2br($row['text']);
   $row['text'] = mb_substr($row['text'], 0, 950, 'UTF-8');
   $row['link'] = "index.php?q=art&id=$row[id]&issue=$issue&method=full";

   $target = 350;
   list($width, $height) = getimagesize("$row[img]");
   if(($width<$target) and ($height<$target))
      $in = "width='$width' height='$height'";
   else if (($width > $height) and ($height > $target)) {
      $percentage = ($target / $width);
      $width = round($width * $percentage);
      $height = round($height * $percentage);
      $in = "width='$width' height='$height'";
   } 
   else { 
      $percentage = ($target / $height); 
      $width = round($width * $percentage);
      $height = round($height * $percentage);
      $in = "width='$width' height='$height'";
   }

   $row['in'] = $in;
   $articles[] = $row;
}
	
?>

<div id="main-head" style="width:920px; margin-bottom: 10px;">Арт</div>
  
<div id="artwrapper">
<?php foreach($articles as $article): ?>
<div id="art-box"><a href="<?php echo $article['link']; ?>"><img src="<?php echo $article['img']; ?>" <?php echo $article['in']; ?> border="0" class="artpic" /><br />Автор: <?php echo $article['author']; ?><br />Публукуване: <?php echo $article['date']; ?><br />Последна редакция: <?php echo $article['edit']; ?></a></div>
<?php endforeach; ?>
</div>

