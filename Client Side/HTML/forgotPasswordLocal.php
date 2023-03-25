<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// require '../../vendor/phpmailer/src/Exception.php';
// require '../../vendor/phpmailer/src/PHPMailer.php';
// require '../../vendor/phpmailer/src/SMTP.php';
require '../../vendor/autoload.php';
require_once('connectDB.php');
$mail = new PHPMailer(true);
// code to send email
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
        try{
            // Server settings
            $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'yourname@gmail.com';                     // SMTP username  tried with my gmail credentials but authentication failed.
            $mail->Password   = 'password';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // Recipients
            $mail->setFrom('admin@gpt.com', 'The Boss');
            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $mail->addAddress($to);               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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
