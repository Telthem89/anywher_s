 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 



   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';


  $doctor = new Doctor();
  if(isset($_POST['priceperappoinrmnt']) && isset($_POST['facebook']) && isset($_POST['youtube'])&& isset($_POST['skype']) && isset($_POST['twitter']) && isset($_POST['instagram']) && isset($_POST['viber']) && isset($_POST['id'])){


  $did =htmlentities(trim($_POST['id']));
  $priceperappoinrmnt =htmlentities(trim($_POST['priceperappoinrmnt']));
  $facebook =htmlentities(trim($_POST['facebook']));
  $youtube =htmlentities(trim($_POST['youtube']));
  $skype =htmlentities(trim($_POST['skype']));
  $twitter =htmlentities(trim($_POST['twitter']));
  $instagram =htmlentities(trim($_POST['instagram']));
  $viber =htmlentities(trim($_POST['viber']));
  $dateAvailable =trim($_POST['dateAvaiblabl']);
  $timeAvailable =trim($_POST['timeavailabe']);
 


  $response =$doctor->updateDoctorContactDetails($priceperappoinrmnt,$facebook,$youtube,$skype,$twitter,$instagram,$viber,$dateAvailable,$timeAvailable,$did);

  if ($response == true) {
             $final_reply['response'] = true;
         $final_reply['data'] = "Doctor account has been updated successfully";
             echo json_encode($final_reply);
  }
  else{
         $final_reply['data'] = "Something went wrong!!";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
  }
}