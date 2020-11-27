<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
class Email{
    public static function SentMail($email,$url){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $output ='<html><body>';
        $output.='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p><a href="'.$url.'login/reset-password.php?email='.$email.'&action=reset" target="_blank">
        '.$url.'login/reset-password.php
        ?email='.$email.'&action=reset</a></p>'; 
        $output.='<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';   
        $output.='<p>Thanks,</p>';
        $output.='</body></html>';
        $body = $output; 
        $subject = "Password Recovery - Anywhere Healthcare";

        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->SMTPDebug = 0; 
        $mail->Host = "smtp.gmail.com"; 
        $mail->Port = 587; 
        $mail->SMTPSecure = 'tls'; // ssl is depracated
        $mail->SMTPAuth = true;

        $mail->Username = 'datatelthem@gmail.com';
        $mail->Password = 'brqzpibmtkcxadnx';

        $mail->setFrom('noreply@anywhere.com', 'Anywhere Healthcare');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $body;//setBody( , 'text/html');
        $mail->Header =$headers;
        if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}