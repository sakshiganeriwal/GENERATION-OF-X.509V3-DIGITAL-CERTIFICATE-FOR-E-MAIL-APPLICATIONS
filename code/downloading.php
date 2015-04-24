<?php
session_start();
$con=mysqli_connect("localhost","root","","sets");

// Check connection

if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  $usrname=$_SESSION['current'];
  $sql1="select common_name from ca_details where email_address='$usrname'";
  $result1=mysqli_query($con,$sql1);
  $row2=mysqli_fetch_array($result1);
 $filename=$row2['common_name']."-pkey.key";
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