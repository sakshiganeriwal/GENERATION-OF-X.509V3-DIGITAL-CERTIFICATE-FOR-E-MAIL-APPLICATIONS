<?php
session_start();
if($_SESSION['type']=='u'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
$con=mysqli_connect("localhost","root","","sets");

// Check connection

if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
  $b=$_COOKIE["usermail"];
  $sql="UPDATE cert_details SET csr_cert=1 where username='$b' and csr_cert=0 and type=0";
  $result = mysqli_query($con,$sql);
  
  
 $sql1="SELECT * FROM user_details WHERE Email='$b'";
  $result1=mysqli_query($con,$sql1);
  $row1=mysqli_fetch_array($result1);
  $t=$row1['Common_name'];
  $file='C:/wamp/www/'.$t.'/'.$t.'-certificate.crt';
   
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
   
 header("location:/csrlist_radio.php");
  ?>