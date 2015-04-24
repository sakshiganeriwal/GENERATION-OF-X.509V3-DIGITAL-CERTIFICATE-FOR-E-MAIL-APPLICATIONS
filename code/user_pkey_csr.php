<?php
session_start();

$typeErr = $caErr="";
$type = $caname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
 

  if (empty($_POST["CA_name"])) {
    $caErr = "CA name is required";
    echo $caErr;
  } else {
    $caname = test_input($_POST["CA_name"]);
  }
  }
  

 
  function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$username = "root";
$password = "";
$hostname = "localhost"; 
$usname = $_SESSION['current'];
//connection to the database
$dbhandle = mysqli_connect($hostname, $username, $password,"sets") 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

//select a database to work with
//$selected = mysql_select_db("sets",$dbhandle) 
 // or die("Could not select certificate_info");
  
  $sql="INSERT INTO cert_details VALUES('$usname','$caname','TRUE','$type')";
    
    $retval = mysqli_query($dbhandle,$sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";

$usname = $_SESSION['current'];
$result = mysqli_query($dbhandle,"SELECT * FROM user_details where Email = '$usname'");



$row = mysqli_fetch_array($result);
	

  /*echo $row['Country_name'] . " " . $row['State_name'];
  echo "<br>";
  
  $var1=$row['Country_name'];
  var_dump($var1);
  */
// Fill in data for the distinguished name to be used in the cert
// You must change the values of these keys to match your name and
// company, or more precisely, the name and company of the person/site
// that you are generating the certificate for.
// For SSL certificates, the commonName is usually the domain name of
// that will be using the certificate, but for S/MIME certificates,
// the commonName will be the name of the individual who will use the
// certificate.
$dn = array(
    "countryName" => $row['Country_name'] ,
    "stateOrProvinceName" => $row['State_name'],
    "localityName" => $row['Locality'],
    "organizationName" => $row['Org_name'],
    "organizationalUnitName" => $row['Org_unit_name'],
    "commonName" => $row['Common_name'],
    "emailAddress" => $row['Email']
);


// Generate a new private (and public) key pair
$privkey = openssl_pkey_new();

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey);

$outfilename1='/wamp/www/'.$row['Common_name'].'-pkey.key';
$outfilename='/wamp/www/'.$row['Common_name'].'.txt';
$pp=$row['Passphrase'];
openssl_csr_export_to_file($csr, $outfilename,true);
openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump($pkeyout);
openssl_pkey_export_to_file($privkey,$outfilename1, $pp);
?>

<html>
<form  action="download.php" method="post">
<input type="submit" name="download" value="download here">
</form>
</html>
<?php
// Show any errors that occurred here
while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
}
header("location:/user_after_login.php");
?>





 
