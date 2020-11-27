<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require 'autoloader.php';
   $pharmacy = new Pharmacy();
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

   if(isset($_POST['email'])  &&  isset($_POST['password'])){
       $email = $_POST['email'];
       $password    = $_POST['password'];

       $status =$pharmacy->checkifPharmEmailIsActivated($email);
       if ($status == true) {
             $final_reply['data'] = "Email not Activated";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
              session_destroy();
              exit();
       }
       else{
       $response =  $pharmacy->loginPharmacy($email, $password);
       
       if ($response==true) {
        
          $final_reply['response']= true;

           $user_profile = array();
           $user_profile['id']                  = $response['data']['id'];
           $user_profile['fullname']            = $response['data']['fullname'];
           $user_profile['firstname']           = $response['data']['firstname'];
           $user_profile['lastname']            = $response['data']['lastname'];
           $user_profile['dob']                 = $response['data']['dob'];
           $user_profile['gender']              = $response['data']['gender'];
           $user_profile['address']             = $response['data']['address'];
           $user_profile['qualification']       = $response['data']['qualification'];
           $user_profile['phoneNumber']         = $response['data']['phoneNumber'];
           $user_profile['email'] = $response['data']['email'];
           $user_profile['avatar'] = $response['data']['avatar'];
           $user_profile['country'] = $response['data']['country'];
           $user_profile['city'] = $response['data']['city'];
           // $user_profile['priceperappoinrmnt'] = $response['data']['priceperappoinrmnt'];
           $user_profile['facebook'] = $response['data']['facebook'];
           $user_profile['youtube'] = $response['data']['youtube'];
           $user_profile['skype'] = $response['data']['skype'];
           $user_profile['twitter'] = $response['data']['twitter'];
           $user_profile['instagram'] = $response['data']['instagram'];
           $user_profile['viber'] = $response['data']['viber'];

           $_SESSION['pharmacy_id'] = $response['data']['id'];
           $_SESSION['pstatus'] = $response['data']['status'];
           $_SESSION['adminstatus'] = $response['data']['adminstatus'];
           $user_profile['response']=true;
           echo json_encode($user_profile);

          

       }
       else{
             $final_reply['data'] = "Invalid details. Try again later";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
       }
     }
   
 }
