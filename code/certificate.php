<?php 
session_start();
$abc= $_SESSION['current'];
echo readfile ('$abc'.'.txt');
?>