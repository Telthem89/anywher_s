<?php


class Pharmacy
{
   private $db;
   public function __construct(){
      $this->db = new Database();
   }
	/*==================(1) END Create Account for Pharmacist=============================*/
	public function createPharmAccount($fullname,$phoneNumber,$emailAddress,$password,$generatedCode){
		$options = [
              'cost' => 12,
          ];
          $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                   
          $sql ="INSERT INTO `pharmacy`(`fullname`,`phoneNumber`,`email`,`password`,`generatedCode`) VALUES('$fullname','$phoneNumber','$emailAddress','$encrypetedpass','$generatedCode')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($fullname,$phoneNumber,$emailAddress,$password,$generatedCode));
          if($result_arry){return true;}
          else{return false;}
	}
	/*================== END Create Account for Pharmacist=============================*/





	/*================== (2) check if Phone Exist=============================*/
	public function pharmacycheckifPhoneNumberIsExist($phoneNumber){
		$sql ="SELECT phoneNumber FROM pharmacy WHERE phoneNumber = ?";
      $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($phoneNumber));
       $num = $stmt->rowCount();
       if ($num ==1) { return true; }
       else { return false; }
	}
	/*================== END check if Phone Exist=============================*/




	/*================== (3) check if Email Exist=============================*/
	public function checkpharmacyExist($emailAddress){
		$sql = 'SELECT email from pharmacy WHERE email =?';
     $stmt = $this->db->conn->prepare($sql);
     $stmt->execute(array($emailAddress));
     $num = $stmt->rowCount();
     if ($num ==1) {return true;}
     else {return false;}
	}
	/*================== END check if Email Exist=============================*/


	/*==================(4) check Code=============================*/
	public function checkCodeEntered($generatedCode){
		$sql ="SELECT generatedCode FROM pharmacy WHERE  generatedCode=?";
       $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($generatedCode));
       $num = $stmt->rowCount();
       if ($num ==1) { return true;}
       else {return false;}
	}
	/*================== END check Code=============================*/


  /*========check if the email address is activated===================*/ 
   public function checkifPharmEmailIsActivated($email)
    {
       $status = 0;
       $sql ="SELECT status,email FROM pharmacy WHERE status = ? and email=?";
       $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($status,$email));
       $num = $stmt->rowCount();
       if ($num ==1) {
         return true;
       }
       else {
         return false;
       }
    }
