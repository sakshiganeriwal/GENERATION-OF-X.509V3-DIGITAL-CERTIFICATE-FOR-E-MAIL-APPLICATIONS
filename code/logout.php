   <?php
session_destroy();
setcookie("user", "", time()-3600);
header("location:/index.php");
exit();
?>