<?php
session_start();
if($_SESSION['type']=='ca'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
$usname=$_SESSION['current'];
$filename=$usname."-self.bat";
//$file=fopen($filename,"x");
$con=mysqli_connect("localhost","root","","sets");
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query="select * from user_details where Email= '$usname'";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$Country=$row['Country_name'];
$State=$row['State_name'];
$Locality=$row['Locality'];
$Organization=$row['Org_name'];
$Unit=$row['Org_unit_name'];
$Common_name=$row['Common_name'];
$pwd=$row['Passphrase'];
file_put_contents($filename,"@echo off\nset path1=%~dp0\ncd bin\nopenssl genrsa -out userkey.pem -passout pass:".$pwd." -des3 2048\nopenssl req -new -key userkey.pem -passin pass:".$pwd." -passout pass:".$pwd." -out csr.pem -days 365 -subj /C=".$Country."/ST=".$State."/L=".$Locality."/O=".$Organization."/OU=".$Unit."/CN=".$Common_name."/emailAddress=".$usname."\nopenssl req -new -x509 -key userkey.pem -passin pass:".$pwd." -passout pass:".$pwd." -out selfcert.crt -days 365 -subj /C=".$Country."/ST=".$State."/L=".$Locality."/O=".$Organization."/OU=".$Unit."/CN=".$Common_name."/emailAddress=".$usname."\ncopy userkey.pem %path1%\ncopy csr.pem %path1%\ncopy selfcert.crt %path1%",FILE_APPEND | LOCK_EX);

//fclose($file);
/*
?>
<?php
$batname=$_SESSION['current'];
$con=mysqli_connect("localhost","root","","sets");
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query="select Common_name from user_details where Email= '$batname'";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
*/
$batname=$row['Common_name'];
$zip = new ZipArchive;

$zipname=$batname."/"."download.zip";
$batname=$filename;
if ($zip->open($zipname) === TRUE) {
	$zip->addFile($batname, $batname);
	$zip->close();
	echo 'ok';
}
else{
	echo 'failed';
}

?>
<html>
<head>
  <meta charset="utf-8">
    <link rel="icon" href="vimeoLogo.png">
    <title>Certificate Generation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-user_selfsigned.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
 <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="user_after_login.php" class="navbar-brand">X.509 Certificate Generation</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <?php echo '<a href="user_after_login.php" >'.$usname.'</a>'?>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
			</ul>
        </div>
      </div>
    </div>
      <p class="bs-component">
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12" align="center">
              <h1 id="buttons">Self-Signed Certificate Generated</h1>
            </div>
          </div>
        </div>
		</div>
 		</p>
        
            <div class="well">
             <div class="well">
          		<center>
            <form class="form-horizontal" action="downloadafterself.php" method="post">
				<fieldset>
				<input type="submit" name="download" value="download here" class="btn btn-primary">
                </fieldset>
			</form>
            </center>
            </div>
             <div class="well">
             <center>
			<form  class="form-horizontal" action="selfsigned_return.php" method="post" >
<input type="submit" name="ual" value="Back" class="btn btn-primary">
</form>
				</center>
               </div>
       </div> 
         <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootswatch.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
        
  </body>
  <?php
mysqli_close($con);
?>
</html>
