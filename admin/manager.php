<?php
include("connect.php");
$func = $_GET['func'];
$id = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<script src="facefiles/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo($err); ?>
  <tr>
    <td><div id="main-head">Мениджър броеве</div></td>
  </tr>
  <tr>
    <td>
	<div id="content">
		<?php $notfinished = mysql_query("Select * from `issues`");
while($results = mysql_fetch_array($notfinished)){
$issuename = $results['name'];
$month = $results['issue'];
$status = $results['status'];
echo("<form name='changeIssue' id='changeIssue' method='post' action='$self'>
<div id='managerLine'>
<input name='issuename' value='$issuename' type='text' />
<select name='st' >
		  <option value='1'>активирай</option>
		  <option value='0'>деактивирай</option>
</select>
<input name='month' type='text' readonly='' value='$month' />
<label>активност: <input name='stat' type='text' readonly='' value='$status' size='1' /></label>
<input name='submit' type='submit' class='submit' value='Редактирай!' />
<input id='$month' name='delete' type='submit' class='submit' style='background-color:#EC002F;' value='Изтрий!' />
</div></form>" );
} ?>
<div id="mydiv" style="display:none">
<div class="head">Съобщение</div>
<div class="mainContent">Искате ли да изтриете този брой заедно с цялото му съдържание?</div>
<div class="answerWrapper">
<form id="form1" method="post" action="<?php echo($self); ?>">
<input name="delMonth" type="text" value="<?php echo($month); ?>" style="visibility:hidden;" />
<div class="answer"><a href="<?php echo("?q=manager&func=delete&id=$month"); ?>">Да</a></div>
</form>
<div class="answer"><a href="#" onclick="jQuery(document).trigger('close.facebox');">Не</a></div>
</div><div style="height:10px; float:left; width:200px;"><!-- --></div>
</div>
	  <?php
		$self = $_SERVER['PHP_SELF'];
		$name = $_POST['issuename'];
		$month = $_POST['month'];
		$delete = $_POST['delMonth'];
		$newstatus = $_POST['st'];
		if($_REQUEST[submit]){
		$sql = mysql_query("UPDATE `issues` set `name` = '$name' , `status` = '$newstatus' where `issue` = '$month'");
		$message = "<br /><div id='reply-y'>Редакцията е успешна!</div>
		<meta http-equiv='Refresh'  content='1; url=?q=manager'>"; }
		if($_REQUEST[delete]){
		$sql = mysql_query("DELETE from `issues` where `issue` = '$month'");
		$message = "<br /><div id='reply-y'>Броят е изтрит успешно!</div>
		<meta http-equiv='Refresh'  content='1; url=?q=manager'>"; }
		echo($message); 
	  ?>
	
	</div></td>
  </tr>
</table>


</body>
</html>

