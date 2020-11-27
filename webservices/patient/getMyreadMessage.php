 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$book = new Booking();

if (isset($_GET['client_id'])) {
	$patient_id = $_GET['client_id'];


	$result_found= $book->myNewBooking($patient_id);
    echo json_encode($result_found,true);
}
 

