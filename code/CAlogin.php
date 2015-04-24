
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
$con=mysqli_connect("localhost","root","","sets");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
    $sql1="select id from ca_details ";
  $result1=mysqli_query($con,$sql1);
  $row2=mysqli_fetch_array($result1);
  $pid=$row2['id'];
?>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand">X.509 Certificate Generation</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li >
              <a href="index.php" >User Login</a>
            </li>
            <li class="active">
              <a href="CAlogin.php">CA Login</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

<!--login modal-->
<div id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">CA Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="checkca.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Email" name="username1">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="pass1">
            </div>
            <div class="form-group">
              <a href= "checkca.php" class="button"><button class="btn btn-primary btn-lg btn-block" name="calogin">Sign In</button></a>
			  
			  <?php if ($pid == null) echo '<span class="pull-right" ><a href="ca_reg.php" name="caregister">Register</a></span><span><a href="#">Need help?</a></span>' ?>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
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
<?php
mysqli_close($con);
?>
  </body>
</html>
