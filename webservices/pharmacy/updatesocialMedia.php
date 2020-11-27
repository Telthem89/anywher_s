 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 



   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';


   $pharmacy = new Pharmacy();
  if(isset($_POST['facebook']) && isset($_POST['youtube'])&& isset($_POST['skype']) && isset($_POST['twitter']) && isset($_POST['instagram']) && isset($_POST['viber']) && isset($_POST['id'])){


  $pid =htmlentities(trim($_POST['id']));
  $facebook =htmlentities(trim($_POST['facebook']));
  $youtube =htmlentities(trim($_POST['youtube']));
  $skype =htmlentities(trim($_POST['skype']));
  $twitter =htmlentities(trim($_POST['twitter']));
  $instagram =htmlentities(trim($_POST['instagram']));
  $viber =htmlentities(trim($_POST['viber']));
 


  $response =$pharmacy->updatePharmacistContactDetails($facebook,$youtube,$skype,$twitter,$instagram,$viber,$pid);

  if ($response == true) {
     $final_reply['response'] = true;
     $final_reply['data'] = "Updated";
     echo json_encode($final_reply);
  }
  else{
    $final_reply['data'] = "Something went wrong!!";
    $final_reply['response'] = false;
    echo json_encode($final_reply);
  }
}