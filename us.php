<?php
include("admin/connect.php");
$sql = mysql_query("Select * from `link`");
while($row = mysql_fetch_array($sql)) {
$link = $row['link'];
$imp = $row['imp'];
}

$articles = mysql_query("Select * from `$mysql_table`");
$num_articles = mysql_num_rows($articles);

$issues = mysql_query("Select * from `$issues`");
$num_issues = mysql_num_rows($issues);

$count = mysql_query("Select * from `$counter`");
$num_count = mysql_num_rows($count);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
</head>


<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="main-head" style="width:920px">За нас </div></td>
  </tr>
  <tr>
    <td>
	<div id="content">
	<div id='full-box'><img src="<?php echo($link); ?>" /><br />
	  <br />
Електронен вестник „Цветове” стартира за пръв път на 29 януари 2008. Идеята за създаването на подобен проект се роди съвсем случайно, но се оказа достатъчно силна и интригуваща, за да сплоти колектив от ученици и учители. „Цветове” няма за цел да бъде еднотипно журналистическо издание, а има амбицията да се развива и разширява във всички сфери на творчеството и познанието. Поели сме предизвикателството да го превърнем в „многоцветен” форум за философия, история, поезия, есеистика, изкуство и журналистика. Нека вестникът да бъде своеобразна трибуна на ученическата мисъл, в която талантът и умението на всеки от нас да творят в ярки шарки картината на реалния живот, въображаемото и абстрактното!
<br /><br />
Изпращайте творбите си на адрес: <a href="mailto:cvetove@gmail.com" class="text-head">cvetove@gmail.com</a> Нека превърнем "Цветове" в нашия вестник!<br /><br /><br />
	</div>
		<div id='info'>
		<div id='edit'>Информация за вестника:<br /><br />
				Статии: <?php echo($num_articles); ?><br />
				Категории: 4<br />
				Броеве: <?php echo($num_issues); ?><br />
				Посещения: <?php echo($num_count); ?><br />
				Импресии: <?php echo($imp); ?><br />
				Редактори: Екип на УС<br />
				Начало на сайта:<br />29 януари 2008<br />
				Последна редакция:<br />20 август 2008<br /></div></div>
	  </div></td>
  </tr>
</table>

</body>
</html>
