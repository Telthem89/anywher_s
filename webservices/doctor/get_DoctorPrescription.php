 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$prescription = new Prescription();

if (isset($_GET['client_id'])) {
	$client_id = $_GET['client_id'];


	$result_found= $prescription->ClientgetallPrescription($client_id);
    echo json_encode($result_found,true);
}
 

