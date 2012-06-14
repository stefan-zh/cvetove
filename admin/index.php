<?php
$issue = $_GET['issue'];
if($issue=='addissue') { echo("<meta http-equiv='Refresh'  content='0; url=admin.php?q=addissue'>"); die(); }
$rem = $_COOKIE['remember'];
if($rem=='true'){ echo("<meta http-equiv='Refresh'  content='0; url=admin.php?issue=$issue'>"); die(); }
setcookie('ime','',time()-3600);
setcookie('pass','',time()-3600);
setcookie('remember','',time()-3600);
$status = $_GET['status'];
if($status=='wrong') { $n = "<div id='wrong'>Грешно потребителско име <br />Грешна парола</div>"; }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Административен панел &rsaquo; Вход</title>
<link rel="stylesheet" href="../css/check.css" type="text/css">
<script type="text/javascript">
		function focusit() {
			document.getElementById('user').focus();
		}
		window.onload = focusit;
		
	</script>
</head>

<body class="login">
<div id="login"><h1><a href="http://cvetove.romainrolland.org/" title="Е-вестник Цветове"></a></h1>
<?php echo($n); ?>
  <form name="loginform" id="loginform" action="admin.php" method="post">
	<p>
		<label>Потребителско име:<br />
		<input type="text" name="username" id="user" class="input" size="28" tabindex="10" />
		</label>
	</p>
	<p>
		<label>Парола:<br />
		<input type="password" name="pas" class="input" size="28" tabindex="20" />
		</label>
	</p>
	<p><label><input name="rem" type="checkbox" value="true" onchange="formName.submit()" tabindex="90" />
			Запомняне</label></p>
	<input name="submit" type="submit" id="submit" tabindex="100" value="Вход &raquo;" />
</form>
</div>
<ul class="login">
	<li><a href="../" title="Изгубихте ли се?">Обратно към начална страница</a></li>
	<li><a href="lostpass.php" title="Изгубена парола">Изгубена парола?</a></li>
</ul>
</body>
</html>
