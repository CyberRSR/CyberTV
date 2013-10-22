<html> 
<head> 
<title>CyberTV</title> 
</head> 
<body> 
<p align='center'>Regist</a></p>

<?php 
$labels = array("login"=>"Login:", 
"pass"=>"password:", ); 

echo "<p align='center'> 
<hr> 
<form action='reg_check.php' method='POST'> 
<table width='95%' border='0' cellspacing='0' cellpadding='2'>\n"; 

foreach($labels as $field => $value) 
{ 
	echo "<tr> 
	<td align='center'> {$labels[$field]} </br><td> 
	<td>
		<input type='text' align='center' name='$field' size='65' maxlength= '65' value= ''></td> 
	</tr>" ;
} 


echo "</table> 
<div align='center'><p><input type='submit' value='Regist'> <div> 
</form>"; 


?>
</body> 
</html> 
