<script type="text/javascript">
var lastDiv = "";
function showDiv(divName) {
	// hide last div
	if (lastDiv) {
		document.getElementById(lastDiv).className = "hiddenDiv";
	}
	//if value of the box is not nothing and an object with that name exists, then change the class
	if (divName && document.getElementById(divName)) {
		document.getElementById(divName).className = "visibleDiv";
		lastDiv = divName;
	}
}
</script>
<style type="text/css" media="screen">
.hiddenDiv {
	display: none;
	}
.visibleDiv {
	display: block;
	}

</style>
<form id="form1" name="myform" action="<?php echo($self); ?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="main-head">Добавяне на статия</div></td>
  </tr>
  <tr>
    <td><div id="table-up"><!-- --></div></td>
  </tr>
  <tr>
    <td><div id="askform">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>Заглавие:</td>
          <td width="674"><input name="name" type="text" onkeyup="limiter();" class="input" size="40" />
		  		<span class="lightmarks">Оставащи знаци:</span>
				<script language=javascript>
				document.write("<input name=limit type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count+">");
				</script><br />
		  		<span class="countmarks">заглавието може да бъде между 2 и 70 знака</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn"><span class="mark">*</span>Категория:</td>
          <td width="674"><select name="cat" class="input" onchange="showDiv(this.value);formName.submit();" style="width:100px;">
		  	<option></option>
            <option value="journal">Журнал</option>
            <option value="poetry">Поезия</option>
            <option value="fiction">Проза</option>
            <option value="art">Арт</option>
          </select>
</td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top"><span class="mark">*</span>Автор:</td>
          <td width="674"><input name="author" type="text" onkeyup="limiter2();" class="input" size="40" />
		  		<span class="lightmarks">Оставащи знаци:</span>
				<script language=javascript>
				document.write("<input name=limit2 type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count2+">");
				</script><br />
		  		<span class="countmarks">името може да бъде между 2 и 50 знака</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">Изображение:</td>
          <td width="674">
		  <input id="journal" name="imgJournal" type="file" size="40" class="hiddenDiv" />
		  <input id="poetry" name="imgPoetry" type="file" size="40" class="hiddenDiv" />
		  <input id="fiction" name="imgFiction" type="file" size="40" class="hiddenDiv" />
		  <input id="art" name="imgArt" type="text" class="hiddenDiv" onmouseover="focus();select();" value="въведете линк към изображението" size="39" />
		  	<span class="lightmarks">Предпочитани размери: 285х220px</span><br />
			<span class="lightmarks">За да качите изображения на сървъра, ползвайте <a href="?q=addimage" target="_blank">библиотеката</a>.</span></td>
        </tr>
        <tr>
          <td width="190" class="leftcolumn" valign="top">Иконка:</td>
          <td width="674"><input name="ico" type="file" size="40" /><br />
		  	<span class="lightmarks">Предпочитани размери: 60х60px</span></td>
        </tr>
        <tr>
          <td width="190" valign="top" class="leftcolumn"><span class="mark">*</span>Текст:</td>
          <td width="674">
			<?php include("rteditor.php"); ?><div style="height:10px;"><!-- --></div></td>
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
      <input name="submit" type="submit" id="submit" value="Изпрати" />
	  <input type="reset" name="reset" value="Изчисти" />
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
$edit = date("H:iч d.m.Y");
$text = $_POST['text'];
$ip = $_SERVER['REMOTE_ADDR'];
$imgArt = $_POST['imgArt'];
$imgArt = substr($imgArt, -30);

$name=str_replace("\"","'",$name);

if($cat=='journal'){
$pr = $_FILES['imgJournal']['name'];
if( $_FILES['imgJournal']['name'] !="" )
{ copy ( $_FILES['imgJournal']['tmp_name'], "../images/$cat/" . $_FILES['imgJournal']['name'] )
   or die( "Файлът не може да бъде копиран" );}
$img = "images/$cat/$pr";}

if($cat=='poetry'){
$pr = $_FILES['imgPoetry']['name'];
if( $_FILES['imgPoetry']['name'] !="" )
{ copy ( $_FILES['imgPoetry']['tmp_name'], "../images/$cat/" . $_FILES['imgPoetry']['name'] )
   or die( "Файлът не може да бъде копиран" );}
$img = "images/$cat/$pr";}

if($cat=='fiction'){
$pr = $_FILES['imgFiction']['name'];
if( $_FILES['imgFiction']['name'] !="" )
{ copy ( $_FILES['imgFiction']['tmp_name'], "../images/$cat/" . $_FILES['imgFiction']['name'] )
   or die( "Файлът не може да бъде копиран" );}
$img = "images/$cat/$pr";}

if($cat=='art'){ $img = $imgArt; }


if(($cat=='journal') or ($cat=='fiction')){
$ic = $_FILES['ico']['name'];
if( $_FILES['ico']['name'] !="" )
{ copy ( $_FILES['ico']['tmp_name'], "../images/icons/$cat/" . $_FILES['ico']['name'] )
   or die( "Файлът не може да бъде копиран" );}
$ico = "images/icons/$cat/$ic";
}

$issue = $_POST['issue'];

if(($_REQUEST[submit]) and ($cat=='')){
echo("<br /><div id='reply-n'>Не сте избрали категория!</div>");
}

if(($_REQUEST[submit]) and ($name!='') and ($text!='') and ($cat!='')){
$sql = "INSERT INTO `$mysql_table` (`name`, `text`, `cat`, `date`, `author`, `edit`, `img`, `ico`, `issue`, `ip`) values ('$name', '$text', '$cat', '$date', '$author', '$edit', '$img', '$ico', '$issue', '$ip')";
$result = mysql_query($sql);
echo ("<meta http-equiv='Refresh'  content='0; url=admin.php?q=middle&issue=$issue'>");}
elseif(($_REQUEST[submit]) and (($name=='') or ($text=='') or ($cat==''))) { 
echo ("<div id='reply-n'>Статията не е качена!<br />
Има празни полета!</div>"); }
?>
