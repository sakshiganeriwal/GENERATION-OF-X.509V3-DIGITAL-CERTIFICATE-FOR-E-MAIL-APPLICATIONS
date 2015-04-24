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
$usname=$_SESSION['current'];
$filename=$_COOKIE["uname"];
$umail=$_COOKIE["usermail"];
set_time_limit(0);
$sql="SELECT * FROM user_details WHERE Email='$umail'";
  $result1=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result1);
  $t=$row['Common_name'];
require 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();

$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';


$mail->Username = "casets9@gmail.com";
$mail->Password = "vitccsets";

$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.

$mail->From = "casets9@gmail.com";
$mail->FromName = "Certificate Authority";
$mail->addAddress($umail,"User 1");
//$mail->addAddress("user.2@gmail.com","User 2");

//$mail->addCC("user.3@ymail.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");

$mail->Subject = "Digital Certificate";
$mail->Body = "Hi,<br /><br />Your digital certificate has been attached.";
$path="C:/wamp/www/".$t."/".$filename;

$mail->AddAttachment($path);

if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";
	header("location:/changecsr.php");
?>