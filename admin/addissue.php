<?php
include("connect.php");
$godina = date(Y);
$yearLastDig = substr($godina, -2);
$arr = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td><div id="main-head">��� ����</div></td>
  </tr>
  <tr>
    <td>
	<div id="content">
	  <div id="reply-y">
		<?php
		$query = mysql_query("Select `issue` from `issues`");
		while($issues = mysql_fetch_array($query)){
		$issue = $issues['issue'];
		$issueletters = substr($issue, 0, 3);
		$issuenum = substr($issue, -2);
		if($yearLastDig == $issuenum){
		array_push($arr, "$issueletters"); }
		}
		?>
	  <form id="form1" name="form1" method="post" action="<?php echo($self); ?>">
	  <div style="margin-bottom:5px;">�������� �������, �� �� ��������� ��� ����!<br /></div>
	  ��� �� ����: <input name="name" type="text" size="20" />
	  �����: <select name="broi">
	  	<option value="0" selected="selected"></option>
		<?php 
		if(!in_array("jan", $arr)){ echo("<option value='jan'>������</option>"); }
		if(!in_array("feb", $arr)){ echo("<option value='feb'>��������</option>"); }
		if(!in_array("mar", $arr)){ echo("<option value='mar'>����</option>"); }
		if(!in_array("apr", $arr)){ echo("<option value='apr'>�����</option>"); }
		if(!in_array("may", $arr)){ echo("<option value='may'>���</option>"); }
		if(!in_array("jun", $arr)){ echo("<option value='jun'>���</option>"); }
		if(!in_array("jul", $arr)){ echo("<option value='jul'>���</option>"); }
		if(!in_array("aug", $arr)){ echo("<option value='aug'>������</option>"); }
		if(!in_array("sep", $arr)){ echo("<option value='sep'>���������</option>"); }
		if(!in_array("oct", $arr)){ echo("<option value='oct'>��������</option>"); }
		if(!in_array("nov", $arr)){ echo("<option value='nov'>�������</option>"); }
		if(!in_array("dec", $arr)){ echo("<option value='dec'>��������</option>"); }		
		 ?>  
	  </select>
		������: <input name="year" type="text" value="<?php echo($godina); ?>" 
		readonly="true" size="2" /><br />
		<input name="submit" type="submit" class="submit" value="������!" style="margin-top:10px;" />
      </form>
	  </div>
	  <?php
		$self = $_SERVER['PHP_SELF'];
		$name = $_POST['name'];
		$broi = $_POST['broi'];
		$year = $_POST['year'];
		$year = substr($year, -2);
		$broi = $broi.$year;
		if($_REQUEST[submit]){
		$sql = mysql_query("INSERT into `issues` ( issue, name, status ) values ( '$broi' , '$name' , '0' )");
		$message = "<br /><div id='reply-y'>������ ���� � ������� ��������!</div>"; echo($message);
		echo("<meta http-equiv='Refresh'  content='2; url=?q=manager'>"); }
	  ?>
	</div></td>
  </tr>
</table>

</body>
</html>

