<html> 
<head> 
<title>CyberTV</title> 
</head> 
<body> 
<p align='center'>Logined</p>

<?php 
$labels = array("login" => "Login:", 
"pass" => "password:",
"md5pass" => "md5pass:"); 

$user = array("login" => "",
"pass" => "", 
"md5pass" => "");

foreach($_POST as $field => $value) 
{ 
	if($field != "submit") 
	{ 		
		$user[$field] = $value;
	} 	
} 

$host = "mysql.xxx.ru"; 
$account = "xxx"; 
$password = "xxx"; 
$dbname = "xxx"; 


if((strlen($user[login]) > 0) && (strlen($user[pass]) > 0))
{
	$connect = mysqli_connect($host, $account, $password); 
	$db = mysqli_select_db($connect, $dbname); 

	$sql = "SELECT * FROM `users` WHERE `login`='$user[login]'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if ($row['pass'] == $user['pass'])
	{
		echo"Login OK<br>\n";
		foreach($row as $field => $value)
		{
			echo"$labels[$field] $value <br>\n";
		}	
	}
	else
	{
		echo"Login ERROR<br>\n";
	}
	
	echo "<br>\n<br>\n<br>\n";
	echo "<form enctype=\"multipart/form-data\"\naction=\"convert_m3u.php\" method=\"POST\">\n<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=1000000\">\n";
	echo "<input type=\"file\" name=\"m3u_file\">\n<input type=\"submit\" value=\"Send file\">\n</form>";
	
	mysqli_close($connect);
}
else 
{
	echo"Login ERROR<br>\n";
}

?>

</body> 
</html> 
