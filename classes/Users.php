 <?php
 require 'sendgrid/vendor/autoload.php';
 class Users{

  public static function checkUserExist($email){
    $query = 'where email="'.$email.'"';
    $result = DB::query('select','users',$query);
    if($result[0]>0){
      return false;
    }
    return true;      
  }

  public static function  Register($name,$email,$phonenumber,$password) {
    if(self::checkUserExist($email)){
      $token = self::createToken();
      $email_link = "<a href='localhost/todo/emailverify.php?token=$token'>Verify your Account</a>";
      $insert_record = "(name,email,phonenumber,password,token,user_verified) VALUES ('$name','$email','$phonenumber','$password','$token',0)";
      DB::query('insert','users',$insert_record);
      self::sendEmail($email,$name,$email_link);
      $_SESSION['user'] = $email;
      header("Location:emailconfirmation.php"); 
      exit();
    }else{
      return "User Already Exists";
    }
  } 

  public static function  Login($email,$password){
    $query = 'where email="'.$email.'"';
    $result = DB::query('select','users',$query);

    if($result[0]>0){
      foreach($result[1]as $row){
        if(!password_verify($password,$row["password"])){
          return false;
        }else{
          $_SESSION['user'] = $email;
          if($row['user_verified']==0){
            header("Location:emailconfirmation.php");
            exit();
          }
          $_SESSION['time'] = time();
          header("Location:dashboard.php"); 
          exit();
        }
      }
    }
    else{
      return false;
    }
  }

  public static function createToken(){
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";  
    $str = '';
    $size = strlen( $chars );
    for( $i = 0; $i < 30; $i++ ) {
      $str= $str.$chars[ rand( 0, $size - 1 ) ];
    }
    $token = uniqid().$str;
    return $token;
  }

  public static function  emailVerify($token){ 
    $query = 'where token="'.$token.'"';
    $result = DB::query('select','users',$query);
    if($result[0]>0){
      foreach($result[1]as $row){
        $id = $row['id'];
        $token = "token=null WHERE id=$id";
        DB::query('update','users',$token);
        $status = "user_verified=1 WHERE id=$id";
        DB::query('update','users',$status);
        $_SESSION['user'] = $email;
        $_SESSION['time'] = time();
        header("Location:dashboard.php");
      }
    }else{
      header("Location:index.php");
    }
  }

  public static function  sendEmail($email,$name,$email_link){
    $from = new SendGrid\Email("TODO App", "no-reply@todo.com");
    $subject = "Verify your TODO APP Management Account";
    $to = new SendGrid\Email($name,$email);
    $content = new SendGrid\Content("text/html","Hi $name,<br>Please verify your TODO App management account.".$email_link);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
  }
}
 

 