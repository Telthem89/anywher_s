 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 

  // use PHPMailer\PHPMailer\PHPMailer;
  // use PHPMailer\PHPMailer\Exception;
  require '../autoloader.php'; 

  $schedule = new Booking();
  if(isset($_POST['client_id'])){
  $book_time      =htmlentities(trim($_POST['book_time']));
  $reschedule     =htmlentities(trim($_POST['reschedule']));
  $client_id      =htmlentities(trim($_POST['client_id']));
  $email          =htmlentities(trim($_POST['email']));
  $phoneNumber    =htmlentities(trim($_POST['phoneNumber']));

  $response =$schedule->RescheduleAppointment($book_time,$reschedule,$client_id);

   if ($response ==  true) {
       $final_reply['data'] = "Rescheduled";
       $final_reply['response'] = true;
       echo json_encode($final_reply);


        // $mail = new PHPMailer;
        // $mail->isSMTP(); 
        // $mail->SMTPDebug = 0; 
        // $mail->Host = "smtp.gmail.com"; 
        // $mail->Port = 587; 
        // $mail->SMTPSecure = 'tls'; // ssl is depracated
        // $mail->SMTPAuth = true;

        // $mail->Username = 'datatelthem@gmail.com';
        // $mail->Password = 'brqzpibmtkcxadnx';

        // $mail->setFrom('noreply@anywherehealthcare.com', 'Anywhere Healthcare');
        // $mail->addAddress($email);
        // $mail->Subject = 'Schedule Message';
        // $mail->Body = $reschedule;
        // if(!$mail->send()){
        //  echo "Mailer Error: " . $mail->ErrorInfo;
        // }
   }
   else{
     $final_reply['data'] = "Schedule Failed";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }

}