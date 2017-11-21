<?php

$GLOBALS['config'] = array(
	'mysql'=>array(
		'host'=>'localhost',
		'username'=>'root',
		'password'=>'',
		'db'=>'todos'
		)
	);

spl_autoload_register(function ($class){
	include 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';
