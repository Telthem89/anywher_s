<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$prescription = new Prescription();

if (isset($_POST['prescnumber']) && isset($_POST['doctor_id']) && isset($_POST['client_id']) && isset($_POST['drugs']) && isset($_POST['dusage']) && isset($_FILES['doc']))
{
	$prescnumber= htmlentities(trim($_POST['prescnumber']));
	$doctor_id= htmlentities(trim($_POST['doctor_id']));
	$client_id= htmlentities(trim($_POST['client_id']));
	$drugs= $_POST['drugs'];
	$dusage= htmlentities(trim($_POST['dusage']));


	        $image = $_FILES['doc']['name'];
            $arrynamr = explode('.', $image);
            $exploext = array_pop( $arrynamr);
            $time = base64_encode(time().rand(1000,9999)).".".$exploext; 
             $doc= "../uploads/".$time;

	$response= $prescription->Prescrion($prescnumber,$doctor_id,$client_id,$drugs,$dusage,$doc);
		if($response ==true){
		move_uploaded_file($_FILES['doc']['tmp_name'], $doc);		
		    $final_reply['data']     ="Saved"; 
            $final_reply['response'] = true;
            echo json_encode($final_reply);
		}
	    else{
	    	$final_reply['data']     ="Something went wrong !!"; 
	        $final_reply['response'] = false;
	        echo json_encode($final_reply);
	    }
}




