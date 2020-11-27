 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$doctor = new Doctor();

if (isset($_GET['id'])) {
	$doctor_id = $_GET['id'];


	$result_found= $doctor->getDoctorBy_id($doctor_id);
    echo json_encode($result_found,true);
}
 

