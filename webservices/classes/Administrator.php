<?php
//CRUD
class Administrator
{
  private $db;
  public function __construct(){
      $this->db = new Database();
  }
	
/*==========================Admin panel==============================*/ 
	public function loginAdministrator($username, $password){
	  try{
	    
	    $sql ='SELECT * FROM admin WHERE username = :username';
	    $stmt = $this->db->conn->prepare($sql);
	    $stmt->bindParam(':username', $username);
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
/*==========================Admin panel==============================*/ 
  public function registraterAdmin($firstname,$lastname,$email,$phoneNumber,$password,$generatedCode){
  	
          $options = [
              'cost' => 12,
          ];
          $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                   
          $sql ="INSERT INTO admin(firstname,lastname,email,phoneNumber,password,generatedCode) VALUES('$firstname','$lastname','$email','$phoneNumber','$encrypetedpass','$generatedCode')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($firstname,$lastname,$email,$phoneNumber,$encrypetedpass,$generatedCode));
          if($result_arry){
                 
               return true;
          }
          else{
             return false; 
          }
  }

  
 /*========================== PATIENT==============================*/ 

      public function admincreateClientAccount($firstname,$lastname,$email,$phoneNumber,$password,$gender,$address,$generatedCode,$phonegeneratedCode)
      {
         
          $status =1;
          $options = [
              'cost' => 12,
          ];
          $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                   
          $sql ="INSERT INTO client(firstname,lastname,email,phoneNumber,password,gender,address,generatedCode,phonegeneratedCode,status) VALUES('$firstname','$lastname','$email','$phoneNumber','$encrypetedpass','$gender','$address','$generatedCode','$phonegeneratedCode','$status')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($firstname,$lastname,$email,$phoneNumber,$encrypetedpass,$gender,$address,$generatedCode,$phonegeneratedCode,$status));
          if($result_arry){
                 
               return true;
          }
          else{
             return false; 
          }
      }

 
  public function totalAllClients()
  {
    $sql = "SELECT COUNT(*) AS totalClient FROM client";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  
   /*==========================Patient panel==============================*/
 


/*=========================================ALL DOCTOR==================================================*/
  public function admincreateDoctorAccount($mdpcz_id,$firstname,$lastname,$dob,$gender,$qualification,$speciality,$experience,$address,$phoneNumber,$emailAddress,$password,$generatedCode)
        {
        $adminstatus = "Approved";
        $status =1;
         $options = [
                        'cost' => 12,
                    ];
                $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                $sql ="INSERT INTO `doctor`(`MDPCZ_ID`, `firstname`, `lastname`, `dob`,`gender`,`address`,`qualification`,`speciality`,`experience`,`phoneNumber`,`email`,`password`,`generatedCode`,`adminstatus`,`status`) VALUES('$mdpcz_id','$firstname','$lastname','$dob','$gender','$address','$qualification','$speciality','$experience','$phoneNumber','$emailAddress','$encrypetedpass','$generatedCode','$adminstatus','$status')";
               
       
                $stmt = $this->db->conn->prepare($sql);
                $result_arry = $stmt->execute(array($mdpcz_id,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$encrypetedpass,$generatedCode,$adminstatus,$status));
                if($result_arry){
                       
                     return true;
                }
                else{
                   return false; 
                }
      }
      /* =====================end create Doctor account==============================*/
public function totalDoctors()
  {
    $sql = "SELECT COUNT(*) AS totalDoctors FROM doctor";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function totalPendingDoctors()
  {
    $adminstatus = 'Pending';
    $sql = "SELECT COUNT(*) AS totalDoctors FROM doctor where  adminstatus =?";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute(array($adminstatus));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
public function ApproveDoc($id)
{
   $adminstatus="Approved";
    $sql ="UPDATE `doctor` SET `adminstatus` = ?  WHERE `id` = ?";
    $stmt = $this->db->conn->prepare($sql);
    $result_arry = $stmt->execute(array($adminstatus,$id));
    if($result_arry){ return true;}
    else{return false;}
}

public function RejectDoct($id)
{
   $adminstatus="Rejected";
    $sql ="UPDATE `doctor` SET `adminstatus` = ?  WHERE `id` = ?";
    $stmt = $this->db->conn->prepare($sql);
    $result_arry = $stmt->execute(array($adminstatus,$id));
    if($result_arry){ return true;}
    else{return false;}
}

public function getallDoctorswithPendingStatus()
{
  $adminstatus = 'Pending';
  $sql = "SELECT id,MDPCZ_ID,fullname,dob,gender,address,qualification,speciality,experience,phoneNumber,email,password,avatar,generatedCode,status,priceperappoinrmnt,bio,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate,adminstatus FROM doctor WHERE adminstatus =?";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->execute(array($adminstatus));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getallDoctorswithApprovedStatus()
{
  $adminstatus = 'Approved';
  $sql = "SELECT id,MDPCZ_ID,fullname,dob,gender,address,qualification,speciality,experience,phoneNumber,email,password,avatar,generatedCode,status,priceperappoinrmnt,bio,country,city,facebook,youtube,skype,twitter,instagram,viber,MONTHNAME(created_on) AS myMonthName,DAYOFMONTH(created_on) AS mydayofMonths,DAYNAME(created_on) AS dataName,year(created_on) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate,adminstatus FROM doctor WHERE adminstatus =?";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->execute(array($adminstatus));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function CountDoctorswithPendingStatus()
{
  $adminstatus = 'Pending';
  $sql = "SELECT COUNT(*) FROM doctor WHERE adminstatus =?";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->execute(array($adminstatus));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/*=========================================END ALL DOCTOR==================================================*/
  

/*========================================= ALL PHARMACY==================================================*/
  public function admincreatePharmAccount($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$password,$generatedCode){
    $status=1;
    $adminstatus="Approved";
     $options = [
              'cost' => 12,
          ];
          $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
                   
          $sql ="INSERT INTO `pharmacy`(`firstname`,`lastname`,`dob`,`gender`,`address`,`qualification`,`phoneNumber`,`email`,`password`,`generatedCode`,`status`,`adminstatus`) VALUES('$firstname','$lastname','$dob','$gender','$address','$qualification','$phoneNumber','$emailAddress','$encrypetedpass','$generatedCode','$status','$adminstatus')";
       
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$password,$generatedCode,$status,$adminstatus));
          if($result_arry){return true;}
          else{return false;}
  }

  public function adminUpdatePharmacyDetails($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$phid){

    $sql ="UPDATE `pharmacy` SET `firstname`=?, `lastname`=?, `dob`=?,`gender`=?, `address`=?, `qualification`=?, `phoneNumber`=?, `email`=?WHERE  `id`=?";
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$phid));
        if($result_arry){ return true;}
        else{return false;}
  }

public function deletePharmacyDetails($pid)
{
  $sql ='DELETE FROM pharmacy WHERE id = ?';
        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($pid));
        if($result_arry){return true;}
         else{return false;}
}


public function ApprovePharmacist($id)
{
   $adminstatus="Approved";
    $sql ="UPDATE `pharmacy` SET `adminstatus` = ?  WHERE `id` = ?";
    $stmt = $this->db->conn->prepare($sql);
    $result_arry = $stmt->execute(array($adminstatus,$id));
    if($result_arry){ return true;}
    else{return false;}
}

public function RejectPharmacist($id)
{
   $adminstatus="Rejected";
    $sql ="UPDATE `pharmacy` SET `adminstatus` = ?  WHERE `id` = ?";
    $stmt = $this->db->conn->prepare($sql);
    $result_arry = $stmt->execute(array($adminstatus,$id));
    if($result_arry){ return true;}
    else{return false;}
}
/*=========================================END ALL PHARMACY==================================================*/





















public function logout($id)
    {
      
      $_SESSION['admin_id'] = $id;
       unset($_SESSION['admin_id']);
       session_destroy();
    }
}