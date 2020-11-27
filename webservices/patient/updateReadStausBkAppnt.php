<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$book = new Booking();

$response = array();
$final_response['response'] = '';
//$patient_id,$drugs,$gender,$address,$allegicMedication,$otherdeases,$med_doc
if (isset($_POST['book_id']) && isset($_POST['client_id']))
 {

 	$book_id =htmlentities(trim($_POST['book_id']));
	$client_id =htmlentities(trim($_POST['client_id']));
	
   
       $response = $book->UpdateReadStatusforBookingAppointment($book_id,$client_id);

		 if ($response ==  true){
			$final_reply['data'] = "Read";
            $final_reply['response'] = true;
             echo json_encode($final_reply);
		}
	    else{
	    	$final_reply['data'] = "Not Saved error occurred";
	        $final_reply['response'] = false;
	        echo json_encode($final_reply);
	    } 
   
}




