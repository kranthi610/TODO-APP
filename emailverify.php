<?php

require_once 'core/init.php';
DB::getInstance();

if($_GET["token"]!=''){
	Users::emailVerify($_GET["token"]);
}  

?>
