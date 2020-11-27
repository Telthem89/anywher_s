<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$book = new Booking();

$response = array();
$final_response['response'] = '';
$final_reply['response'] = false;
$final_reply['data'] = '';

if (isset($_POST['description']) && isset($_POST['client_id']) && isset($_POST['doctor_id']) && isset($_POST['book_time']))
{
	$description = htmlentities(trim($_POST['description']));
	$client_id   = htmlentities(trim($_POST['client_id']));
	$doctor_id   = htmlentities(trim($_POST['doctor_id']));
	$book_time   = htmlentities(trim($_POST['book_time']));

    if (empty($description)){
         $final_reply['data'] ="Please Booking description is required";
         $final_reply['response'] =false;
         echo json_encode($final_reply);
    }

    elseif (empty($doctor_id)){
         $final_reply['data'] ="Please choose doctor is required";
         $final_reply['response'] =false;
         die($final_reply);
    }
	elseif (empty($book_time)){
	         $final_reply['data'] ="Please provide date is required";
	         $final_reply['response'] =false;
	        echo json_encode($final_reply);
	    }

	else{
		$response= $book->myBooking($description,$client_id,$doctor_id,$book_time);
		if($response == true){
			$final_reply['data']     ="Booking Saved"; 
            $final_reply['response'] = true;
            echo json_encode($final_reply);
			}
		    else{
		    	$final_reply['data']     ="Something went wrong !!"; 
		        $final_reply['response'] = false;
		        echo json_encode($final_reply);
		    	
		    }
	}
}




