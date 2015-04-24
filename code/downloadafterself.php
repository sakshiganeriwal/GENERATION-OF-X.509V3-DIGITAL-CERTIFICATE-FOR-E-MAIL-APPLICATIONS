<?php
session_start();
$con=mysqli_connect("localhost","root","","sets");

// Check connection

if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysql_connect_error();
}
$usname =$_SESSION['current'];
$type=1;  
  $sql="INSERT INTO cert_details VALUES('$usname','TRUE','$type')";
    
    $retval = mysqli_query($con,$sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
header("location:/downloadself.php");
?>