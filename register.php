
<?php 
include('html_header.php');
$name = '';
$email = '';
$phonenumber='';
$password_plain='';
require_once 'core/init.php';
DB::getInstance();
if(isset($_POST["register"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phonenumber = escape($_POST["phonenumber"]);
  $password_plain = escape($_POST["password"]);
  $password = password_hash($password_plain, PASSWORD_DEFAULT);

  $validations = array(
    'name'=>array(
      'required'=>true,
      'alphabetic'=>true
      ),
    'email'=>array(
      'required'=>true,
      'email'=>true
      ),
    'phonenumber'=>array(
      'required'=>true,
      'numeric'=>true
      ),
    'password'=>array(
      'required'=>true
      )
	);
  echo '<div class="container">';

  $errors = Validations::validate($_POST,$validations);
  echo "<ul>";
  if(count($errors)>0){
    foreach($errors as $error){
      echo "<li class='list-group-item list-group-item-danger'>$error</li>";
    }
    
  }else{
    echo "<li class='list-group-item list-group-item-danger'>";
    echo Users::Register($name,$email,$phonenumber,$password);
    echo "</li>";
    echo "</ul>";
    echo '</div>';
  }
}

echo "<h1 class='text-center'>SIGNUP</h1>";
include('signupform.php');

include('html_footer.php');
 ?>




