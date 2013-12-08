<html> 
<head> 
<title>CyberTV</title> 
</head> 
<body> 
<p align='center'>Logined</p>

<?php 
echo "<br>\n<br>\n";
print_r($_FILES);

$uploaddir = './users/';
$uploadfile = $uploaddir . basename($_FILES['m3u_file']['name']);

if (move_uploaded_file($_FILES['m3u_file']['tmp_name'], $uploadfile)) {
    echo "<br>\n<br>\nDownload OK.\n";
} else {
    echo "<br>\n<br>\nERROR!\n";
}

$filename = $_FILES['m3u_file']['name'];

echo "<br>\n<br>\nYour file path: <a href=\"http://cybertv.host-ed.me/users/$filename\">http://cybertv.host-ed.me/users/$filename</a><br>\n";

?>
