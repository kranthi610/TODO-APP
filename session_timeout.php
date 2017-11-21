<?php
session_start();
$time = time();
if (isset($_SESSION['time']) && ($time-$_SESSION['time']) > 28800){
	echo "0";
}else{
	echo "1";
}

?>
