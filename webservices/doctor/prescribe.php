<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$prescription = new Prescription();

if (isset($_POST['doctor_id']) && isset($_POST['client_id']) && isset($_POST['drugs']) && isset($_POST['dusage']))
{
	$doctor_id= htmlentities(trim($_POST['doctor_id']));
	$client_id= htmlentities(trim($_POST['client_id']));
	$drugs= htmlentities(trim($_POST['drugs']));
	$dusage= htmlentities(trim($_POST['dusage']));
	$prescnumber = rand(0,99999);

	$result_found= $prescription->Prescrion($doctor_id,$client_id,$drugs,$dusage,$prescnumber);
		if($result_found ==false){		
		echo "Something went wrong";
		}
	    else{
	    	echo "Prescription added successfully";
	    }
}




