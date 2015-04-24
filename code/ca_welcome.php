<?php

 // Create connection
$con=mysqli_connect("localhost","root","","sets");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$err1=$err2=$err3=$err4=$err5=$err6=$err7=$err8=$err9= "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if (empty($_POST["passphrase"]))
    {echo $err1 = "passphrase is required";}
  else
    {$passphrase = test_input($_POST["passphrase"]);
	$passphrase = preg_replace('/\s+/', '_',$passphrase);}

   $country_name = $_POST["country_name"];
   $country_name =preg_replace('/\s+/', '_',$country_name);
   
    if (empty($_POST["state_name"]))
    {echo $err3 = "state name is required";}
   else
   {$state_name =test_input($_POST["state_name"]);
   $state_name =preg_replace('/\s+/', '_',$state_name);}

    if (empty($_POST["locality"]))
    {echo $err4 = "locality is required";}
   else
   {$locality =test_input($_POST["locality"]);
   $locality =preg_replace('/\s+/', '_',$locality);
   }
   
    if (empty($_POST["organisation_name"]))
    {echo $err5 = "organisation name is required";}
   else
   {$organisation_name =test_input($_POST["organisation_name"]);
   $organisation_name =preg_replace('/\s+/', '_',$organisation_name);
   }
   
    if (empty($_POST["organisation_unit_name"]))
    {echo $err6 = "country name is required";}
   else
   {$organisation_unit_name =test_input($_POST["organisation_unit_name"]);
   $organisation_unit_name =preg_replace('/\s+/', '_',$organisation_unit_name);}
   
    if (empty($_POST["common_name"]))
    {echo $err7 = "common name is required";}
   else
   {$common_name =test_input($_POST["common_name"]);
   $common_name =preg_replace('/\s+/', '_',$common_name);}
    
    if (empty($_POST["email_address"]))
    {echo $err8 = "email address is required";}
   else
   {$email_address =test_input($_POST["email_address"]);
   $email_address =preg_replace('/\s+/', '_',$email_address);}
   
    if (empty($_POST["challenge_password"]))
    {echo $err9 = "challenge password is required";}
   else
   {$challenge_password =test_input($_POST["challenge_password"]);}
   $optional_company_name=test_input($_POST["optional_company_name"]);
   $optional_company_name=preg_replace('/\s+/', '_',$optional_company_name);
  } 


function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


mysqli_query($con,"INSERT INTO ca_details VALUES ('true','$passphrase', '$country_name','$state_name','$locality','$organisation_name','$organisation_unit_name','$common_name','$email_address','$challenge_password','$optional_company_name',0)");

header("location:/CAlogin.php");

mysqli_close($con);
?>
