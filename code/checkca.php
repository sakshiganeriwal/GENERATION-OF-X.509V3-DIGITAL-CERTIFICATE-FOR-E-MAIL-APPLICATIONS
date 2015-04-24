<?php
ob_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="sets"; // Database name 
$tbl_name="ca_details"; // Table name

//CHANGE TO MYSQLI
$dbd=mysqli_connect($host, $username, $password,"sets") 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";



// Define $username and $password 
$username2=$_POST['username1']; 
$password2=$_POST['pass1'];


// To protect MySQL injection (more detail about MySQL injection)
$username2 = stripslashes($username2);
$password2 = stripslashes($password2);
$username2 = mysql_real_escape_string($username2);
$password2 = mysql_real_escape_string($password2);

$sql="SELECT * FROM $tbl_name WHERE email_address='$username2' and challenge_password='$password2'";
$result=mysqli_query($dbd,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
// If result matched $username and $password, table row must be 1 row
if ($count==1) {
	 session_start();
// store session data
$_SESSION['current']=$username2;
$_SESSION['type']='ca';
	header("location:/ca_after_login.php");
}
 else {
   header("location:/CAlogin.php");
	
}

ob_end_flush();
?>