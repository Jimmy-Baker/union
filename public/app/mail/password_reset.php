<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'><title>Password Reset Requested</title><meta name='description' content='Click on the included link to reset your password.'><meta name='author' content='Union Climbing'><meta name='viewport' content='width=device-width, initial-scale=1'><style type='text/css'></style></head><body><header><h1>Union Climbing</h1></header><main><p>Hi {$user->preferred_name},</p><p>A password reset was requested for your Union account. If this was not done by you, you can safely disregard this email. To proceed, click the link below. This code will expire in 5 mintues.</p><a href='https://www.unionclimbing.com/app/restore.php?email={$user->email}&key={$key}'>Reset Your Password</a></main></body></html>";

$mail = new PHPMailer(true);
try {
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = 'smtp.hostinger.com';
  $mail->Port = 465;
  $mail->SMTPAuth = true;
  $mail->Username = 'noreply@unionclimbing.com';
  $mail->Password = 'CptP@ncr34s';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  
  $mail->setFrom('noreply@unionclimbing.com', 'Union Climbing');
  $mail->addAddress('baker.jimmy@gmail.com');
  $mail->Subject = 'Testing PHPMailer';

  $mail->isHTML(true);
  $mail->Subject = 'Password Reset';
  $mail->Body = $message;
  
  $mail->send();

} catch (Exception $e) {
  echo "The email message was not sent. Mailer Error: {$mail->ErrorInfo}";
}

?>