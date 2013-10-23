
<?php 
$params = array("md5pass" => "", "serv_addr" => "", "serv_active" => "");

foreach($_GET as $field => $value) 
{ 		
		$params[$field] = $value;		
} 

$host = "mysql.xxx.ru"; 
$account = "xxx"; 
$password = "xxx"; 
$dbname = "xxx"; 

$connect = mysqli_connect($host, $account, $password); 
$db = mysqli_select_db($connect, $dbname); 

$sql = "SELECT * FROM `users` WHERE `md5pass`='$params[md5pass]'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$row_cnt = mysqli_num_rows($result);
if (($row_cnt > 0) && (strlen($params[serv_addr]) > 0))
{
	$sql = "UPDATE `users` SET `serv_addr`='$params[serv_addr]', `serv_active`='$params[serv_active]', `serv_active`='$params[serv_active]' WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);	
	
	if ($result == TRUE) echo "server added OK <br>\n";
	else echo "ERROR: add server<br>\n";
}
else
{
	echo "ERROR: md5pass or null_string<br>\n";
}

mysqli_close($connect);

?>
