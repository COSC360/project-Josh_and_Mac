<?php
// this file should run on the server alledgedly, also included skeleton for localhost sending but not currently
// accepting credentials
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require '../../vendor/autoload.php';
$mail = new PHPMailer(true);

require_once('connectDB.php');


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
    $headers = "From : admin@gpt.com";  

    $mail->From = "admin@gpt.com"; 
    $mail->FromName = "The Boss"; //To address and name 
    //$mail->addAddress("recepient1@example.com", "Recepient Name");//Recipient name is optional
    $mail->addAddress($to); //Address to which recipient will reply 
    //$mail->addReplyTo("reply@yourdomain.com", "Reply"); //CC and BCC 
    //$mail->addCC("cc@example.com"); 
    //$mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email 
    $mail->isHTML(true); 
    $mail->Subject = "Password Recovery"; 
    $mail->Body = "<i>Here is your current password: ".$password."</i>";
    $mail->AltBody = "This is the plain text version of the email content"; 
    if(!$mail->send()) 
    {
    echo "Mailer Error: " . $mail->ErrorInfo; 
    } 
    else { echo "Message has been sent successfully"; 
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