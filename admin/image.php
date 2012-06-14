<?php
$server=getenv("HTTP_REFERER");

//Дефиниране на максимален размер за качената картинка
define ("MAX_SIZE","10000");
// Дефинирайте широчината и височината на малкото копие
define ("WIDTH","650");
define ("HEIGHT","650");

//Това е функцията, която ще създаде малкото копие от каченото изображение
// Оразмеряването ще бъде направено спрямо дефинираните широчината и височината,
//но без деформиране на изображението
function make_thumb($img_name,$filename,$new_w,$new_h)
{
//Получаване на разширението на снимката.
$ext=getExtension($img_name);
//Създава се ново изображение използваики подходяща функция от GD библиотеката
if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
$src_img=imagecreatefromjpeg($img_name);

if(!strcmp("png",$ext))
$src_img=imagecreatefrompng($img_name);

if(!strcmp("gif",$ext))
$src_img=imagecreatefromgif($img_name);


//Получаване на оразмеряването
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);

// след което ще сметнем ново оразмеряване на малкото копие
// в следващите стъпки ще направим:
// 1. Смятаме съотношението, като заменим старото оразмеряване с ново.
// 2. Ако ширината е по-голяма, тя ще се промени до максимално зададената
// и височината така ще се сметне, че да не се развали оразмеряването.
// 3. В противен случай ще използваме височината на изображението
// като запазим оразмеряването.
$ratio1=$old_x/$new_w;
$ratio2=$old_y/$new_h;
if($ratio1>$ratio2) {
$thumb_w=$new_w;
$thumb_h=$old_y/$ratio1;
}
else {
$thumb_h=$new_h;
$thumb_w=$old_x/$ratio2;
}

// Създаваме нова картинка с новото оразмеряване
$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);

// оразмерете голямото изображение на новото и създаваме ново
imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

// Извеждаме създаденото изображение към файла. Сега ще имаме малко копие на файла $filename
if(!strcmp("png",$ext))
imagepng($dst_img,$filename);
else
imagejpeg($dst_img,$filename);

//Разрушава източника на изображението.
imagedestroy($dst_img);
imagedestroy($src_img);
}

// Тази функция чете разширението на файла.
// Тя е използвана да определи дали файла е картинка.
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}

// Тази променлива е използвана като флаг.
//Стойността е инициализирана с 0 (Значи няма открити грешки)
//и ще се промени на 1 ако е намерена грешка. Тогава файла няма да се качи.
$errors=0;
// Проверява предадената информация от формата
if(isset($_POST['Submit']))
{
//Прочита името на файла които потребителят качва
$image=$_FILES['image']['name'];
// Ако не е било празно
if ($image)
{
// получава оригиналното име
$filename = stripslashes($_FILES['image']['name']);

// получаване на разширението на файла на ниско ниво
$extension = getExtension($filename);
$extension = strtolower($extension);
// Ако е с неизвестно разширение, ще изкара съобщение за грешка
// и файла няма да бъде качен.
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
{
echo '<div class="imageUploadTitle">Разширението не е позволено!</div>';
$errors=1;
}
else
{
// Взимане на размера в байтове
// $_FILES[\'image\'][\'tmp_name\'] временното име на файла докато файла се качи на сървъра
list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
$sizekb=filesize($_FILES['image']['tmp_name']);

//Задаване на максимален размер в kb и изкарване на грешка ако се надвиши.
if ($sizekb > MAX_SIZE*10240)
{
echo '<div class="imageUploadTitle">Надвишен е лимитът за размер!</div>';
$errors=1;
}

//за име задаваме времето в което е качен файла в UNIX времеви формат
$image_name=time().'.'.$extension;
//картинката ще се запише с новото име в зададената папка (images папката)
$newname="../images/".$image_name;
$copied = copy($_FILES['image']['tmp_name'], $newname);
//Ако картинката се качи но не се копира малкото копие да изкара грешка
if (!$copied) { echo '<div class="imageUploadTitle">Копирането не е успешно!</div>'; $errors=1; }
else {
// Новият thumbnail ще се намира в папка images/bitplace/
$thumb_name="../images/bitplace/".$image_name;
// извикваме функцията, която ще създаде новото изображение. Функцията ще приеме като аргументи
// името на изображението, името на малкото изображение и желаните широчина и височина.
if(($width < WIDTH) or ($height < WIDTH)){
$thumb=make_thumb($newname,$thumb_name,$width,$height); }
else {
$thumb=make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
} }} }} 

//ако няма грешки ще се изведе съобщение "Малкото копие е успешно създаден!"
// и ще се създаде малкото копие
if(isset($_POST['Submit']) && !$errors)
{
if($image_name!=''){
unlink("../images/".$image_name); }
echo '<div align="center">';
if($image_name==''){ echo("<div class='imageUploadTitle'>Не сте избрали нищо за качване!</div>"); }
else {
echo "<div class='imageUploadTitle'>Вие успешно качихте изображението!</div>";
echo '<img border=0 src="'.$thumb_name.'">';
echo '<br>';
echo '<br>';
echo '<table class="imageUploadFields">';
$server = substr($server, 0, strlen($server)-26);
$thumb_name = substr($thumb_name, -30); 
echo '<tr><td>phpBB/IPB линк</td><td><input class=input type="text" value="[url='.$server.''.$thumb_name.'][img]'.$server.''.$thumb_name.'[/img][/url]" size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '<tr><td>HTML линк</td><td><input class=input type="text" value="<a href='.$server.''.$thumb_name.'><img src='.$server.''.$thumb_name.' border=0></a>" size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '<tr><td>Директен линк към оригинала</td><td><input class=input type="text" value="'.$server.''.$thumb_name.'"  size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '</table>';
echo '</div>';
}}

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>PHP Създаване на малко копие</title>
<script type="text/javascript" src="../java/killbackspace.js"></script>
<style type="text/css">

.imageUpload
{
font-size: 11px;
font-family: "trebuchet ms", helvetica, sans-serif;
color: #8C8C73;
line-height: 18px;
margin-bottom: 20px;

}
.imageUploadTitle
{
font-size: 26px;
margin-top: 10px;
font-family: "trebuchet ms", helvetica, sans-serif;
color: #8C8C73;
line-height: 18px;
font-weight:bold;
text-align:center;
margin-bottom: 10px;
}

.imageUploadFields
{
font-size: 15px;
font-family: "trebuchet ms", helvetica, sans-serif;
color: #8C8C73;
line-height: 18px;
margin-bottom: 20px;

}

input {
color: #000;
text-decoration: none;
background: #F4F3F3;
border: 1px solid #ADAEAF;
font: normal 9pt verdana, arial;
}
input:hover {
background: #F4F3F3;
border: 1px solid #000;
}
</style>
</head>

<body>
<div class="imageUpload" align="center">
<?php 
if(!isset($_POST['Submit'])){
echo("<div class='imageUploadTitle'>Изберете картинка</div>");
}
?>
<br>
Разрешени разширения: jpg, jpeg, png
<br>
<form class=input name="newad" method="post" enctype="multipart/form-data" action="">
<table>
<tr><td><input class=input type="file" name="image" ></td><td><input class=input name="Submit" type="submit" value="Качи"></td></tr>
</table>
</form>
</div>
</body>
</html> 