<?php 
$params = array("md5pass" => "", "ch_md5" => "");

foreach($_GET as $field => $value) 
{ 		
	$params[$field] = $value;	
} 

$host = "mysql.xxx.ru"; 
$account = "xxxx"; 
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
	
	$sql = "SELECT `views` FROM `users` WHERE `md5pass`='$params[ch_md5]'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new_views = $row[views] + 1;
	$sql = $sql = "UPDATE `users` SET `views`='$new_views' WHERE `md5pass`='$params[ch_md5]'";
	$result = mysqli_query($connect, $sql);
	
	$sql = "SELECT `ch_name`,`ch_url`,`active` FROM `users` WHERE `md5pass`='$params[ch_md5]'";
	$result = mysqli_query($connect, $sql);
	
	while($row = mysqli_fetch_assoc($result))
	{	
		if($row['active'] != 0)
		{			
			header("Location: $row[ch_url]");
			break;
		} 
	}		
}

else echo "ERROR md5pass<br>\n";

mysqli_close($connect);

?>
