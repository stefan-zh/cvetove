<?php

include("admin/connect.php");

/**
 * Pokazva ot koq godina e zapo4nal vestnika i do
 * koq godina prodaljava. Tozi red se pokazva vav
 * footer-a
 */
function showYearSpan(){
   $begindate = "2008";
   $enddate = date("Y");
   if($begindate == $enddate)
      echo $begindate;
   else 
      echo "$begindate - $enddate";
}

/**
 * Izbira koi broi da pokaje na na4alnata stranica.
 * Ako potrebitelqt vliza za 1 put, pokazva posledniqt broi
 * Ako potrebitelqt e izbral broi ot menuto, togava
 * se pokazva izbraniqt broi.
 */
if(!isset($_GET['issue'])){
   $lastIssueQuery = "SELECT * FROM `issues` ORDER BY `id` DESC LIMIT 1";
   $lastIssueQuery = mysql_query($lastIssueQuery);
   while($select = mysql_fetch_assoc($lastIssueQuery)){
      $issue = $select['issue'];
   }
   header('Location: index.php?issue='.$issue.'');
}
else {
   $issue = $_GET['issue'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/iefix.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="java/pngfix.js"></script>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Цветове | Електронен вестник на ГПЧЕ "Ромен Ролан"</title>
<meta name="resource-type" content="document" />
<meta http-equiv="content-language" content="bg" />
<meta content="Stefan Zhelyazkov" name="author" />
<meta name="copyright" content="Copyright © 2008 Stefan Zhelyazkov and Romain Rolland FLS, All Rights Reserved" />
<meta name="keywords" content="цветове, вестник, електронен вестник, ГПЧЕ Ромен Ролан, журнал, поезия, проза, арт" />
<meta name="description" content="Вестник Цветове - електронен вестник на Гимназия с преподаване на чужди езици Ромен Ролан, град Стара Загора" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="noarchive" />
<link href="css/head.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/options.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/full.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="java/category.js"></script>
<script type="text/javascript" src="java/browserdetect_lite.js"></script>
<script type="text/javascript" src="java/opacity.js"></script>
<script type="text/javascript" src="java/search.js"></script>
</head>

<body>
<div id="wrapper">
<div id="header">
	<div id="logo"></div>
	<div id="slogan"><a href="index.php" target="_self" style="text-decoration:none;">
			<span class="title">Цветове</span></a><br />
	<span class="slogan">eлектронен вестник на ГПЧЕ "Ромен Ролан"</span></div>
			<div id="search">
			<script language="javascript" type="text/javascript">
			od_displayImage('bg_search', 'images/search', 426, 87, '', 'search');</script>
			</div>
				<div id="search-content">
					<div class="search-form">
						<form name="searchForm" id="searchForm" method="get" action="#" onsubmit="return mysql_search(this, 'http://localhost/vestnik/');">
						<input name="hidden" type="hidden" value="option1" />
						<input  name="words" type="text"  class="input" />
						<input name="submit" type="image" src="images/empty.gif" class="button" />
						</form>
				  	</div>
					<div id="options">
			  			<a id="option1" class="optionSelect" onclick="selectOption(this)" href="#">Всички статии</a>
			  			<a id="option2" class="option" onclick="selectOption(this)" href="#">Журнал</a>
			  			<a id="option3" class="option" onclick="selectOption(this)" href="#">Поезия</a>
			  			<a id="option4" class="option" onclick="selectOption(this)" href="#">Проза</a>
			  			<a id="option5" class="option" onclick="selectOption(this)" href="#">Арт</a>
					</div>
				</div>

</div>
<div id="menu">
	<div id="black-box"><a href="?q=journal&issue=<?php echo($issue); ?>" class="menu-text">журнал</a></div>
	<div id="blue-box"><a href="?q=poetry&issue=<?php echo($issue); ?>" class="menu-text">поезия</a></div>
	<div id="green-box"><a href="?q=fiction&issue=<?php echo($issue); ?>" class="menu-text">проза</a></div>
	<div id="red-box"><a href="?q=art&issue=<?php echo($issue); ?>" class="menu-text">арт</a></div>
	<div id="issue">
	  <form id="form1" name="form1" method="post" action="">
	    <label class="select">Избери брой: </label><select name="issue" class="drop-menu" onchange="reload(form1)">
			<?php
			$sql = mysql_query("Select * from `issues` where `status` = '1'");
			while($sel = mysql_fetch_array($sql)) {
            $v = $sel['issue'];
            if($v == $issue) { $p = "selected='selected'"; }
            else { $p = " "; }
            $n = $sel['name'];
            echo("<option value=$v $p>$n</option>"); }
			?>
	    </select>
	  </form>
    </div>
</div>
<div id="body1">
<?php 
		if((!$string) or (!$str)){
		$q = $_GET['q'];
		$method = $_GET['method'];
		if(($q=='') and ($method!='full')) { include("body.php"); }
		if(($q=='journal') and ($method!='full')){ include("review-j.php"); }
		if(($q=='fiction') and ($method!='full')){ include("review-f.php"); }
		if(($q=='poetry') and ($method!='full')){ include("review-p.php"); }
		if(($q=='art') and ($method!='full')){ include("review-a.php"); }
		if(($q!='poetry') and ($q!='art') and ($method=='full')) { include("view.php"); }
		if(($q=='poetry') and ($method=='full')) { include("pview.php"); }
		if(($q=='art') and ($method=='full')) { include("aview.php"); }
		if($q=='us') { include("us.php"); } 
		}
		else { 
		$i=0;
		if (!(isset($pagenum))){ $pagenum = 1; } 
		$page_rows = 100;
		$query = mysql_query($zaiavka);
		$rows = mysql_num_rows($query);
		$last = ceil($rows/$page_rows);
		if ($pagenum < 1){ $pagenum = 1; }
		elseif (($pagenum > $last) and ($rows!='0')) { $pagenum = $last; }
		$max = 'limit ' .($pagenum - 1) * $page_rows .', ' .$page_rows;  
		$zaiavka .= " $max ";
		$pagequery = mysql_query($zaiavka);
		if(!$pagequery){ }
		else{
		while($row = mysql_fetch_array($pagequery)){
		$id = $row['id'];
		$i=$i+1;
		$category = $row['cat'];
		if($category == 'journal'){ $razdel = "журнал"; }
		if($category == 'poetry'){ $razdel = "поезия"; }
		if($category == 'fiction'){ $razdel = "проза"; }
		if($category == 'art'){ $razdel = "арт"; }
		$issue = $row['issue'];
		$text = $row['text'];
		$text = substr($text, 0, 400);
		if(($text!='-') and ($text != '<p>-</p>')) { $text .= "..."; }
		else { $text = "фотография"; }
		$name = $row['name'];
		if($name == '-'){$name = "фотография"; }
		$msg .= "		
		<div class='search_text'>$i. <a href='http://localhost/vestnik/index.php?q=$category&opt=$id&issue=$issue&method=full'>$name</a><br />
		(категория: $razdel)<br />
		<span class='search_text_main'>$text</i></b></em></p></span><br />
		20 Август 2008
		</div>";
		} 
		}
		echo("		
		<div class='search_title'>Търсене за: <b>$str</b><br />
		Общо намерени: $i резултати. Търси за [ <b>$str</b> ] в <a href='http://www.google.com/search?q=$str' target='_blank'>
		<img src='http://help2.joomla-bg.com/images/M_images/google.png' alt='Google' name='Google' align='top' border='0'></a>
		</div>");
		echo($msg);
		echo("<div style='margin-bottom:30px'><!-- --></div>");
 		}
		?>

</div>
<div id="footer">
	<a href="index.php" target="_self" class="foot">Начало</a> | 
	<a href="?q=journal&issue=<?php echo($issue); ?>" target="_self" class="foot">Журнал</a> | 
	<a href="?q=poetry&issue=<?php echo($issue); ?>" target="_self" class="foot">Поезия</a> | 
	<a href="?q=fiction&issue=<?php echo($issue); ?>" target="_self" class="foot">Проза</a> | 
	<a href="?q=art&issue=<?php echo($issue); ?>" target="_self" class="foot">Арт</a> | 
	<a href="index.php?q=us&issue=<?php echo($issue); ?>" target="_self" class="foot">За нас</a> | 
	<a href="http://www.romainrolland.org" class="foot" target="_blank">ГПЧЕ "Ромен Ролан"</a><br />
	<span class="footer">&copy;<?php showYearSpan(); ?> Ученически вестник. Всички права запазени.</span>
</div>
</div>

</body>
</html>