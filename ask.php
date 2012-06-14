<?php
include("admin/connect.php");
$self = $_SERVER['PHP_SELF'];
$i = 0; //брой прикачени файлове
$nula = 0; //брояч на пълни полета

$to = $reciever;
$ime = $_POST['ime'];
$email = $_POST['email'];
$company = $_POST['company'];
$comment = $_POST['comment'];
$subject = $_POST['subject'];

$email2 = trim($email);
$k_name = "/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+";
$k_host = "([-0-9A-Z]+\.)+";
$k_tlds = "([0-9A-Z]){2,4}$/i";
if( !preg_match($k_name."@".$k_host.$k_tlds, $email2)){ $val=false; }
else { $val=true; }

$num_ime = strlen($ime);
$num_co = strlen($company);
$num_sub = strlen($subject);
$num_com = strlen($comment);

//прикачването:
$pr = $_FILES['file'];
$count = count($pr['name']);

//проверка на полета
if($count!=0){
foreach($pr['name'] as $nomer => $file)
{ $ime_na_fail = $pr['name'][$nomer];
if($ime_na_fail!=''){ $nula = $nula+1; } 
}}
//край на проверка за полета

if(($count!=0) and ($nula!=0)){

$content_type = "mixed";
$var = md5(time());
$granica = "==Multipart_Boundary_x{$var}x";

foreach($pr['name'] as $index => $file) //събира всички полета
{
$file_name = $pr['name'][$index];
$file_name = strtolower($file_name);

//извлича полетата със съдържание
if($file_name!=''){ 		
$tmp_file = $pr['tmp_name'][$index];
$file_type = $pr['type'][$index];
$file_size = filesize($tmp_file);
$sizea = $file_size/1048576;
$sizeb = number_format($sizea, 2);
$sizec = $sizec+$sizeb;

//отваря прикачения файл и го кодира
$fp = fopen($tmp_file, "rb");
$file = fread($fp, $file_size);
fclose($fp);
$data = chunk_split(base64_encode($file));

$attachment .= "--{$granica}\n";
$attachment .= "Content-Type: {$file_type};\n";
$attachment .= " name=\"{$file_name}\"\n";
$attachment .= "Content-Disposition: attachment;\n";
$attachment .= " filename=\"{$file_name}\"\n";
$attachment .= "Content-Transfer-Encoding: base64\n\n";
$attachment .= $data . "\n\n";

$i = $i+1;

}//край на извличането на пълноценни файлове
}//край на проверката на всички полета
$attachment .= "--{$granica}--\n";

}//end if

else { 	//щом проверката е неуспешна, следователно имейла е само текст
$content_type="alternative";
$granica = "==MIME_BOUNDRY_alt_main_message";
}//end else


$html .= "<b>От:</b> $ime<br />";
$html .= "<b>E-mail:</b> <a href='mailto:$email'>$email</a><br />";
$html .= "<b>Организация:</b> $company<br />";
$html .= "<b>Относно:</b> $subject<br />";
$html .= "<br />" . nl2br($comment) . "<br />";

$headers  = "From: $smtp\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/$content_type; charset=\"windows-1251\"\n";
$headers .= "boundary=\"{$granica}\"";

$message  = "This is a multi-part message in MIME format.\n\n";
$message .= "--{$granica}\n";
$message .= "Content-Type: text/html; charset=\"windows-1251\"\n";
$message .= "Content-Transfer-Encoding: 7bit\n\n";
$message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n";
$message .= "<HTML><BODY>\n";
$message .= $html . "\n";
$message .= "</BODY></HTML>\n\n";

//ако прикачените файлове са нула, завършваме простото съобщение
if($i==0){ 
$message .= "--==MIME_BOUNDRY_alt_main_message--\n"; }

//ако обаче имаме пълни полета, довършваме сложното съобщение
else{
$message .= $attachment;
}

