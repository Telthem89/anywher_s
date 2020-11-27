 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
require '../autoloader.php'; 
$book = new Booking();
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';
if (isset($_GET['doctor_id'])) {
	$doctor_id = $_GET['doctor_id'];


	$response= $book->getTotalAppointment($doctor_id);

 if ($response ==  true) {
        $final_reply['response']= true;
        $user_profile = array();
        $user_profile['totatApointment'] = $response['totatApointment'];
        $user_profile['response']=true;
         echo json_encode($user_profile);
    }
    else{
         $final_reply['data'] = "Invalid details. Try again later";
         $final_reply['response'] = false;
         echo json_encode($final_reply);
    }
}
 

