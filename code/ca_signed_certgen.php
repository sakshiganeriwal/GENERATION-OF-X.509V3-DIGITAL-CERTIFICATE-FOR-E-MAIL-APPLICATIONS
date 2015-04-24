
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="vimeoLogo.png">
    <title>Certificate Generation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-ca_after_login.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css">
    <link href="css/styles.css" rel="stylesheet">
   
  </head>
  <?php
session_start();
if($_SESSION['type']=='u'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
$link = mysql_connect("localhost", "root", "");
mysql_select_db("sets", $link);
$usrname_ca =$_SESSION['current'];
$usname=$_POST['cr'];
setcookie ("usermail",$usname);
$sql1="select * from ca_details where email_address='$usrname_ca'";
$result1 = mysql_query($sql1,$link);
$row1=mysql_fetch_array($result1);
$commonCA=$row1['common_name'];
$pp=$row1['passphrase'];
$cacert=$commonCA.'-self.crt';
$CaCertificate=file_get_contents($cacert);


$capk=$commonCA.'-pkey.key';
$privkey1=file_get_contents($capk);
$privkey=openssl_pkey_get_private($privkey1,$pp);
//$privkey=imagecreatefromstring($privkey);
//echo file_get_contents($capk);


//$privkey=array($capk,$pp);



$sql2="select Common_name from user_details where Email='$usname'";
$result2=mysql_query($sql2,$link);
$row2=mysql_fetch_array($result2);
$commonUser=$row2['Common_name'];
$UserCSR=$commonUser.'/csr.pem';
$csr2=file_get_contents($UserCSR);


$sscert = openssl_csr_sign($csr2,$CaCertificate ,$privkey , 365);

$outfilename='/wamp/www/'.$commonUser.'/'.$commonUser.'-certificate.crt';
$outfilename1=$commonUser.'-certificate.crt';


openssl_x509_export($sscert, $certout);// and var_dump($certout);
openssl_x509_export_to_file($sscert, $outfilename,true);
setcookie ("uname",$outfilename1, time() + 3600);

// Show any errors that occurred here
//while (($e = openssl_error_string()) !== false) {
//    echo $e . "\n";
	
	
//}
$sql1="UPDATE cert_details SET csr_cert=1 where email_address='$usrname_ca'";
?>
<body>
   <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="ca_after_login.php" class="navbar-brand">X.509 Certificate Generation</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <?php echo '<a href="ca_after_login.php" >'.$usrname_ca.'</a>'?>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
			</ul>
        </div>
      </div>
    </div>
    <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12" align="center">
    <div class="well">
    <center>
    <form  action="download2.php" method="post">

<input type="submit" name="download2" value="download certificate" class="btn btn-primary">
</form>
</center>
</div>
<div class="well">
<center>
<form  action="send-email.php" method="post">

<input type="submit" name="email" value="send mail" class="btn btn-primary">

</form>
</center>
</div>
</div>
</div>
</div>
</div>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootswatch.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
        
  </body>
  <?php
mysql_close($link);
?>
</html>