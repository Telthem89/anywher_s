 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$administrator = new Administrator();

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$response= $administrator->ApproveDoc($id);
   if ($response ==  true) {
   	   $final_reply['data'] = "Account Approved";
   	   $final_reply['response'] = true;
       echo json_encode($final_reply);
   }
   else{
   	 $final_reply['data'] = "Failed to Approved something went wrong";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }
}