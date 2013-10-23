<?php 
$params = array("md5pass" => "", "ch_path" => "");	

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

if ($row_cnt > 0)
{
	$sql = "SELECT `plays` FROM `users` WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new_plays = $row[plays] + 1;
	$sql = $sql = "UPDATE `users` SET `plays`='$new_plays' WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);
	
	$sql = "SELECT * FROM `users` WHERE `serv_active`=1";
	$result = mysqli_query($connect, $sql);	
	$row_cnt = mysqli_num_rows($result);
	$servnum = mt_rand(0, $row_cnt);
	for ($i = 0; $i <= $servnum; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$t_serv_addr = $row[serv_addr];
	}
	$servchurl = 'http://'.$t_serv_addr.'/'.strrchr($params[ch_path],'pid/');
	
	$sql = "SELECT `views` FROM `users` WHERE `serv_addr`='$t_serv_addr'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new_views = $row[views] + 1;
	$sql = "UPDATE `users` SET `views`='$new_views' WHERE `serv_addr`='$t_serv_addr'";
	$result = mysqli_query($connect, $sql);
	
	header("Location: $servchurl");
		
}

else echo "ERROR md5pass<br>\n";

mysqli_close($connect);

?>