/*========end here please check if the email address is activated===================*/ 


	/*==================(5) Code Update=============================*/
	public function UpdateStatusForpharmacy($generatedCode){
		
	  $status =1;
      $sql ="UPDATE `pharmacy` SET `status` = ?  WHERE `generatedCode` = ?";
      $stmt = $this->db->conn->prepare($sql);
      $result_arry = $stmt->execute(array($status,$generatedCode));
      if($result_arry){ return true;}
      else{return false;}
	}
	/*================== END Code Update=============================*/

	/*==================(6) UPDATE PHARMACIST=============================*/
	public function updatePharmacyDetails($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$nationality,$city,$phid){
		$sql ="UPDATE `pharmacy` SET `firstname`=?, `lastname`=?, `dob`=?,`gender`=?, `address`=?, `qualification`=?, `phoneNumber`=?, `email`=?,  `country`=?, `city`=? WHERE  `id`=?";
	      $stmt = $this->db->conn->prepare($sql);
	      $result_arry = $stmt->execute(array($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$nationality,$city,$phid));
	      if($result_arry){ return true;}
	      else{return false;}
	}
	/*================== END UPDATE PHARMACIST=============================*/


	/*==========================(7) Pharmacy panel==============================*/ 
	public function loginPharmacy($email, $password){
		try{
	    $sql ='SELECT * FROM pharmacy WHERE email = :email';
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->bindParam(':email', $email);
	    $stmt->execute();
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	    if(password_verify($password, $result['password'])){
	        return array("success"=>true,
	       "data"=>$result);
	    }
	    else{
	    return false;
	    }
	    } catch (PDOException $e) {

	    return array("success"=>false, "data"=>null);
	  
	  }
  }
   /*==========================Pharmacy Login==============================*/ 



  /*==================(8) FETCH PHARMACIST INFORMATION=============================*/
  
   public function getPharmacistById($pharmacst_id)
   {
   		$sql = "SELECT id,firstname,lastname,dob,gender,address,qualification,phoneNumber,email,password,avatar,generatedCode,status,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate FROM pharmacy WHERE id=?";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute(array($pharmacst_id));
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function updatePharmacistProPic($avatar,$id)
   {
      $sql ="UPDATE `pharmacy` SET `avatar` = ?  WHERE `id` = ?";
      $stmt = $this->db->conn->prepare($sql);
      $result_arry = $stmt->execute(array($avatar,$id));
      if($result_arry){ return true;}
      else{return false;}
   }

   public function updatePharmacistContactDetails($facebook,$youtube,$skype,$twitter,$instagram,$viber,$pid)
      {
         $sql ="UPDATE `pharmacy` SET `facebook`=?,`youtube` = ? , `skype` = ? , `twitter` = ?, `instagram` = ?,`viber` = ? WHERE `id` = ?";
             $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($facebook,$youtube,$skype,$twitter,$instagram,$viber,$pid));
            if($result_arry){
                
                 return true;
            }
            else{
               return false; 
            }
      }


      public function getallPharmacists()
          	{
              $adminstatus = "Pending";
          		$sql = "SELECT id,fullname,firstname,lastname,adminstatus,dob,gender,`address`,qualification,phoneNumber,email,`password`,avatar,generatedCode,status,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname ,DATE(created_on) AS datecreate,adminstatus
                        FROM pharmacy  WHERE adminstatus =?";
                  $stmt = $this->db->conn->prepare($sql);
                  $stmt->execute(array($adminstatus));
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            public function getallPharmacistswithApprovedStatus()
          	{
              $adminstatus = "Approved";
          		$sql = "SELECT id,fullname,firstname,lastname,adminstatus,dob,gender,`address`,qualification,phoneNumber,email,`password`,avatar,generatedCode,status,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname ,DATE(created_on) AS datecreate,adminstatus
                        FROM pharmacy  WHERE adminstatus =?";
                  $stmt = $this->db->conn->prepare($sql);
                  $stmt->execute(array($adminstatus));
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            

            public function updatePharmacyPassword($password,$email)
            {
                  $database = new Database();
                  $options = [
                    'cost' => 12,
                ];
                $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
            
                  $sql ="UPDATE `pharmacy` SET `password`=? WHERE `email` = ?";
                   $stmt = $database->conn->prepare($sql);
                  $result_arry = $stmt->execute(array($encrypetedpass,$email));
                  if($result_arry){
                      
                       return true;
                  }
                  else{
                     return false; 
                  }
            }

  /*================== END FETCH PHARMACIST INFORMATION=============================*/


   /*==================(9) FETCH PHARMACIST LOGS=============================*/
   public function getPharmacistLogs($pharmacst_id){}
   /*================== END FETCH PHARMACIST LOGS=============================*/


   /*==================(10) ADD MEDICINE=============================*/
   public function addMedicine($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$avatar,$supplierId,$catID,$expiry_date)
   {
    $sql ="INSERT INTO `madicines`(`name`,`quantity`,`usage`,`sideeffect`,`precautions`,`interation`,`overdose`,`imageurl`,`supplierId`,`catID`,`expiry_date`) VALUES('$name','$quantity','$usage','$sideeffect','$precautions','$interation','$overdose','$avatar','$supplierId','$catID','$expiry_date')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$avatar,$supplierId,$catID,$expiry_date));
          if($result_arry){return true;}
          else{return false;}
   }
   /*================== END ADD MEDICINE=============================*/


   /*==================(11) FETCH ALL MEDICINES=============================*/
   public function getAllMedicines()
   {
   		$sql = "SELECT md.id,md.serialNumber,md.name,md.quantity,md.`usage`,md.sideeffect
,md.precautions,md.interation,md.overdose,md.imageurl,cat.category_name,sup.comapany_name,md.expiry_date FROM madicines  AS md  INNER JOIN categories AS cat ON cat.id = md.catID INNER JOIN suppliers AS sup ON
sup.id = md.supplierId ORDER BY md.created_on DESC";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   /*================== END FETCH ALL MEDICINES=============================*/



   /*================== FETCH MEDICINE DETAIL=============================*/
   public function getMedicineDetailsByID($Mid)
   {
   		$sql = "SELECT md.id,md.serialNumber,md.name,md.quantity,md.`usage`,md.sideeffect
,md.precautions,md.interation,md.overdose,md.imageurl,cat.id as cid,cat.category_name,sup.id as sid,sup.comapany_name,md.expiry_date FROM madicines  AS md  INNER JOIN categories AS cat ON cat.id = md.catID INNER JOIN suppliers AS sup ON sup.id = md.supplierId WHERE md.pid =?";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute(array($Mid));
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   /*================== END FETCH MEDICINE DETAIL=============================*/


   /*================== UPDATE MEDICINE DETAIL=============================*/
   public function UpdateMedicineDetailsByID($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$supplierId,$catID,$expiry_date,$mid)
   {
   		$sql ="UPDATE `madicines` SET `name`=?,`quantity`=?,`usage`=?,`sideeffect`=?,`precautions`=?,`interation`=?,`overdose`=?,`supplierId`=?,`catID`=?,`expiry_date`=?  WHERE `id` = ?";
	      $stmt = $this->db->conn->prepare($sql);
	      $result_arry = $stmt->execute(array($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$supplierId,$catID,$expiry_date,$mid));
	      if($result_arry){ return true;}
	      else{return false;}
   }


    public function deleteMedicineDetails($mid)
    {
        $sql ='DELETE FROM madicines WHERE id = ?';
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($mid));
        if($result_arry){
          return true;
        }
         else{
          return false;
        }
    }
   /*================== END UPDATE MEDICINE DETAIL=============================*/



    /*==================CATEGORY=============================*/
     public function addCategory($category_name){
     	   $sql ="INSERT INTO `categories`(`category_name`) VALUES('$category_name')";      
         $stmt = $this->db->conn->prepare($sql);
         $result_arry = $stmt->execute(array($category_name));
         if($result_arry){return true;}
         else{return false;}
     }
     public function getCategories(){
     	$sql = "SELECT `id`,`category_name` FROM categories ORDER BY created_on DESC";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     public function getCategoryByID($cid){
     	$sql = "SELECT `id`,`category_name` FROM categories WHERE id=?";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute(array($cid));
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     public function updateCategory($category_name,$cid){
     	$sql ="UPDATE `categories` SET `category_name`=?  WHERE `id` = ?";
	      $stmt = $this->db->conn->prepare($sql);
	      $result_arry = $stmt->execute(array($category_name,$cid));
	      if($result_arry){ return true;}
	      else{return false;}
     }

     public function deleteCategoryDetails($cid)
      {
       $sql ='DELETE FROM categories WHERE id = ?';
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($cid));
        if($result_arry){
          return true;
        }
         else{
          return false;
        }
      }

    /*================== END ADD CATEGORY=============================*/




    /*================== SUPPLIER=============================*/
     public function addSupplier($comapany_name,$country,$city,$address,$phone,$email){
     	  $sql ="INSERT INTO `suppliers`(`comapany_name`,`country`,`city`,`address`,`phone`,`email`) VALUES('$comapany_name','$country','$city','$address','$phone','$email')";      
         $stmt = $this->db->conn->prepare($sql);
         $result_arry = $stmt->execute(array($comapany_name,$country,$city,$address,$phone,$email));
         if($result_arry){return true;}
         else{return false;}
     }
     public function getSuppliers(){
     	$sql = "SELECT `id`,`comapany_name`,`country`,`city`,`address`,`phone`,`email`,`created_on` FROM suppliers ORDER BY created_on DESC";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     public function getSupplierByID($sid){
     	$sql = "SELECT `id`,`comapany_name`,`country`,`city`,`address`,`phone`,`email`,`created_on` FROM suppliers WHERE id =?";
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->execute(array($sid));
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }



     public function updateSupplier($comapany_name,$country,$city,$address,$phone,$email,$sid){
     	$sql ="UPDATE `suppliers` SET `comapany_name`=?,`country`=?,`city`=?,`address`=?,`phone`=?,`email`=?  WHERE `id` = ?";
	      $stmt = $this->db->conn->prepare($sql);
	      $result_arry = $stmt->execute(array($comapany_name,$country,$city,$address,$phone,$email,$sid));
	      if($result_arry){ return true;}
	      else{return false;}
     }

     public function deleteSupplierDetails($sid)
      {
        $sql ='DELETE FROM suppliers WHERE id = ?';
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($sid));
        if($result_arry){
          return true;
        }
         else{
          return false;
        }
      }

    /*================== END SUPPLIER=============================*/


    /*==============================SALES=====================================*/
     public function addSale(){}
     public function getSales(){}
     public function getSaleByID($saleid){}
    /*==============================SALES=====================================*/ 





    public function logout($id)
    {
       $_SESSION['pharmacy_id'] = $id;
       unset($_SESSION['pharmacy_id']);
       session_destroy();
    }


}