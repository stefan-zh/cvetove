<?php
$red = $_GET['red'];
$issue = $_GET['issue'];
if($red=='1'){ $text="Направихте тази статия главна!"; }
elseif($red=='2'){ $text="Вие изтрихте успешно тази статия!"; }
elseif($red=='edit'){ $text="Вие успешно редактирахте статията!"; }
else { $text="Статията е качена успешно!"; }
echo("<div id='reply-y'>$text<br />
След 2 секунди ще бъдете прехвърлени на заглавната страница!</div>
<meta http-equiv='Refresh'  content='2; url=admin.php?q=journal&issue=$issue'>"); 
?>
