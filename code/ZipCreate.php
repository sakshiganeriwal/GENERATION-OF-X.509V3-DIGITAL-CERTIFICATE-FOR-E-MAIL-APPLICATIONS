<?php
session_start();
$batname=$_SESSION("current");
$con=mysqli_connect("localhost","root","","sets");
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query="select Common_name from user_details where Email= '$batname'";
$result=mysqli_query($con,$query);
$row = mysql_fetch_array($result);
$batname=$row['Common_name'];
$zip = new ZipArchive;

$zipname=$batname."/"."download.zip";
$batname=$batname.".bat";
if ($zip->open($zipname) === TRUE) {
	$zip->addFile($batname, $batname);
	$zip->close();
	echo 'ok';
}
else{
	echo 'failed';
}
?> 