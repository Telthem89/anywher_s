 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$book = new Booking();

if (isset($_GET['doctor_id'])) {
	$doctor_id = $_GET['doctor_id'];


	$result_found= $book->DoctorGetHisorHerAppointments($doctor_id);
    echo json_encode($result_found,true);
}
 

