
<?php
session_start();
$link = mysql_connect("localhost", "root", "");
mysql_select_db("sets", $link);
$usname =$_SESSION['current'];
$result = mysql_query("SELECT * FROM user_details where Email = '$usname'", $link);
$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$path=$row['Common_name'];





 



$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
     if (file_exists($path."/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $path."/" . $_FILES["file"]["name"]);
      echo "Stored in: " . $path."/" . $_FILES["file"]["name"];
      }

$type=0;  
  $sql="INSERT INTO cert_details VALUES('$usname','TRUE','$type')";
    
    $retval = mysql_query($sql,$link);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
$zip = new ZipArchive;
if ($zip->open($path.'/download.zip') === TRUE) {
    $zip->deleteName($usname .'.bat');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
  
	  header("location:/user_after_login.php");
	}
?>
