<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="site/vimeoLogo.png">
    <title>Certificate Generation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="site/css/bootstrap-ca_after_login.css" media="screen">
    <link rel="stylesheet" href="site/css/bootswatch.min.css">
    <link href="site/css/styles.css" rel="stylesheet">
   
  </head>
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
  $usrname=$_SESSION['current'];
  $sql1="select common_name from ca_details where email_address='$usrname'";
  $result1=mysqli_query($con,$sql1);
  $row2=mysqli_fetch_array($result1);
  $u1=$row2['common_name'];
  $sql="SELECT * from cert_details where csr_cert=0 and type=0";
  $result = mysqli_query($con,$sql);
  
  ?>
<body>
   <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="site/user_after_login.php" class="navbar-brand">X.509 Certificate Generation</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <?php echo '<a href="ca_after_login.php" >'.$usrname.'</a>'?>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="site/logout.php">Logout</a></li>
			</ul>
        </div>
      </div>
    </div>
    <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12" align="center">
    			<div class="well">
<form action="ca_signed_certgen.php" method="post">
<?php
$t=0;
while($row = mysqli_fetch_array($result)) {
	
  $a=$row['username'];
$t=1;
  ?><input type="radio" name="cr" value="<?php echo $a?>">
  <?php
  echo $a;
  echo "<br>";
  }
  ?>
  
  <?php
  if($t==1)
  {
echo '<div  align="right"><h1><input type="submit" class="btn btn-primary" name="gencert" value="Generate CSR"></h1></div>';
  }
  else
  {
	  echo 'No pending CSR';
  }
?>

</form>
   </div>
</div>
	</div>
    	</div>
        	</div>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="site/js/bootstrap.min.js"></script>
    <script src="site/js/bootswatch.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="site/js/scripts.js"></script>
        
  </body>
  <?php
mysqli_close($con);
?>

</html>