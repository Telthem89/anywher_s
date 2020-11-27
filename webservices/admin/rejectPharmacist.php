 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$administrator = new Administrator();
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$response= $administrator->RejectPharmacist($id);
   if ($response ==  true) {
   	   $final_reply['data'] = "Rejected";
   	   $final_reply['response'] = true;
       echo json_encode($final_reply);
   }
   else{
   	 $final_reply['data'] = "Failed to reject something went wrong";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }
}