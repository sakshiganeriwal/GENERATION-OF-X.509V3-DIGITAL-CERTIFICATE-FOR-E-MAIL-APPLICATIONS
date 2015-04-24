
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
  $sql1="select Self from ca_details where email_address='$usrname'";
  $result1=mysqli_query($con,$sql1);
  $row2=mysqli_fetch_array($result1);
  $u1=$row2['Self'];


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
              <?php echo '<a href="ca_after_login.php" >'.$usrname.'</a>'?>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="site/logout.php">Logout</a></li>
			</ul>
        </div>
      </div>
    </div>
    <div class="well">
    <center>
    <?php
	  if($u1==1)
 {
echo '<h1><div class="well"><a href= "csrlist_radio.php"><input type="submit" name="csrview" value="View CSRs"></a></div></h1>';

}
else
{
echo '<h1><div class="well"><a href= "ca_self_cert.php"><input type="submit" name="csrgen" value="Generate Self Signed Certificate"></a></div></h1>';
}
    ?>
    </center>
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
