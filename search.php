<?php
include("admin/connect.php");
$cat = $_GET['cat'];
if($cat == 'journal'){
$catstring = "( cat = 'journal' ) and "; }
elseif($cat == 'poetry'){
$catstring = "( cat = 'poetry' ) and "; }
elseif($cat == 'fiction'){
$catstring = "( cat = 'fiction' ) and "; }
elseif($cat == 'art'){
$catstring = "( cat = 'art' ) and "; }
else { $catstring = ''; }
$str = $_GET['string'];
$remove_these = array (',','.','!','`','~','@'.'#','$','%','^','&','*','(',')','-','=','<','>','?','|','/','{','}',':','+','-', '_' );
$str = str_replace ( $remove_these , ' ' , $str );
$str = str_replace ( '  ' , ' ' , $str ); 
$str = trim($str);
$string = explode ( ' ' , $str );
$size = sizeof($string);
if($str!=''){
$zaiavka = 'select * from `articles` where ' .$catstring;
$x = 0;
foreach ( $string as $word ) {
if($x==0){
$zaiavka .= '( text like \'%' . $word . '%\' or name like \'%' . $word . '%\' or author like \'%' . $word . '%\' ';
	$x=1; }
else {
	$zaiavka .= ' or text like \'%' . $word . '%\' or name like \'%' . $word . '%\' or author like \'%' . $word . '%\' '; }
}
$zaiavka .= ') ';
}
include("index.php");
?>