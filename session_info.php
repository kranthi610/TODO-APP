<?php
session_start();

if(strpos($_SERVER['REQUEST_URI'], 'dashboard.php')>0 && !isset($_SESSION['user'])){
	header("Location:index.php");
}
if(!(strpos($_SERVER['REQUEST_URI'], 'dashboard.php')>0) && isset($_SESSION['user'])){
	header("Location:dashboard.php");
}

?>