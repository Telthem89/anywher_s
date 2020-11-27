 <?php  
require '../autoloader.php'; 
$client = new Patient();
 $response = array();
 $final_reply['response'] = false;
 $final_reply['data'] = '';
$final_response['response'] = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$response= $client->deleteClientDetails($id);
    if ($response == true) {
    	 $final_reply['data']  ="Client Deleted successfully !!"; 
		 $final_reply['response'] = true;
          echo json_encode($final_reply);
    }
    else{
    	$final_reply['data'] = "Failed to delete client account something went wrong";
        $final_reply['response'] = false;
         echo json_encode($final_reply);
    }
        
}
 

