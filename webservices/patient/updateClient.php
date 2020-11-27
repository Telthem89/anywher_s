<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$client = new Patient();

$response = array();
$final_response['response'] = '';
//$patient_id,$drugs,$gender,$address,$allegicMedication,$otherdeases,$med_doc
if (isset($_POST['patient_id']) && isset($_POST['drugs'])  && isset($_POST['allegicMedication']) && isset($_POST['otherdeases']) && isset($_FILES['med_doc']))
 {

 	$patient_id =htmlentities(trim($_POST['patient_id']));
	$drugs =htmlentities(trim($_POST['drugs']));
	$allegicMedication =htmlentities(trim($_POST['allegicMedication']));
	$otherdeases =htmlentities(trim($_POST['otherdeases']));
	

  if (empty($drugs)){
         $response['err_message'] ="Please choose medication";
         $final_response['response'] =$response;
         echo json_encode($final_response);
    }

            $image = $_FILES['med_doc']['name'];
            $arrynamr = explode('.', $image);
            $exploext = array_pop( $arrynamr);
            $time = base64_encode(time().rand(1000,9999)).".".$exploext; 
             $med_doc= "../uploads/".$time;


	    
 
		    
       $response= $client->updateClientDetails($patient_id,$drugs,$allegicMedication,$otherdeases,$med_doc);

		 if ($response ==  true){
			$final_reply['data'] = "Saved";
            $final_reply['response'] = true;
             echo json_encode($final_reply);
		}
	    else{
	    	$final_reply['data'] = "Not Saved error occurred";
	        $final_reply['response'] = false;
	        echo json_encode($final_reply);
	    } 
   
}




