
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
$usname =$_SESSION['current'];
$result = mysql_query("SELECT * FROM ca_details where email_address = '$usname'", $link);
$num_rows = mysql_num_rows($result);


$row = mysql_fetch_array($result);

$dn = array(
    "countryName" => $row['country_name'] ,
    "stateOrProvinceName" => $row['state_name'],
    "localityName" => $row['locality'],
    "organizationName" => $row['organisation_name'],
    "organizationalUnitName" => $row['organisation_unit_name'],
    "commonName" => $row['common_name'],
    "emailAddress" => $row['email_address']
);

// Generate a new private (and public) key pair
$privkey = openssl_pkey_new();

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey);

// You will usually want to create a self-signed certificate at this
// point until your CA fulfills your request.
// This creates a self-signed cert that is valid for 365 days
$sscert = openssl_csr_sign($csr, null, $privkey, 365);

// Now you will want to preserve your private key, CSR and self-signed
// cert so that they can be installed into your web server, mail server
// or mail client (depending on the intended use of the certificate).
// This example shows how to get those things into variables, but you
// can also store them directly into files.
// Typically, you will send the CSR on to your CA who will then issue
// you with the "real" certificate.
$outfilename='/wamp/www/'.$row['common_name'].'-self.crt';


openssl_x509_export($sscert, $certout);
openssl_x509_export_to_file($sscert, $outfilename,true);
openssl_pkey_export($privkey, $pkeyout, "mypassword");
$pp= $row['passphrase'];
$outfilename1='/wamp/www/'.$row['common_name'].'-pkey.key';
openssl_pkey_export_to_file($privkey,$outfilename1, $pp);
// Show any errors that occurred here
while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
	
}
$b=$row['common_name'];
$sql3="update ca_details set Self=1 where common_name='$b'";
if (!mysql_query($sql3,$link))
  {
  die('Error: ' . mysql_error($link));
  }
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
              <?php echo '<a href="ca_after_login.php" >'.$usname.'</a>'?>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
			</ul>
        </div>
      </div>
    </div>
   
<div class="well">
<center>
<form  action="downloading.php" method="post">
<input type="submit" name="download" value="download private key" class="btn btn-primary">
</form>
</center>
</div>
<div class="well">
<center>
<form  action="downloading1.php" method="post">
<input type="submit" name="download1" value="download certificate" class="btn btn-primary">
</form>
</center>
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
