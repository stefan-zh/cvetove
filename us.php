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
    <td><div id="main-head" style="width:920px">�� ��� </div></td>
  </tr>
  <tr>
    <td>
	<div id="content">
	<div id='full-box'><img src="<?php echo($link); ?>" /><br />
	  <br />
���������� ������� �������� �������� �� ���� ��� �� 29 ������ 2008. ������ �� ����������� �� ������� ������ �� ���� ������ ��������, �� �� ����� ���������� ����� � �����������, �� �� ������ �������� �� ������� � �������. �������� ���� �� ��� �� ���� ��������� ��������������� �������, � ��� ��������� �� �� ������� � ��������� ��� ������ ����� �� ������������ � ����������. ����� ��� ������������������� �� �� ��������� � ������������ ����� �� ���������, �������, ������, ���������, �������� � ������������. ���� ��������� �� ���� ����������� ������� �� ������������ �����, � ����� �������� � �������� �� ����� �� ��� �� ������ � ���� ����� ��������� �� ������� �����, ������������� � ������������!
<br /><br />
���������� �������� �� �� �����: <a href="mailto:cvetove@gmail.com" class="text-head">cvetove@gmail.com</a> ���� ��������� "�������" � ����� �������!<br /><br /><br />
	</div>
		<div id='info'>
		<div id='edit'>���������� �� ��������:<br /><br />
				������: <?php echo($num_articles); ?><br />
				���������: 4<br />
				������: <?php echo($num_issues); ?><br />
				���������: <?php echo($num_count); ?><br />
				��������: <?php echo($imp); ?><br />
				���������: ���� �� ��<br />
				������ �� �����:<br />29 ������ 2008<br />
				�������� ��������:<br />20 ������ 2008<br /></div></div>
	  </div></td>
  </tr>
</table>

</body>
</html>
