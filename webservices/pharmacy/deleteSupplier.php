 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
require '../autoloader.php'; 
 $pharmacy = new Pharmacy();
 $response = array();
 $final_reply['response'] = false;
 $final_reply['data'] = '';
$final_response['response'] = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$response= $pharmacy->deleteSupplierDetails($id);
    if ($response == true) {
    	$final_reply['data']  ="Deleted"; 
         $final_reply['response'] = true;
          echo json_encode($final_reply);
    }
    else{
    	$final_reply['data'] = "No Supplier deleted";
        $final_reply['response'] = false;
         echo json_encode($final_reply);
    }
        
}
 

