<form id="form1" name="myform" action="<?php echo($self); ?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="main-head">�������� �� ������</div></td>
  </tr>
  <tr>
    <td><div id="table-up"><!-- --></div></td>
  </tr>
  <tr>
    <td><div id="askform">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>��������:</td>
          <td width="674"><input name="name" type="text" onkeyup="limiter();" class="input" size="40" />
		  		<span class="lightmarks">�������� �����:</span>
				<script language=javascript>
				document.write("<input name=limit type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count+">");
				</script><br />
		  		<span class="countmarks">���������� ���� �� ���� ����� 2 � 70 �����</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn"><span class="mark">*</span>���������:</td>
          <td width="674"><select name="cat" class="input" onchange="formName.submit();" style="width:100px;">
            <option value="journal">������</option>
            <option value="poetry">������</option>
            <option value="fiction">�����</option>
            <option value="art">���</option>
          </select>          </td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>�����:</td>
          <td width="674"><input name="author" type="text" onkeyup="limiter2();" class="input" size="40" />
		  		<span class="lightmarks">�������� �����:</span>
				<script language=javascript>
				document.write("<input name=limit2 type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count2+">");
				</script><br />
		  		<span class="countmarks">����� ���� �� ���� ����� 2 � 50 �����</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">�����������:</td>
          <td width="674"><input name="img" type="file" size="40" /><br />
		  	<span class="lightmarks">������������ �������: 285�220px</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">������:</td>
          <td width="674"><input name="ico" type="file" size="40" /><br />
		  	<span class="lightmarks">������������ �������: 60�60px</span></td>
        </tr>
        <tr>
          <td width="190" valign="top" class="leftcolumn"><span class="mark">*</span>�����:</td>
          <td width="674">
			<?php include("rteditor.php"); ?><div style="height:10px;"><!-- --></div></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn"><span class="mark">*</span>����:</td>
          <td width="674"><select name="issue" class="input" onchange="formName.submit();" style="width:150px;">
	      	<?php
			$sql = mysql_query("Select * from `$issues`");
			while($sel = mysql_fetch_array($sql)) {
			$v = $sel['issue'];
			if(($v == $issue) and ($q!='addissue')) { $p = "selected='selected'"; }
			else { $p = " "; }
			$n = $sel['name'];
			echo("<option value=$v $p>$n</option>\n"); }
			?>
	    </select></td>
        </tr>	
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div id="table-down">
      <input name="submit" type="submit" id="submit" value="�������" />
	  <input type="reset" name="reset" value="�������" />
    </div></td>
  </tr>
</table>
</form>
<?php
$self = $_SERVER['PHP_SELF'];
$name = $_POST['name'];
$cat = $_POST['cat'];
$date = date("d.m.Y");
$author = $_POST['author'];
$edit = date("H:i� d.m.Y");
$text = $_POST['text'];
$ip = $_SERVER['REMOTE_ADDR'];

if($_REQUEST[submit]){ echo($text); }


/*
$name=str_replace("\"","'",$name);

$text=str_replace("<",'[',$text); 
$text=str_replace(">",']',$text);  
$text=preg_replace("/(\[b\])(.+?)(\[\/b\])/s", "<b>\\2</b>", $text);
$text=preg_replace("/(\[i\])(.+?)(\[\/i\])/s", "<i>\\2</i>", $text);
$text=preg_replace("/(\[u\])(.+?)(\[\/u\])/s", "<u>\\2</u>", $text);
$text=preg_replace("/(\[email=(.+?)\])(.+?)(\[\/email\])/s", '<a href="mailto:\\2" class="text-head" target="_blank">\\3</a>',$text);
$text=preg_replace("/(\[email\])(.+?)(\[\/email\])/s", '<a href="mailto:\\2" class="text-head">\\2</a>', $text);
$text=preg_replace("/(\[url\])(.+?)(\[\/url\])/s", '<a href="\\2" class="text-head" target="_blank">\\2</a>', $text);
$text=preg_replace("/(\[url=\])(.+?)(\[\/url\])/s", '<a href="\\2" class="text-head" target="_blank">\\2</a>', $text);
$text=preg_replace("/(\[url=(.+?)\])(.+?)(\[\/url\])/s", '<a href="\\2" class="text-head" target="_blank">\\3</a>', $text);
$text=preg_replace("/(\[img\])(.+?)(\[\/img\])/s", '<img src="\\2" />', $text);
$text=preg_replace("/(\[img=\])(.+?)(\[\/img\])/s", '<img src="\\2" />', $text);

$pr = $_FILES['img']['name'];
if( $_FILES['img']['name'] !="" )
{ copy ( $_FILES['img']['tmp_name'], "../images/$cat/" . $_FILES['img']['name'] )
   or die( "������ �� ���� �� ���� �������" );}
$img = "images/$cat/$pr";

$ic = $_FILES['ico']['name'];
if( $_FILES['ico']['name'] !="" )
{ copy ( $_FILES['ico']['tmp_name'], "../images/icons/$cat/" . $_FILES['ico']['name'] )
   or die( "������ �� ���� �� ���� �������" );}
$ico = "images/icons/$cat/$ic";

$issue = $_POST['issue'];
if(($_REQUEST[submit]) and ($name!='') and ($text!='')){
$sql = "INSERT INTO `$mysql_table` (`name`, `text`, `cat`, `date`, `author`, `edit`, `img`, `ico`, `issue`, `ip`) values ('$name', '$text', '$cat', '$date', '$author', '$edit', '$img', '$ico', '$issue', '$ip')";
$result = mysql_query($sql);
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle'>");}
elseif(($_REQUEST[submit]) and (($name=='') or ($text==''))) { 
echo ("<div id='reply-n'>�������� �� � ������!<br />
��� ������ ������!</div>"); }
*/
?>
