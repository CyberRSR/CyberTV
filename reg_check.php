<html> 
<head> 
<title>CyberTV</title> 
</head> 
<body> 
<p align='center'>You registered</p>

<?php 
$labels = array("login" => "Login:", 
"pass" => "password:"); 

$user = array("login" => "",
"pass" => "", 
"md5pass" => "");

foreach($_POST as $field => $value) 
{ 
	if($field != "submit") 
	{ 		
		echo"$labels[$field] $value<br>\n"; 
		$user[$field] = $value;
	} 	
} 

$host = "mysql.xxx.ru"; 
$account = "xxx"; 
$password = "xxx"; 
$dbname = "xxx"; 

$connect = mysqli_connect($host, $account, $password); 
$db = mysqli_select_db($connect, $dbname); 

$sql = "SELECT * FROM `users` WHERE `login`='$user[login]'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if((strlen($user[login]) > 0) && (strlen($user[pass]) > 0) && ($row[login] != $user[login]))
{	
	$user[md5pass] = hash('md5', $user[login].$user[pass]);
	$sql = "INSERT INTO users (login, pass, md5pass) VALUES ('$user[login]', '$user[pass]', '$user[md5pass]') "; 
	$result = mysqli_query($connect, $sql);
	echo"md5pass: $user[md5pass]<br>\n"; 
}
else 
{
	echo "Regist ERROR<br>\n";
}

mysqli_close($connect);

?>

</body> 
</html> 
