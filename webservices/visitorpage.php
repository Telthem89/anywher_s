<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'autoloader.php'; 
$ticket = new Ticket();
$response = array();
$final_response['response'] = '';


if (isset($_POST['title'])  && isset($_POST['fullname']) && isset($_POST['phoneNumber']))
 {
    $title                 = htmlentities(trim($_POST['title']));
    $fullname              = htmlentities(trim($_POST['fullname']));
    $phoneNumber           = htmlentities(trim($_POST['phoneNumber']));
    $email                 = htmlentities(trim($_POST['email']));
    $speciality            = htmlentities(trim($_POST['speciality']));
    $date_u_a_free         = htmlentities(trim($_POST['date_u_a_free']));
    $time_u_a_free         = htmlentities(trim($_POST['time_u_a_free']));
    $reason_for_booking    = htmlentities(trim($_POST['reason_for_booking']));

    
	
    $visitoremail = $ticket->checkbookdemoExist($email);

     

    if (empty($fullname)){
         $response['err_message']="Please fullname  is required";
          $final_response['response'] =$response;
        echo json_encode($final_response);
       
    }


     elseif (empty($email)){
     $response['err_message'] ="Please email address required";
     $final_response['response'] =$response;
        echo json_encode($final_response);
     
    }

    elseif (empty($phoneNumber)){
         $response['err_message'] ="Please Phone Number is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }



     elseif ($visitoremail == true){
            $final_reply['data']  ="E-mail Address in use";
            $final_reply['response'] = false;
           echo json_encode($final_reply);
           exit();
     } 

    
    else
    {

         $response = $ticket->BookDemo($title ,$fullname,$phoneNumber,$email,$speciality,$date_u_a_free,$time_u_a_free,$reason_for_booking);
          if($response ==  true)
          {
                $final_reply['data']  ="Saved"; 
                $final_reply['response'] = true;
                echo json_encode($final_reply);

                 $mail = new PHPMailer;
                $mail->isSMTP(); 
                $mail->SMTPDebug = 0; 
                $mail->Host = "smtp.gmail.com"; 
                $mail->Port = 587; 
                $mail->SMTPSecure = 'tls'; // ssl is depracated
                $mail->SMTPAuth = true;

                $mail->Username = 'datatelthem@gmail.com';
                $mail->Password = 'brqzpibmtkcxadnx';

                $mail->setFrom('noreply@ustawi.com', 'Anywhere Healthcare');
                $mail->addAddress($email);
                $mail->Subject = 'Thank you for your request ';
                $mail->Body = 'Thank you for your request will respond to you soon';
                if(!$mail->send()){
                 echo "Mailer Error: " . $mail->ErrorInfo;
                }
              }
              else{
                $final_reply['data']  ="Something went wrong"; 
                $final_reply['response'] = false;
                echo json_encode($final_reply);
              }
         
    }
    
}