if(($ime !='') and ($email != '') and ($subject != '') and ($comment != '') and ($num_ime<266) and ($num_sub>1) and ($num_sub<266) and ($num_com>9) and ($num_co<266) and ($val==true) and ($sizec < 7.5)){
mail($to, $subject, $message, $headers); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>::Technocommerce Ltd::</title>
<link href="style.css" rel="stylesheet" title="style" type="text/css">
<script type="text/javascript" src="add.js"></script>
<script type="text/javascript" src="limiter.js"></script>
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td><table width="1000" align="center" cellpadding="0" cellspacing="0">
      <tr>
    <td width="47" valign="top">&nbsp;</td>
    <td width="209" valign="top"><table width="100%">
      <tr>
        <td valign="top"><table width="199" cellpadding="0" cellspacing="0">
      <tr>
        <td width="199" height="41" background="images/box_head.gif"><table width="195">
          <tr>
            <td width="20"><div align="right"><img src="images/arrow.gif" width="8" height="9" /></div></td>
            <td><p class="menu_head">Technocommerce Ltd.</p></td>
          </tr>
        </table></td>
      </tr>
      <tr id="menu_table">
        <td width="199"><table width="100%" id="menu_table" cellpadding="0" cellspacing="6">
          <tr>
            <td class="menu_links"><a href="us.php" target="_self">Who are we </a></td>
          </tr>
          <tr>
            <td class="menu_links"><a href="contacts.php" target="_self">Contact us </a></td>
          </tr>
          <tr>
            <td class="menu_links"><a href="ask.php" target="_self">Ask a question </a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="195"><img src="images/box_bottom.gif" width="199" height="27" /></td>
      </tr>
    </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="199" cellpadding="0" cellspacing="0">
      <tr>
        <td width="199" height="41" background="images/box_head.gif"><table width="195">
          <tr>
            <td width="20"><div align="right"><img src="images/arrow.gif" width="8" height="9" /></div></td>
            <td><p class="menu_head">Services</p></td>
          </tr>
        </table></td>
      </tr>
      <tr id="menu_table">
        <td width="199"><table width="100%" id="menu_table" cellpadding="0" cellspacing="6">
          <tr>
            <td class="menu_links"><a href="reducers.php" target="_self">Reducers</a></td>
          </tr>
          
          <tr>
            <td class="menu_links"><a href="chains.php" target="_self">Chains</a></td>
          </tr>
          
          <tr>
            <td class="menu_links"><a href="elevators.php" target="_self">Elevators</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="195"><img src="images/box_bottom.gif" width="199" height="27" /></td>
      </tr>
    </table></td>
      </tr>
    </table></td>
    <td width="50">&nbsp;</td>
    <td width="646" valign="top"><div id="lipsum"> 
      <h1>Ask a question</h1>
      <img src="images/line.gif" width="646" height="1" />
	  <p style="padding-top:15px; color:#000000; text-align:right;" >
	  <span class="mark">*</span>Required information</p>
			
			<?php 
			
			if(($_REQUEST[submit]) and ($val==true) and ($ime!='')and($email!='')and($subject!='')and($num_ime<266)
				and ($num_co<266) and ($num_com>9) and ($num_sub>1) and ($num_sub<266) and ($sizeb<7.5))
				{ $error = "<div id='success' align='left'>&bull; Your message is successfully sent!</div>";
				echo($error); }
			if(($_REQUEST[submit]) and ($val==true) and ($ime!='') and ($email!='') and ($subject!='') 
			and ($num_ime<266) and ($num_co<266) and ($num_sub>1) and ($num_sub<266) and ($sizec<7.5)and($sizec!=0.00))
				{ $error = "<div id='success' align='left'>&bull; You have attached $sizec MB to your letter.</div>";
				echo($error); }
			if(($_REQUEST[submit]) and (($email=='') or ($ime=='') or ($subject='') or ($comment=''))){
			 	$error = "<div id='error' align='left'>
				<span class='mark'>&bull;</span> You haven't filled required information!</div>";
			 	echo($error); }			
			if(($_REQUEST[submit]) and ($val==false)){ 
				$error="<div id='error' align='left'><span class='mark'>&bull;</span> 
				You haven't entered a valid e-mail address!</div>"; echo($error); }			
			if(($_REQUEST[submit]) and ($num_sub < 2)){ 
				$error="<div id='error' align='left'><span class='mark'>&bull;</span> 
				The subject should be longer than 2 characters!</div>"; echo($error); }
			if(($_REQUEST[submit]) and (($num_ime > 255) or ($num_co > 255) or ($num_sub > 255))){
				$error = "<div id='error' align='left'><span class='mark'>&bull;</span>
				Some of the information is longer than 255 characters!</div>"; echo($error); }
			if(($_REQUEST[submit]) and ($num_com < 10)){ $error = "<div id='error' align='left'>
				<span class='mark'>&bull;</span> Your message should be longer than 10 characters!</div>"; 
				echo($error); }
			if(($_REQUEST[submit]) and ($sizeb > 7.5)){ $error = "<div id='error' align='left'>
				<span class='mark'>&bull;</span> You should not attach files bigger than 8MB!<br />
				<span class='mark'>&bull;</span> You have attached $sizeb MB</div>"; 
				echo($error); }
								
				?>
				
			<form action="<?php echo($self); ?>" method="post" enctype="multipart/form-data" name="myform" id="form1">
        <div id="updiv"></div>
        <div id="askform">
          <table width="100%">
            <tr>
              <td width="22%" class="leftcolumn"><span class="mark">*</span>Name:</td>
              <td width="78%"><input name="ime" type="text" class="input" size="40" /></td>
            </tr>
            <tr>
              <td width="22%" class="leftcolumn"><span class="mark">*</span>E-mail:</td>
              <td width="78%"><input name="email" type="text" class="input" size="40" /></td>
            </tr>
            <tr>
              <td width="22%" class="leftcolumn">Organization:</td>
              <td width="78%"><input name="company" type="text" class="input" size="40" /></td>
            </tr>
            <tr>
              <td width="22%" class="leftcolumn" valign="top"><span class="mark">*</span>Subject:</td>
              <td width="78%"><input name="subject" type="text" class="input" size="40" />
                <br />
                <span class="countmarks">2-255 characters allowed for the fields above </span></td>
            </tr>
            <tr>
              <td width="22%" class="leftcolumn" valign="top"><span class="mark">*</span>Message:<br />
                <br />
                <span class="lightmarks">Character count:</span>
                <script language=javascript>
				document.write("<input name=limit type=text size=1 tabindex=100 class=lightmarksbox readonly value="+count+">");
				</script></td>
              <td width="78%" rowspan="2"><textarea name="comment" cols="70" rows="20" onkeyup="limiter()" class="input"></textarea><br />
			  <span class="countmarks">10-3000 characters <br />
			  </span><span class="lightmarks">Use words in English or in Bulgarian if it is possible. <br />
Please describe your message details (such as: product specification, company description, etc.) <br />
as clearly as possible to get prompt and precise replies.</span></td>
            </tr>
            <tr>
              <td width="22%" valign="top" class="leftcolumn">&nbsp;</td>
              </tr>
            
            <tr>
              <td width="22%" class="leftcolumn">Attachment:</td>
              <td width="78%"><input name="file[]" type="file" id="file" size="40" /></td>
            </tr>
            <tr>
              <td width="22%">&nbsp;</td>
              <td width="78%" class="countmarks">
			  <div id="add"> </div>
			  <a href="javascript:addEvent()" name="blur">[+] add more fields</a>
			  	<input type="hidden" value="0" id="theValue" /><br />
			  <span class="lightmarks">Maximum upload file size: 8MB. Maximum upload fields allowed: <script language="javascript">document.write(m);</script><br />
			  When upload, we strongly prefer making archives instead of multiple file uploading.</span>
			  </td>
            </tr>
          </table>
		  </div>
          <div id="senddiv"><center>
            <input name="submit" type="submit" class="sendbutton" value="Send" />
          </center>
          </div>
      </form>
      </div></td>
    <td width="46">&nbsp;</td>
  </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="646" valign="top"><?php include("counter.php"); ?></td>
        <td>&nbsp;</td>
      </tr>
</table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
