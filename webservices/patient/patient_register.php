<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




require '../autoloader.php';
// require '../vendor/autoload.php';
$client = new Patient();

// $mail = new PHPMailer(true);

$response = array();
$final_reply['response'] = false;
$final_reply['data'] = '';
//firstname,lastname,email,phoneNumber,password
if ( isset($_POST['email']) &&  isset($_POST['password']))
 {

	$fullname =$_POST['fullname'];
    $phoneNumber =$_POST['phoneNumber'];
    $email =$_POST['email'];
	$password =htmlentities(trim($_POST['password']));
    $generatedCode = rand(0,999999);
    $phonegeneratedCode = rand(0,9999);
    $emailcheck = $client->checkClientExist($email);
    $phonenumber = $client->checkifPhoneNumberIsExist($phoneNumber);



    if (empty($email)){
         $response['err_message'] ="E-mail address is required";
         $final_response['response'] =$response;
         echo json_encode($final_response);
    }
    
	elseif (empty($password)){
	         $response['err_message'] ="Please Password is required";
	         $final_response['response'] =$response;
	        echo json_encode($final_response);
	    }
     elseif ($emailcheck ==  true){
          $final_reply['data']  ="E-mail exist"; 
          $final_reply['response'] = false;
           echo json_encode($final_reply);

           exit();
     } 

     elseif ($phonenumber ==  true){
          $final_reply['data']  ="Phone Exist"; 
          $final_reply['response'] = false;
           echo json_encode($final_reply);

           exit();
     } 

    
        
         
        else{
            
             $response=$client->createClientAccount($fullname,$email,$phoneNumber,$password,$generatedCode);

             if($response ==  true){
                $final_reply['data']  ="Client created successfully"; 
                $final_reply['response'] = true;
                echo json_encode($final_reply);
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Mailer = "smtp";
                    $mail->SMTPDebug = 0; 
                    $mail->Host = "smtp.gmail.com"; 
                    $mail->Port = 587; 
                    $mail->SMTPSecure = 'tls'; // ssl is depracated
                    $mail->SMTPAuth = true;

                    $mail->Username = 'datatelthem@gmail.com';
                    $mail->Password = 'brqzpibmtkcxadnx';


                    $mail->setFrom('noreply@anywherehealthcare.com', 'Anywhere Healthcare');
                    $mail->addAddress($email);
                    $mail->Subject = 'Verify your email address';
                    $mail->Body = 'Thank you for signing up to Anywhere healthcare. To get access to your account please verify your email address by adding this code to the form  '.$generatedCode;
                    if(!$mail->send()){
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    }

                  
            }
            else{
               $final_reply['data'] = "Failed to create your account something went wrong";
               $final_reply['response'] = false;
                echo json_encode($final_reply);
            }
           
        }
       
	}
