<?php
session_start();
if($_SESSION['type']=='ca'){
  session_destroy();
  die("You are trying to access a page you are not permitted to use!");
}
$usrname=$_SESSION['current'];
?><html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="vimeoLogo.png">
    <title>Certificate Generation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-upload.css" media="screen">
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
              <h3 id="buttons">Upload your CSR file here in .pem format:</h3>
            </div>
          </div>
        </div>
		</div>
 		</p>
        <div class="well">
<form action="upload_file.php" method="post"
enctype="multipart/form-data" >
<center>
<label for="file"><h3> Upload:</h3></label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit"  class="btn btn-primary">

</center>
</form>
 </div>
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12" align="center">
				<a href="user_after_login.php"><button type="button" class="btn btn-primary btn-xs">Back</button></a>
                
          </div>
        </div>
	</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootswatch.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
        </body>
</html>