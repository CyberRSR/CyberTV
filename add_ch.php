
<?php 
$params = array("md5pass" => "", "ch_name" => "", "ch_url" => "", "active" => "");

foreach($_POST as $field => $value) 
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
if (($row_cnt > 0) && (strlen($params[ch_name]) > 0) && (strlen($params[ch_url]) > 0))
{
	if ($params['active'] == 1) $row[urls_added]++;
	$sql = "UPDATE `users` SET `ch_name`='$params[ch_name]', `ch_url`='$params[ch_url]', `urls_added`='$row[urls_added]', `active`='$params[active]' WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);
	
	if ($result == TRUE) echo "ch added OK <br>\n";
	else echo "ERROR: add<br>\n";
}
else
{
	echo "ERROR: md5pass or null_string<br>\n";
}

mysqli_close($connect);

?>
