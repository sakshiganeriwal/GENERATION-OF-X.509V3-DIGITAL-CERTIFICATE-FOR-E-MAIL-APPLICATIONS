<?php
session_start();
if($_SESSION['type']=='ca'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
$con=mysqli_connect("localhost","root","","sets");

// Check connection

if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  $usrname=$_SESSION['current'];
  $sql1="select Common_name from user_details where Email='$usrname'";
  $result1=mysqli_query($con,$sql1);
  $row2=mysqli_fetch_array($result1);
 $userfile=$row2['Common_name'];
 $filename=$userfile.'/download.zip';
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); // required for certain browsers 
header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

readfile($filename);
exit;

?>
