 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
require '../autoloader.php'; 
$doctor = new Doctor();
$response = array();
$final_response['response'] = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$result_found= $doctor->deleteDoctorDetails($id);
    if ($result_found == true) {
    	$response['succ_message'] ="Doctor has been Deleted successfully !!"; 
		$final_response['response'] =$response;
	    echo json_encode($final_response);
    }
    else{
    	$response['err_message'] ="Something went wrong !!"; 
		$final_response['response'] =$response;
	    echo json_encode($final_response);
    }
        
}
 

