<?php
$self = $_SERVER['PHP_SELF'];

$mail = $_POST['mail'];
$pass = $_POST['pass'];
if((($mail!='cvetove@gmail.com') or ($pass!='cvetoverr')) and ($_REQUEST[submit])) 
{ $n = "<div id='wrong'>������ ����� ��� ������!</div>"; }
else if($_REQUEST[submit]) {
$n = "<div id='wrong'>������������� ���: s.council<br />������: 1as35m</div>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>��������������� ����� &rsaquo; ����</title>
<link rel="stylesheet" href="../css/check.css" type="text/css">
<script type="text/javascript">
		function focusit() {
			document.getElementById('user').focus();
		}
		window.onload = focusit;
		
	</script>
</head>

<body class="login">
<div id="login"><h1><a href="http://cvetove.romainrolland.org/" title="�-������� �������"></a></h1>
<?php echo($n); ?>
  <form name="loginform" id="loginform" action="<?php echo($self); ?>" method="post">
	<p>
		<label>E-mail:<br />
		<input type="text" name="mail" id="user" value="cvetove@gmail.com" class="input" size="28"  />
		</label>
	</p>
	<p>
		<label>������:<br />
		<input name="pass" type="password" class="input" size="28" />
		</label>
	</p><div style="height:10px;"><!-- --></div>
	<input name="submit" type="submit" id="submit" value="�������!" />
</form>
</div>
<ul class="login">
	<li><a href="http://cvetove.romainrolland.org/" title="��������� �� ��?">������� ��� ������� ��������</a></li>
	<li><a href="index.php" title="����">����</a></li>
</ul>
</body>
</html>
