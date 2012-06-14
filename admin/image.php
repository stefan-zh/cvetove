<?php
$server=getenv("HTTP_REFERER");

//���������� �� ���������� ������ �� �������� ��������
define ("MAX_SIZE","10000");
// ����������� ���������� � ���������� �� ������� �����
define ("WIDTH","650");
define ("HEIGHT","650");

//���� � ���������, ����� �� ������� ������� ����� �� �������� �����������
// �������������� �� ���� ��������� ������ ������������ ���������� � ����������,
//�� ��� ����������� �� �������������
function make_thumb($img_name,$filename,$new_w,$new_h)
{
//���������� �� ������������ �� ��������.
$ext=getExtension($img_name);
//������� �� ���� ����������� ����������� ��������� ������� �� GD ������������
if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
$src_img=imagecreatefromjpeg($img_name);

if(!strcmp("png",$ext))
$src_img=imagecreatefrompng($img_name);

if(!strcmp("gif",$ext))
$src_img=imagecreatefromgif($img_name);


//���������� �� ��������������
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);

// ���� ����� �� ������� ���� ������������ �� ������� �����
// � ���������� ������ �� ��������:
// 1. ������� �������������, ���� ������� ������� ������������ � ����.
// 2. ��� �������� � ��-������, �� �� �� ������� �� ���������� ����������
// � ���������� ���� �� �� ������, �� �� �� �� ������� ��������������.
// 3. � �������� ������ �� ���������� ���������� �� �������������
// ���� ������� ��������������.
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

// ��������� ���� �������� � ������ ������������
$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);

// ���������� �������� ����������� �� ������ � ��������� ����
imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

// ��������� ����������� ����������� ��� �����. ���� �� ����� ����� ����� �� ����� $filename
if(!strcmp("png",$ext))
imagepng($dst_img,$filename);
else
imagejpeg($dst_img,$filename);

//��������� ��������� �� �������������.
imagedestroy($dst_img);
imagedestroy($src_img);
}

// ���� ������� ���� ������������ �� �����.
// �� � ���������� �� �������� ���� ����� � ��������.
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}

// ���� ���������� � ���������� ���� ����.
//���������� � �������������� � 0 (����� ���� ������� ������)
//� �� �� ������� �� 1 ��� � �������� ������. ������ ����� ���� �� �� ����.
$errors=0;
// ��������� ����������� ���������� �� �������
if(isset($_POST['Submit']))
{
//������� ����� �� ����� ����� ������������ �����
$image=$_FILES['image']['name'];
// ��� �� � ���� ������
if ($image)
{
// �������� ������������ ���
$filename = stripslashes($_FILES['image']['name']);

// ���������� �� ������������ �� ����� �� ����� ����
$extension = getExtension($filename);
$extension = strtolower($extension);
// ��� � � ���������� ����������, �� ������ ��������� �� ������
// � ����� ���� �� ���� �����.
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
{
echo '<div class="imageUploadTitle">������������ �� � ���������!</div>';
$errors=1;
}
else
{
// ������� �� ������� � �������
// $_FILES[\'image\'][\'tmp_name\'] ���������� ��� �� ����� ������ ����� �� ���� �� �������
list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
$sizekb=filesize($_FILES['image']['tmp_name']);

//�������� �� ���������� ������ � kb � ��������� �� ������ ��� �� �������.
if ($sizekb > MAX_SIZE*10240)
{
echo '<div class="imageUploadTitle">�������� � ������� �� ������!</div>';
$errors=1;
}

//�� ��� �������� ������� � ����� � ����� ����� � UNIX ������� ������
$image_name=time().'.'.$extension;
//���������� �� �� ������ � ������ ��� � ���������� ����� (images �������)
$newname="../images/".$image_name;
$copied = copy($_FILES['image']['tmp_name'], $newname);
//��� ���������� �� ���� �� �� �� ������ ������� ����� �� ������ ������
if (!$copied) { echo '<div class="imageUploadTitle">���������� �� � �������!</div>'; $errors=1; }
else {
// ������ thumbnail �� �� ������ � ����� images/bitplace/
$thumb_name="../images/bitplace/".$image_name;
// ��������� ���������, ����� �� ������� ������ �����������. ��������� �� ������ ���� ���������
// ����� �� �������������, ����� �� ������� ����������� � �������� �������� � ��������.
if(($width < WIDTH) or ($height < WIDTH)){
$thumb=make_thumb($newname,$thumb_name,$width,$height); }
else {
$thumb=make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
} }} }} 

//��� ���� ������ �� �� ������ ��������� "������� ����� � ������� ��������!"
// � �� �� ������� ������� �����
if(isset($_POST['Submit']) && !$errors)
{
if($image_name!=''){
unlink("../images/".$image_name); }
echo '<div align="center">';
if($image_name==''){ echo("<div class='imageUploadTitle'>�� ��� ������� ���� �� �������!</div>"); }
else {
echo "<div class='imageUploadTitle'>��� ������� ������� �������������!</div>";
echo '<img border=0 src="'.$thumb_name.'">';
echo '<br>';
echo '<br>';
echo '<table class="imageUploadFields">';
$server = substr($server, 0, strlen($server)-26);
$thumb_name = substr($thumb_name, -30); 
echo '<tr><td>phpBB/IPB ����</td><td><input class=input type="text" value="[url='.$server.''.$thumb_name.'][img]'.$server.''.$thumb_name.'[/img][/url]" size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '<tr><td>HTML ����</td><td><input class=input type="text" value="<a href='.$server.''.$thumb_name.'><img src='.$server.''.$thumb_name.' border=0></a>" size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '<tr><td>�������� ���� ��� ���������</td><td><input class=input type="text" value="'.$server.''.$thumb_name.'"  size="100" onmouseover="focus();select();" readonly=""></td></tr>';
echo '</table>';
echo '</div>';
}}

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>PHP ��������� �� ����� �����</title>
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
echo("<div class='imageUploadTitle'>�������� ��������</div>");
}
?>
<br>
��������� ����������: jpg, jpeg, png
<br>
<form class=input name="newad" method="post" enctype="multipart/form-data" action="">
<table>
<tr><td><input class=input type="file" name="image" ></td><td><input class=input name="Submit" type="submit" value="����"></td></tr>
</table>
</form>
</div>
</body>
</html> 