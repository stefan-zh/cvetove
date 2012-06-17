<?php

/**
 * Extract search keys. Delete the "-opt" part from
 * the search 'hidden' field
 */
$category = substr($_POST['hidden'], 0, -4);
$string = $_POST['words'];
$_POST['hidden'] = $category;
pretty($_POST);

$cat = $_GET['cat'];
if($cat == 'journal'){
$catstring = "( cat = 'journal' ) and "; }
elseif($cat == 'poetry'){
$catstring = "( cat = 'poetry' ) and "; }
elseif($cat == 'fiction'){
$catstring = "( cat = 'fiction' ) and "; }
elseif($cat == 'art'){
$catstring = "( cat = 'art' ) and "; }
else { $catstring = ''; }
$str = $_GET['string'];
$remove_these = array (',','.','!','`','~','@'.'#','$','%','^','&','*','(',')','-','=','<','>','?','|','/','{','}',':','+','-', '_' );
$str = str_replace ( $remove_these , ' ' , $str );
$str = str_replace ( '  ' , ' ' , $str ); 
$str = trim($str);
$string = explode ( ' ' , $str );
$size = sizeof($string);
if($str!=''){
$zaiavka = 'select * from `articles` where ' .$catstring;
$x = 0;
foreach ( $string as $word ) {
if($x==0){
$zaiavka .= '( text like \'%' . $word . '%\' or name like \'%' . $word . '%\' or author like \'%' . $word . '%\' ';
	$x=1; }
else {
	$zaiavka .= ' or text like \'%' . $word . '%\' or name like \'%' . $word . '%\' or author like \'%' . $word . '%\' '; }
}
$zaiavka .= ') ';
}

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