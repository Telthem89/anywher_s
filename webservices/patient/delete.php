 <?php  
require '../autoloader.php'; 
$client = new Patient();
$response = array();
$final_response['response'] = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$result_found= $client->deleteClientDetails($id);
    if ($result_found == true) {
    	$response['succ_message'] ="Client Deleted successfully !!"; 
		$final_response['response'] =$response;
	    echo json_encode($final_response);
    }
    else{
    	$response['err_message'] ="Something went wrong !!"; 
		$final_response['response'] =$response;
	    echo json_encode($final_response);
    }
        
}
 

