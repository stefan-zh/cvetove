<?php
$red = $_GET['red'];
$issue = $_GET['issue'];
if($red=='1'){ $text="���������� ���� ������ ������!"; }
elseif($red=='2'){ $text="��� �������� ������� ���� ������!"; }
elseif($red=='edit'){ $text="��� ������� ������������ ��������!"; }
else { $text="�������� � ������ �������!"; }
echo("<div id='reply-y'>$text<br />
���� 2 ������� �� ������ ����������� �� ���������� ��������!</div>
<meta http-equiv='Refresh'  content='2; url=admin.php?q=journal&issue=$issue'>"); 
?>
