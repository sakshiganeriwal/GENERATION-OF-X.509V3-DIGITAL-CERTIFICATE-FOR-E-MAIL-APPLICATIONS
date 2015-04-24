<?php
session_start();
$usname=$_SESSION['current'];
$zip = new ZipArchive;
if ($zip->open($path.'/download.zip') === TRUE) {
    $zip->deleteName($usname .'-self.bat');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
  
header("location:/user_after_login.php");
?>