<?php

    /*

    |--------------------------------------------------------------------------
    | 					        | Doctor |
    |--------------------------------------------------------------------------
    |


    */

    
    class Doctor
    {
        // $database = new Database();
      
    	/** create Doctor account */
      private $db;
      public function __construct(){
          $this->db = new Database();
      }


    	public function createDoctorAccount($mdpcz_id,$fullname,$emailAddress,$password,$generatedCode)
        {
        
    		 $options = [
                        'cost' => 12,
                    ];
                $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                $sql ="INSERT INTO `doctor`(`MDPCZ_ID`,`fullname`,`email`,`password`,`generatedCode`) VALUES('$mdpcz_id','$fullname','$emailAddress','$encrypetedpass','$generatedCode')";
               
       
                $stmt = $this->db->conn->prepare($sql);
                $result_arry = $stmt->execute(array($mdpcz_id,$fullname,$emailAddress,$password,$generatedCode));
                if($result_arry){
                       
                     return true;
                }
                else{
                   return false; 
                }
    	}
    	/* =====================end create Doctor account==============================*/
    	
        public function checkDockExist($email){
            
            $sql = 'SELECT email from doctor WHERE email =?';
            $stmt = $this->db->conn->prepare($sql);
             $stmt->execute(array($email));
             $num = $stmt->rowCount();
             if ($num ==1) {
               return true;
             }
             else {
               return false;
             }
         }



    	
    	/** get all Doctors */

    	public function getallDoctors()
    	{
        $adminstatus = "Approved";
    		$sql = "SELECT id,MDPCZ_ID,fullname,firstname,lastname,dob,gender,address,qualification,speciality,experience,phoneNumber,email,password,avatar,generatedCode,status,priceperappoinrmnt,bio,country,city,facebook,youtube,skype,twitter,instagram,viber,dateAvaiblabl,timeavailabe,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname ,DATE(created_on) AS datecreate,adminstatus FROM doctor WHERE adminstatus =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($adminstatus));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	}

    	/*=====================end get all Doctors===================================*/




    	/**get Doctor by id* */

    	public function getDoctorBy_id($doctor_id)
    	{
    	   $sql = "SELECT id,MDPCZ_ID,fullname,firstname,lastname,dob,gender,address,qualification,speciality,experience,phoneNumber,email,password,avatar,generatedCode,status,priceperappoinrmnt,bio,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname,dateAvaiblabl,timeavailabe,DATE(created_on) AS datecreate FROM doctor WHERE id=?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);	
    	}

    	/* =====================end get Doctor by id===================================**/


     

 public function doctorcheckifPhoneNumberIsExist($phone)
    {
       $sql ="SELECT phoneNumber FROM doctor WHERE phoneNumber = ?";
      $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($phone));
       $num = $stmt->rowCount();
       if ($num ==1) { return true; }
       else { return false; }
    }


      
  	    /**update Doctor details* 

        updateDoctorDetails('89708866', 'John', 'Tseriwa', 'Bio-Chemology', '3294 Cressant G...', '0774914150', 'jtseriwa@gmail....', 'Zimbabwe', 'Harare', 'Not just your d...', '2')*/

    	public function updateDoctorDetails($MDPCZ_ID,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$nationality,$city,$bio,$did)
    	{
            $sql ="UPDATE `doctor` SET `MDPCZ_ID`=?,`firstname` = ? , `lastname` = ?,`dob`=?,`gender`=? , `address` = ?,`qualification`=?, `speciality` = ?,`experience`=?,`phoneNumber` = ?,`email`=?,`country`=?,`city`=?,`bio`=? WHERE `id` = ?";
             $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($MDPCZ_ID,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$nationality,$city,$bio,$did));
            if($result_arry){
                
                 return true;
            }
            else{
               return false; 
            }
      }
      
      public function updateDoctorPassword($password,$email)
    	{
            $options = [
              'cost' => 12,
             ];
              $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
      
            $sql ="UPDATE `doctor` SET `password`=? WHERE `email` = ?";
             $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($password,$encrypetedpass));
            if($result_arry){
                
                 return true;
            }
            else{
               return false; 
            }
    	}

public function updatePractionner($did,$MDPCZ_ID,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$password)
      {
            $options = [
                        'cost' => 12,
                    ];
                $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
      
       $sql ="UPDATE `doctor` SET `MDPCZ_ID`=?,`firstname` = ? , `lastname` = ? , `dob` = ?, `gender` = ?, `address` = ? ,`qualification` = ? ,`speciality` = ?,`experience` = ?,`phoneNumber` = ?,`email`=?,`password`=? WHERE `id` = ?";
             $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($did,$MDPCZ_ID,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$encrypetedpass));
            if($result_arry){
                
                 return true;
            }
            else{
               return false; 
            }
      }



public function updateDoctorContactDetails($priceperappoinrmnt,$facebook,$youtube,$skype,$twitter,$instagram,$viber,$dateAvailable,$timeAvailable,$did)
      {
        
        $sql ="UPDATE `doctor` SET `priceperappoinrmnt`=?,`facebook`=?,`youtube` = ? , `skype` = ? , `twitter` = ?, `instagram` = ?,`viber` = ?,`dateAvaiblabl`=?,`timeavailabe`=? WHERE `id` = ?";
             $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($priceperappoinrmnt,$facebook,$youtube,$skype,$twitter,$instagram,$viber,$dateAvailable,$timeAvailable,$did));
            if($result_arry){
                
                 return true;
            }
            else{
               return false; 
            }
      }
    	/* ================end update Doctor details=================================*/
 

    	public function deleteDoctorDetails($doctorid)
    	{
    		$sql ='DELETE FROM doctor WHERE id = ?';
              $stmt = $this->db->conn->prepare($sql);
              $result_arry = $stmt->execute(array($doctorid));
              if($result_arry){
                return true;
              }
               else{
                return false;
              }
    	}

    	// =====================end delete Doctor details =================================

 public function checkifEmailActivation($email)
    {
       $status = 0;
       $sql ="SELECT status,email FROM doctor WHERE status = ? and email=?";
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

        public function loginDoctor($email, $password){
          try{
            $sql ='SELECT * FROM doctor WHERE email = :email';
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

    public function checkCodeEntered($generatedCode)
     {
       $sql ="SELECT generatedCode FROM doctor WHERE  generatedCode=?";
       $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($generatedCode));
       $num = $stmt->rowCount();
       if ($num ==1) { return true;}
       else {return false;}
     }

    public function UpdateStatusForDoctor($generatedCode)
       {
        $status =1;
        $sql ="UPDATE `doctor` SET `status` = ?  WHERE `generatedCode` = ?";
            $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($status,$generatedCode));
            if($result_arry){ return true;}
            else{return false;}
       }




       public function updateProfilePic($avatar,$id)
       {
          $sql ="UPDATE `doctor` SET `avatar` = ?  WHERE `id` = ?";
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($avatar,$id));
          if($result_arry){ return true;}
          else{return false;}
       }

        public function getdoctorProfilePicture($id)
        {
          $sql = "SELECT id,MDPCZ_ID,firstname,lastname,dob,gender,address,qualification,speciality,experience,phoneNumber,email,password,avatar,generatedCode,status,priceperappoinrmnt,bio,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate FROM doctor WHERE id=?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }





    public function logout($id)
    {
       $_SESSION['doctor_id'] = $id;
       unset($_SESSION['doctor_id']);
       session_destroy();
    }


    }