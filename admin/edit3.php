<?php
$opt = $_GET['opt'];
$edit = mysql_query("Select * from `$mysql_table` where `id` = '$opt'");
while($row = mysql_fetch_array($edit)){
$name = $row['name'];
$author = $row['author'];
$cat = $row['cat'];
$text = $row['text'];
$img = $row['img'];
$ico = $row['ico'];

$text=preg_replace("/(\<b\>)(.+?)(\<\/b\>)/s", "[b]\\2[/b]", $text);
$text=preg_replace("/(\<i\>)(.+?)(\<\/i\>)/s", "[i]\\2[/i]", $text);
$text=preg_replace("/(\<u\>)(.+?)(\<\/u\>)/s", "[u]\\2[/u]", $text);

$text=preg_replace("/(\<img src=.(.+?). class=.(.+?). \/>)/s", "[img]\\2[/img]", $text);
$text=preg_replace("/(\<a href=.[^mailto].(.+?)...................................\>)(.+?)(\<\/a\>)/s", "[url=ht\\2]\\3[/url]", $text);
$text=preg_replace("/(\<a href=.mailto.(.+?).\>)(.+?)(\<\/a\>)/s", "[email]\\3[/email]", $text);
}
?>
<form id="form1" name="myform" action="<?php echo($self); ?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="main-head">Редактиране на статия</div></td>
  </tr>
  <tr>
    <td><div id="table-up"><!-- --></div></td>
  </tr>
  <tr>
    <td><div id="askform">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>Заглавие:</td>
          <td width="674"><input name="name" value="<?php echo($name); ?>" type="text" onkeyup="limiter();" class="input" size="40" />
		  		<span class="lightmarks">Оставащи знаци:</span>
				<script language=javascript>
				document.write("<input name=limit type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count+">");
				</script><br />
		  		<span class="countmarks">заглавието може да бъде между 2 и 70 знака</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn"><span class="mark">*</span>Категория:</td>
          <td width="674"><select name="cat" class="input" onchange="formName.submit();" style="width:100px;">
            <option value="journal" <?php if($cat=='journal'){ echo("selected='selected'"); } ?> >Журнал</option>
            <option value="poetry" <?php if($cat=='poetry'){ echo("selected='selected'"); } ?>>Поезия</option>
            <option value="fiction" <?php if($cat=='fiction'){ echo("selected='selected'"); } ?>>Проза</option>
            <option value="art" <?php if($cat=='art'){ echo("selected='selected'"); } ?>>Арт</option>
          </select>          </td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>Автор:</td>
          <td width="674"><input name="author" value="<?php echo($author); ?>" type="text" onkeyup="limiter2();" class="input" size="40" />
		  		<span class="lightmarks">Оставащи знаци:</span>
				<script language=javascript>
				document.write("<input name=limit2 type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count2+">");
				</script><br />
		  		<span class="countmarks">името може да бъде между 2 и 50 знака</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">Изображение:</td>
          <td width="674"><input name="img" type="file" size="40" /><br />
		  	<span class="lightmarks">Предпочитани размери: 285х220px</span><br />
			<div id="rem">
			<a class="ToolText" onmouseover="javascript:this.className='ToolTextHover'" 
				onmouseout="javascript:this.className='ToolText'" style="float:left;">Запази предишната картинка
			<span><?php echo($img); if($cat=='art'){ echo("<img src='../$img' width='300' height='225'>"); }
			else { echo("<img src='../$img' >"); }?></span></a>&nbsp;
			<input name="imgcheck" type="checkbox" class="text-head" onchange="formName.submit();" value="1" checked="checked" />
			</div></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">Иконка:</td>
          <td width="674"><input name="ico" type="file" size="40" /><br />
		  	<span class="lightmarks">Предпочитани размери: 60х60px</span><br />
			<div id="rem">
			<a class="ToolText" onmouseover="javascript:this.className='ToolTextHover'" 
				onmouseout="javascript:this.className='ToolText'" style="float:left;">Запази предишната иконка
			<span><?php echo($ico); echo("<img src='../$ico' >");  ?></span></a>&nbsp;
			<input name="icocheck" type="checkbox" class="text-head" onchange="formName.submit();" value="1" checked="checked" />
			</div></td>
        </tr>
        <tr>
          <td width="190" valign="top" class="leftcolumn"><span class="mark">*</span>Текст:</td>
          <td width="674">
		  	<INPUT onclick="b()" type="button" value="B" class="bb">
            <INPUT onClick="i()" type="button" value="I" class="bb">
            <INPUT onClick="u()" type="button" value="U" class="bb">
            <INPUT onClick="url()" type="button" value="Url" class="bb">
			<INPUT onClick="image()" type="button" value="Img" class="bb">
        	<INPUT onClick="email()" type="button" value="Email" class="bb"><br />
			<textarea name="text" cols="80" rows="30" class="input"><?php echo($text); ?></textarea></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn"><span class="mark">*</span>Брой:</td>
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
      <input name="submit" type="submit" value="Изпрати" />
	  <input type="button" name="res" value="Върни промените" onclick="javaScript:location.reload(true)" />
	  <input type="button" name="back" value="Назад"  onClick="javascript: history.go(-1)" />
    </div></td>
  </tr>
</table>
</form>
<?php
$self = $_SERVER['PHP_SELF'];
$name = $_POST['name'];
$cat = $_POST['cat'];
$author = $_POST['author'];
$edit = date("H:iч d.m.Y");
$text = $_POST['text'];
$ip = $_SERVER['REMOTE_ADDR'];

$imgcheck = $_POST['imgcheck'];
$icocheck = $_POST['icocheck'];

$name=str_replace("\"", "'",$name);

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
$text=preg_replace("/(\[img\])(.+?)(\[\/img\])/s", '<img src="\\2" class="zan" />', $text);
$text=preg_replace("/(\[img=\])(.+?)(\[\/img\])/s", '<img src="\\2" class="zan" />', $text);

$pr = $_FILES['img']['name'];
if( $_FILES['img']['name'] !="" )
{ copy ( $_FILES['img']['tmp_name'], "../images/$cat/" . $_FILES['img']['name'] )
   or die( "Файлът не може да бъде копиран" );}
if($imgcheck!='1') { $img = "images/$cat/$pr"; }

$ic = $_FILES['ico']['name'];
if( $_FILES['ico']['name'] !="" )
{ copy ( $_FILES['ico']['tmp_name'], "../images/icons/$cat/" . $_FILES['ico']['name'] )
   or die( "Файлът не може да бъде копиран" );}
if($icocheck!='1') { $ico = "images/icons/$cat/$ic"; }

$issue = $_POST['issue'];
if(($_REQUEST[submit]) and ($name!='') and ($text!='')){
$sql = "UPDATE `$mysql_table` set `name`='$name', `text`='$text', `cat`='$cat', `author`='$author', `edit`='$edit', `img`='$img', `ico`='$ico', `issue`='$issue', `ip`='$ip' where `id`='$opt'";
$result = mysql_query($sql);
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&red=edit&issue=$issue'>");}
elseif(($_REQUEST[submit]) and (($name=='') or ($text==''))) { 
echo ("<div id='reply-n'>Статията не е качена!<br />
Има празни полета!</div>"); }

?>
