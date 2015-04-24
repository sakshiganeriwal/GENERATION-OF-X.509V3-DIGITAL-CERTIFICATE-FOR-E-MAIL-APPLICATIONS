
 <html>

 <body>
 <?php
ob_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="sets"; // Database name 
$tbl_name="user_details"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die(mysql_error());
echo "Connected to MySQL<br />";
mysql_select_db("$db_name") or die(mysql_error());
echo "Connected to Database<br />";
// Check $username and $password 
/*
if(empty($_POST['username']))
{
    echo "UserName/Password is empty!";
    return false;
}
if(empty($_POST['pass']))
{
    echo "Password is empty!";
    return false;
}
*/

// Define $username and $password 
$username=$_POST['username']; 
$password=$_POST['pass'];


// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$password= md5($password);
$sql="SELECT * FROM $tbl_name WHERE Email='$username' and Challenge_pwd='$password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $username and $password, table row must be 1 row
if ($count==1) {   
session_start();
// store session data
$_SESSION['current']=$username;
$_SESSION['type']='u';
 header("location:/user_after_login.php");	
} 
else {
header("location:/index.php");
	
}

ob_end_flush();
?>
</body>
</html>