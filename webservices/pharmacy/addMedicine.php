<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');


require '../autoloader.php'; 
$pharmacy = new Pharmacy();

$response = array();
$final_response['response'] = '';


if (isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['usage']) && isset($_POST['sideeffect']) && isset($_FILES['imageurl']) && isset($_POST['precautions']))
 {

    
    // $serialNumber        =htmlentities(trim($_POST['serialNumber']));
    $name                =htmlentities(trim($_POST['name']));
    $quantity            =htmlentities(trim($_POST['quantity']));
    $usage               =htmlentities(trim($_POST['usage']));
    $sideeffect          =htmlentities(trim($_POST['sideeffect']));
    $precautions         =htmlentities(trim($_POST['precautions']));
    $interation          =htmlentities(trim($_POST['interation']));
    $overdose            =htmlentities(trim($_POST['overdose']));
    $supplierId          =htmlentities(trim($_POST['supplierId']));
    $catID               =htmlentities(trim($_POST['catID']));
    // $manufacturer        =htmlentities(trim($_POST['manufacturer']));
    $expiry_date         =htmlentities(trim($_POST['expiry_date']));

            $imageurl = $_FILES['imageurl']['name'];
            $arrynamr = explode('.', $imageurl);
            $exploext = array_pop( $arrynamr);
            $time = base64_encode(time().rand(1000,9999)).".".$exploext;           
         
            $avatar= "../uploads/drugs/".$time;

   

     

   if (empty($name)){
         $response['err_message'] ="Please medicine is required";
          $final_response['response'] =$response;
          echo json_encode($final_response);
      
    }
  
     elseif (empty($quantity)){
     $response['err_message'] ="Please quantity is required";
     $final_response['response'] =$response;
     echo json_encode($final_response);
     
    } 
     elseif (empty($usage)){
     $response['err_message'] ="Please usage required";
     $final_response['response'] =$response;
        echo json_encode($final_response);
     
    }
      elseif (empty($sideeffect)){
         $response['err_message'] ="Please Side effects are required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($precautions)){
         $response['err_message'] ="Please Precaution is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
  

    elseif (empty($imageurl)){
         $response['err_message'] ="Please Upload Image";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($supplierId)){
         $response['err_message'] ="Please Supplier is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($catID)){
         $response['err_message'] ="Please Choose Category";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
  
    elseif (empty($expiry_date)){
         $response['err_message'] ="Please expiry date is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
     
    else
    {

    $response = $pharmacy->addMedicine($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$avatar,$supplierId,$catID,$expiry_date);
          if($response ==  true)
          {
                $final_reply['data']  ="Saved"; 
                $final_reply['response'] = true;
                echo json_encode($final_reply);
                move_uploaded_file($_FILES['imageurl']['tmp_name'], $avatar);
              }
              else{
                $final_reply['data']  ="Something went wrong"; 
                $final_reply['response'] = false;
                echo json_encode($final_reply);
              }
         
    }
    
}

