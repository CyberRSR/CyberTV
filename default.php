<html> 
<head> 
<title>CyberTV</title> 
</head> 
<body> 
<p align='center'>Login or <a href="reg.php">regist</a>. <a href="install.rar">INSTALL</a> or <a href="exe.rar">exe</a>.     <a href="http://forum.cybertv.zz.mu">Forum</a></p>
<p align='center'><a href="https://github.com/CyberRSR/CyberTVaceproxyMod">CyberTVaceproxyMod</a></p>

<?php 
$labels = array("login"=>"Login:", 
"pass"=>"password:", ); 

echo "<p align='center'> 
<hr> 
<form action='login_check.php' method='POST'> 
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
<div align='center'><p><input type='submit' value='Login'> <div> 
</form>"; 

echo "<br>\n";

$host = "mysql.xxx.ru"; 
$account = "xxx"; 
$password = "xxx"; 
$dbname = "xxx"; 

$connect = mysqli_connect($host, $account, $password); 
$db = mysqli_select_db($connect, $dbname); 

$sql = "SELECT * FROM `users` WHERE 1";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$row_cnt = mysqli_num_rows($result);
echo "Users: $row_cnt<br>\n";

$sql = "SELECT * FROM `users` WHERE `active`=1";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$row_cnt = mysqli_num_rows($result);
echo "Chanels: $row_cnt<br>\n";

$sql = "SELECT * FROM `users` WHERE 1";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_assoc($result))
{
	$plays += $row['plays'];
}
echo "Plays: $plays<br>\n";

echo "<br>\n<br>\nActive chanels / Views:<br>\n";
$sql = "SELECT * FROM `users` WHERE `active`=1";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "$row[ch_name] / $row[views]<br>\n";
}

echo "<br>\n<br>\nUsers / Plays:<br>\n";
$sql = "SELECT * FROM `users` WHERE 1";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "$row[login] / $row[plays]<br>\n";
}

mysqli_close($connect);

?>
</body> 
</html> 
