<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require '../autoloader.php';
 $pharmacy = new Pharmacy();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

 if (isset($_POST['id']) && isset($_FILES['avatar']))
 {
 	       $id =htmlentities(trim($_POST['id']));



 	        $image = $_FILES['avatar']['name'];
            $arrynamr = explode('.', $image);
            $exploext = array_pop( $arrynamr);
            $time = base64_encode(time().rand(1000,9999)).".".$exploext;           
 	     
            $avatar= "../uploads/avatar/".$time;

         $response= $pharmacy->updatePharmacistProPic($avatar,$id);
         if($response==true){
         	move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
			$final_reply['data']     ="Updated"; 
            $final_reply['response'] = true;
            echo json_encode($final_reply);
			}
	    else{
			$final_reply['data']     ="No Image update"; 
            $final_reply['response'] = false;
            echo json_encode($final_reply);
	    }
 }