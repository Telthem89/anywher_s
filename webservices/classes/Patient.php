<?php

    class Patient
    {
      private $db;
      public function __construct(){
          $this->db = new Database();
      }
    	
    	public function createClientAccount($fullname,$email,$phoneNumber,$password,$generatedCode)
      {
         $options = [
              'cost' => 12,
          ];
          $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                   
          $sql ="INSERT INTO client(fullname,email,phoneNumber,password,generatedCode) VALUES('$fullname','$email','$phoneNumber','$encrypetedpass','$generatedCode')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($fullname,$email,$phoneNumber,$password,$generatedCode));
          if($result_arry){
                 
               return true;
          }
          else{
             return false; 
          }
      }

public function updateClientinfo($firstname,$lastname,$email,$phoneNumber,$password,$gender,$dob,$address,$id)
  {
     $options = [
          'cost' => 12,
      ];
      $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
               
     
      $sql ="UPDATE `client` SET `firstname`=?,`lastname`=?,`email`=?,`phoneNumber`=?,`password`=?,`gender`=?,`dob`=?,`address`=? WHERE id=?"; 
      $stmt = $this->db->conn->prepare($sql);
      $result_arry = $stmt->execute(array($firstname,$lastname,$email,$phoneNumber,$encrypetedpass,$gender,$dob,$address,$id));
    if($result_arry){ return true;}
    else{return false;}
  }
  public function updateClientInform($firstname,$lastname,$email,$phoneNumber,$gender,$dob,$address,$id)
  {
      $sql ="UPDATE `client` SET `firstname`=?,`lastname`=?,`email`=?,`phoneNumber`=?,`gender`=?,`dob`=?,`address`=? WHERE id=?"; 
      $stmt = $this->db->conn->prepare($sql);
      $result_arry = $stmt->execute(array($firstname,$lastname,$email,$phoneNumber,$gender,$dob,$address,$id));
    if($result_arry){ return true;}
    else{return false;}
  }


  public function updateClientPassword($password,$email)
  {
      $options = [
          'cost' => 12,
        ];
        $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
        $sql ="UPDATE `client` SET `password`=? WHERE `email` = ?";
         $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($encrypetedpass,$email));
        if($result_arry){
            
             return true;
        }
        else{
           return false; 
        }
  }



       public function checkClientExist($email){
             $sql ="SELECT email FROM client WHERE email = ?";
             $stmt = $this->db->conn->prepare($sql);
             $stmt->execute(array($email));
             $num = $stmt->rowCount();
             if ($num ==1) {return true;}
             else {return false;}
         }

    public function checkifEmailActivation($email)
    {
       $status = 0;
       $sql ="SELECT status,email FROM client WHERE status = ? and email=?";
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

    public function checkifPhoneNumberIsExist($phone)
    {
       $sql ="SELECT phoneNumber FROM client WHERE phoneNumber = ?";
       $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($phone));
       $num = $stmt->rowCount();
       if ($num ==1) { return true; }
       else { return false; }
    }
    	
    public function getmedicalhistory($patient_id)
    {
      $sql = "SELECT id,patient_id,drugs,allegicMedication,otherdeases,med_doc,created_at FROM medicalhistory WHERE patient_id=?";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->execute(array($patient_id));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


     
   

    	public function getallClients()
    	{
        $sql = "SELECT id,firstname,lastname,CONCAT(firstname,' ',lastname) AS fullname,email,phoneNumber,password,avatar,generatedCode,status,DATE(created_at) AS dtcreated FROM client";
  			$stmt = $this->db->conn->prepare($sql);
  			$stmt->execute();
  			return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	}

    	/*=====================end get all clients===================================*/
      /**get client by id* */

    	public function getClientBy_id($id)
    	{
        $sql = "SELECT id,firstname,lastname,fullname,email,phoneNumber,`password`,gender,dob,address,avatar,`status`,`phoneStatus`,created_at,YEAR(CURRENT_TIMESTAMP) - YEAR(dob) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(dob, 5)) as age  FROM client WHERE id=?";
  			$stmt = $this->db->conn->prepare($sql);
  			$stmt->execute(array($id));
  			return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	}



    	/* =====================end get client by id===================================**/

      public function getProfilePicture($id)
      {
        $sql = "SELECT id,firstname,lastname,email,phoneNumber,`password`,gender,address,avatar,`status`,`phoneStatus`,created_at  FROM client WHERE id=?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

    /**
     * Show the form for updating the specified resource.
     *
     * @param  $patient_id,$drugs,$gender,$address,$allegicMedication,$otherdeases,$med_doc
     * @return Response
     */
  	    

    	public function updateClientDetails($patient_id,$drugs,$allegicMedication,$otherdeases,$med_doc)
    	{
         $sql ="INSERT INTO medicalhistory(patient_id,drugs,allegicMedication,otherdeases,med_doc) VALUES('$patient_id','$drugs','$allegicMedication','$otherdeases','$med_doc')";
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($patient_id,$drugs,$allegicMedication,$otherdeases,$med_doc));
          if($result_arry){
                 
               return true;
          }
          else{
             return false; 
          }
    	}

    	/* ================end update client details=================================*/

    public function getClientInformation($practionid)
    {
      $sql = "SELECT id,drugs,gender,address,allegicMedication,otherdeases,med_doc,created_at FROM medicalhistory WHERE patient_id=?";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute(array($id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    	public function deleteClientDetails($clientid)
    	{
         $sql ='DELETE FROM client WHERE id = ?';
		      $stmt = $this->db->conn->prepare($sql);
		      $result_arry = $stmt->execute(array($clientid));
		      if($result_arry){
		      	return true;
		      }
		       else{
		       	return false;
		      }
    	}

    
  public function loginUser($email, $password){
    try{
      $sql ='SELECT * FROM client WHERE email = :email';
      $stmt = $this->db->conn->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $m=$result['password'];
      $veryfypass = password_verify($password, $m);
      if($veryfypass==true){
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

    public function logout($id)
    {
      
      $_SESSION['patient_id'] = $id;
       unset($_SESSION['patient_id']);
       session_destroy();
    }



  public function UpdateStatusForClient($generatedCode)
   {
    $status =1;
    $sql ="UPDATE `client` SET `status` = ?  WHERE `generatedCode` = ?";
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($status,$generatedCode));
        if($result_arry){ return true;}
        else{return false;}
   }

    public function checkCodeEntered($generatedCode,$email)
     {
       $sql ="SELECT generatedCode,email FROM client WHERE generatedCode=? && email=?";
       $stmt = $this->db->conn->prepare($sql);
       $stmt->execute(array($generatedCode,$email));
       $num = $stmt->rowCount();
       if ($num ==1) {return true;}
       else {return false;}
     }

      public function updateProfilePicClient($avatar,$id)
       {
          $sql ="UPDATE `client` SET `avatar` = ?  WHERE `id` = ?";
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($avatar,$id));
          if($result_arry){ return true;}
          else{return false;}
       }

       public function DoctorPaymentDetails($docid)
       {
          $sql = "SELECT id,CONCAT(firstname,' ',lastname) AS doctorName,phoneNumber,priceperappoinrmnt FROM doctor WHERE id=?";
          $stmt = $this->db->conn->prepare($sql);
          $stmt->execute(array($docid));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }

 
  }




  