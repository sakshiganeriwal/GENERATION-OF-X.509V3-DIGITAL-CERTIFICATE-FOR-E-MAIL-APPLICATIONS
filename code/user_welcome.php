
<?php
$con=mysqli_connect("localhost","root","","sets");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $t=false;
  // define variables and set to empty values
$passErr=$countrynameErr = $statenameErr = $localityErr = $orgnameErr = $orgunitnameErr = $commonnameErr = $emailErr = $cpasswordErr = $compnameErr = "";
$pass=$countryname = $statename = $locality = $orgname = $orgunitname = $commonname = $email = $cpassword = $compname = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$valid = true;

if (empty($_POST["pass"]))
     {echo $passErr = "passphrase  is required";
	 $valid = false;
	 }
   else
     {
     $pass = test_input($_POST["pass"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$pass))
       {
       $passErr = "Only letters and white space allowed"; 
	  
       }
     }

	 if (empty($_POST["countryname"]))
     {$countrynameErr = "countryname  is required";
	 $valid = false;}
   else
     {
     $countryname = test_input($_POST["countryname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$countryname))
       {
       $countrynameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 if (empty($_POST["statename"]))
     {$statenameErr = "statename  is required";
	 $valid = false;}
   else
     {
     $statename = test_input($_POST["statename"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$statename))
       {
       $statenameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 if (empty($_POST["locality"]))
     {$localityErr = "locality  is required";
	 $valid = false;}
   else
     {
     $locality = test_input($_POST["locality"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$locality))
       {
       $localityErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 if (empty($_POST["orgname"]))
     {$orgnameErr = "orgname  is required";
	 $valid = false;}
   else
     {
     $orgname = test_input($_POST["orgname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$orgname))
       {
       $orgnameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 if (empty($_POST["orgunitname"]))
     {$orgunitnameErr = "orgunitname  is required";
	 $valid = false;}
   else
     {
     $orgunitname = test_input($_POST["orgunitname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$orgunitname))
       {
       $orgunitnameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 if (empty($_POST["commonname"]))
     {$commonnameErr = "commonname  is required";
	 $valid = false;}
   else
     {
     $commonname = test_input($_POST["commonname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$orgunitname))
       {
       $commonnameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
  
   
   if (empty($_POST["email"]))
     {$emailErr = "Email is required";
	 $valid = false;}
   else
     {
     $email = test_input($_POST["email"]);
     // check if e-mail address syntax is valid
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
       {
       $emailErr = "Invalid email format"; 
	   $valid = false;
       }
     }
     
   if (empty($_POST["cpassword"]))
     {$cpasswordErr = "cpassword is required";
	 $valid = false;}
   else
     {
     $cpassword = test_input($_POST["email"]);
	
     
     }
	 
	 if (empty($_POST["compname"]))
     {$compnameErr = "compname  is required";
	 $valid = false;}
   else
     {
     $compname = test_input($_POST["compname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$compname))
       {
       $compnameErr = "Only letters and white space allowed"; 
	   $valid = false;
       }
     }
	 
	 

   
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}



$pass1= $_POST["pass"];
  $pass1 = md5($pass1);
  
 $pass2= $_POST["cpassword"];
  $pass2 = md5($pass2);
  
  $selectquery = "SELECT * FROM user_details WHERE Email='$email'";
$selectresult=mysqli_query($con,$selectquery) or die("query fout".mysql_error());
if(mysqli_num_rows($selectresult))
{
	$t=true;
   echo "email already exists , go back!";
  // header('location:/user_reg.php');
}
else{
  
$countryname=$_POST["countryname"];
$countryname=preg_replace('/\s+/', '_',$countryname);
$statename=$_POST["statename"];
$statename=preg_replace('/\s+/', '_',$statename);
$locality=$_POST["locality"];
$locality=preg_replace('/\s+/', '_',$locality);  
$orgname=$_POST["orgname"];
$orgname=preg_replace('/\s+/', '_',$orgname);
$orgunitname=$_POST["orgunitname"];
$orgunitname=preg_replace('/\s+/', '_',$orgunitname);
$commonname=$_POST["commonname"];
$commonname=preg_replace('/\s+/', '_',$commonname);
$email=$_POST["email"];
$email=preg_replace('/\s+/', '_',$email);
$compname=$_POST["compname"];
$compname=preg_replace('/\s+/', '_',$compname);
$sql="INSERT INTO user_details values('$pass1','$_POST[countryname]','$_POST[statename]','$_POST[locality]','$_POST[orgname]','$_POST[orgunitname]','$_POST[commonname]','$_POST[email]','$pass2','$_POST[compname]')";
$h=$_POST["commonname"];
$filename='C:/wamp/www/'.$h;
mkdir($filename, 0700);
$file = 'download.zip';
$newfile = $h.'/download.zip';

if (!copy($file, $newfile)) {
    echo "failed to copy $file...\n";
}
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  }
    
if($valid)
	 {
	 if(!$t)
	 {
	 header('Location:/index.php');
	  
	 }
	 }
 else{
	if($t)
		header('location:/user_reg.php');
		} 
//header("location:/login.php");
mysqli_close($con);
?>

<!--header("location:/login.php");
mysqli_close($con);
?> -->
