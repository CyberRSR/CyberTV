<?php 
$params = array("md5pass" => "");

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
{	/* call in get_ch
	$sql = "SELECT `plays` FROM `users` WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new_plays = $row[plays] + 1;
	$sql = $sql = "UPDATE `users` SET `plays`='$new_plays' WHERE `md5pass`='$params[md5pass]'";
	$result = mysqli_query($connect, $sql);
	*/
	$fh = fopen("cybertv.m3u", "w+");
	fwrite($fh, "#EXTM3U\n");
	
	$sql = "SELECT `ch_name`,`ch_url`,`active`,`md5pass` FROM `users` WHERE 1";
	$result = mysqli_query($connect, $sql);
	
	while($row = mysqli_fetch_assoc($result))
	{	
		if($row['active'] != 0)
		{			
			fwrite($fh, "#EXTINF:-1, $row[ch_name]\n");	
			fwrite($fh, "http://tv.cybertv.zz.mu/get_ch.php?md5pass=$params[md5pass]&ch_md5=$row[md5pass]\n");	
		} 
	}	
	
	fclose($fh);
	header("Location: http://tv.cybertv.zz.mu/cybertv.m3u");
}

else echo "ERROR md5pass<br>\n";

mysqli_close($connect);

?>
