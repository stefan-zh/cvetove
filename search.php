<?php

/**
 * Extract search keys. Delete the "-opt" part from
 * the search 'hidden' field
 */
$category = substr($_POST['hidden'], 0, -4);
$string = $_POST['words'];
$_POST['hidden'] = $category;

if($category != 'all')
   $cat = " AND `cat` = '$category'";
else
   $cat = "";
$searchQuery = "
   SELECT * FROM `articles` 
   WHERE (`title` LIKE '%{$string}%'
   OR `author` LIKE '%{$string}%'
   OR `text` LIKE '%{$string}%')" . $cat . "
   ORDER BY `id` DESC";
$searchQuery = mysql_query($searchQuery);
while($row = mysql_fetch_assoc($searchQuery)){
   $row['link'] = "index.php?q=$row[cat]&id=$row[id]&issue=$issue&method=full";
   $row['text'] = strip_tags($row['text']);
   $row['text'] = mb_substr(nl2br($row['text']), 0, 400, 'UTF-8');
   $results[] = $row;
}

//pretty($results);

   // else { 
		// $i=0;
		// if (!(isset($pagenum))){ $pagenum = 1; } 
		// $page_rows = 100;
		// $query = mysql_query($zaiavka);
		// $rows = mysql_num_rows($query);
		// $last = ceil($rows/$page_rows);
		// if ($pagenum < 1){ $pagenum = 1; }
		// elseif (($pagenum > $last) and ($rows!='0')) { $pagenum = $last; }
		// $max = 'limit ' .($pagenum - 1) * $page_rows .', ' .$page_rows;  
		// $zaiavka .= " $max ";
		// $pagequery = mysql_query($zaiavka);
		// if(!$pagequery){ }
		// else{
		// while($row = mysql_fetch_array($pagequery)){
		// $id = $row['id'];
		// $i=$i+1;
		// $category = $row['cat'];
		// if($category == 'journal'){ $razdel = "журнал"; }
		// if($category == 'poetry'){ $razdel = "поезия"; }
		// if($category == 'fiction'){ $razdel = "проза"; }
		// if($category == 'art'){ $razdel = "арт"; }
		// $issue = $row['issue'];
		// $text = $row['text'];
		// $text = substr($text, 0, 400);
		// if(($text!='-') and ($text != '<p>-</p>')) { $text .= "..."; }
		// else { $text = "фотография"; }
		// $name = $row['name'];
		// if($name == '-'){$name = "фотография"; }
		// $msg .= "		
		// <div class='search_text'>$i. <a href='http://localhost/vestnik/index.php?q=$category&opt=$id&issue=$issue&method=full'>$name</a><br />
		// (категория: $razdel)<br />
		// <span class='search_text_main'>$text</i></b></em></p></span><br />
		// 20 Август 2008
		// </div>";
		// } 
		// }
		// echo("		
		// <div class='search_title'>Търсене за: <b>$str</b><br />
		// Общо намерени: $i резултати. Търси за [ <b>$str</b> ] в <a href='http://www.google.com/search?q=$str' target='_blank'>
		// <img src='http://help2.joomla-bg.com/images/M_images/google.png' alt='Google' name='Google' align='top' border='0'></a>
		// </div>");
		// echo($msg);
		// echo("<div style='margin-bottom:30px'><!-- --></div>");
?>

<div class="search_title">Търсене за: <b><?php echo $string; ?></b><br />
Общо намерени: <?php echo count($results); ?> резултати. Търси за [ <b><?php echo $string; ?></b> ] в <a href="http://www.google.com/search?q=<?php echo $string; ?>" target="_blank">
<img src="images/Googlelogo.png" alt="Google" name="Google" align="top" border="0" height="22"></a>
</div>

<?php foreach($results as $result): ?>
<div class="search_text"><a href="<?php echo $result['link']; ?>"><?php echo $result['title']; ?></a><br />
<?php echo $result['date']; ?> | категория: <?php echo $result['cat']; ?> | автор: <?php echo $result['author']; ?><br /><br />
<span class="search_text_main"><?php echo $result['text']; ?>
</div>
<?php endforeach; ?>