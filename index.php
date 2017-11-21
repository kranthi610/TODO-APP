
<?php 
include('html_header.php');
require_once 'core/init.php';
$email = '';
DB::getInstance();

if(isset($_POST["login"])){
	$email = $_POST["email"];
	$password = escape($_POST["password"]);
	$result = Users::Login($email,$password);
	if(!$result){
		echo '<div class="container"> <ul> <li class="list-group-item list-group-item-danger">Invalid Credentials</li></ul>';
	}  
}

echo "<h1 class='text-center'>LOGIN</h1>";
include('login.php');
include('html_footer.php');
?>
