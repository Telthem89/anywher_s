<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require '../autoloader.php';
 $doctor = new Doctor();

 if (isset($_POST['id']) && isset($_FILES['avatar']))
 {
 	       $id =htmlentities(trim($_POST['id']));



 	        $image       = $_FILES['avatar']['name'];
            $arrynamr    = explode('.', $image);
            $exploext    = array_pop( $arrynamr);
            $time        = base64_encode(time().rand(1000,9999)).".".$exploext;           	     
            $avatar      = "../uploads/avatar/".$time;

	        $respose        = $doctor->updateProfilePic($avatar,$id);
	         if($respose==true){
				move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
				 $final_reply['data'] = "Saved";
	             $final_reply['response'] = true;
	              echo json_encode($final_reply);
				}
		    else{
		    	$final_reply['data']  = "Your information has been updated successfully !!";
	            $final_reply['response'] = false;
	            echo json_encode($final_reply);	    	
	         }
 }