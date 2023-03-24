<?php
require_once('connectDB.php');
//require('config.php');
require('PHPMailer.php');
if(isset($_POST) & !empty($_POST)){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $sql = "SELECT * FROM account WHERE email = '$email'";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);
  if($count == 1){
    $r = mysqli_fetch_assoc($res);
    $password = $r['password'];
    $to = $r['email'];
    $subject = "Your Recovered Password";
    $message = "Please use this password to login " . $password;
    $headers = "From : admin@phpflow.com";
    if(mail($to, $subject, $message, $headers)){
      echo "Your Password has been sent to your email id";
    }else{
      echo "Failed to Recover your password, try again";
    }
  }else{
    echo "Email does not exist in database";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <form id="register-form" role="form" autocomplete="off" class="form" method="post">    
      <div class="form-group">
      <div class="input-group">
        <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
      </div>
      </div>
      <div class="form-group">
      <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
      </div>
      
      <input type="hidden" class="hide" name="token" id="token" value=""> 
    </form>
</div>
</body>
</html>