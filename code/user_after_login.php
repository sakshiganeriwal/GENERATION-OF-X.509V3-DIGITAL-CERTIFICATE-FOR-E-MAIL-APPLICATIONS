
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="vimeoLogo.png">
    <title>Certificate Generation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css">
    <link href="css/styles.css" rel="stylesheet">
   
  </head>
  
  <?php
session_start();
if($_SESSION['type']=='ca'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
// store session data
$usrname=$_SESSION['current'];
 // Create connection
$con=mysqli_connect("localhost","root","","sets");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql="SELECT * FROM cert_details WHERE username='$usrname'";
  $result1=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result1);
  $t=$row['csr_cert'];
  $sql1="SELECT * FROM user_details WHERE Email='$usrname'";
  $result=mysqli_query($con,$sql1);
  $row1=mysqli_fetch_array($result);
  $t1=$row1['Common_name'];
  $path='C:/wamp/www/'.$t1.'/download.zip';
  $del=$usrname.'.bat';
 $zip = new ZipArchive;
if ($zip->open($path) === TRUE) {
    $zip->deleteName($del);
    $zip->close();
    //echo 'ok';
}
  ?>
  
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
              <?php echo '<a href="user_after_login.php" >'.$usrname.'</a>'?>
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
              <h1 id="buttons">   Select Option</h1>
            </div>
          </div>
        </div>
		</div>
 		</p>
           <p>&nbsp;</p>
           <p class="bs">
             <a href="CreateBat.php"><button type="button" class="btn btn-default btn-lg btn-block" name="generate CSR" <?php if (($t=='0')) echo 'disabled="disabled"'?>>Generate CSR</button></a>
            </p>   
            
         <p class="bs">
             <a href="upload.php"><button type="button" class="btn btn-default btn-lg btn-block" name="upload" <?php if (($t=='0')) echo 'disabled="disabled"'?>>Upload CSR</button></a>
            </p>
           <p class="bs">
               <a href="CreateSelfBat.php"><button type="button" class="btn btn-default btn-lg btn-block" name="generate self-signed certificate" <?php if (($t=='0')) echo 'disabled="disabled"'?>>Generate Self Signed Certificate</button></a>
            </p>

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
