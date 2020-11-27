<?php
/**
 *  |--------------------------------------------------------------------------
    | 					Drugs  
    @             Add edit Delete drug
    |--------------------------------------------------------------------------
 */
class Prescription
{
    private $db;	
    public function __construct(){
        $this->db = new Database();
     }
	
	public function Prescrion($prescnumber,$doctor_id,$client_id,$drugs,$dusage,$doc)
	{
		$sql ="INSERT INTO prescription(prescnumber,doctor_id,client_id,drugs,dusage,doc) VALUES('$prescnumber','$doctor_id','$client_id','$drugs','$dusage','$doc')";
       
                $stmt = $this->db->conn->prepare($sql);
                $result_arry = $stmt->execute(array($prescnumber,$doctor_id,$client_id,$drugs,$dusage,$doc));
                if($result_arry){
                       
                     return true;
                }
                else{
                   return false; 
                }
	}

	/** get all drug */

    	public function DoctorgetallPrescription($doctor_id)
    	{
            $sql = "SELECT id,doctor_id,client_id,drugs,dusage FROM prescription WHERE doctor_id =?";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->execute(array($doctor_id));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	}

        public function ClientgetallPrescription($client_id)
        {
            $sql = "SELECT pr.id,pr.prescnumber,pr.doc,pr.drugs,pr.dusage,CONCAT(c.firstname,'  ',c.lastname) AS fullname,c.address AS c_address,c.gender,c.phoneNumber AS c_phone,c.avatar,c.email,dr.MDPCZ_ID,CONCAT(dr.firstname,'  ',dr.lastname) AS doctname,dr.speciality,dr.gender,dr.phoneNumber,dr.email,dr.address,dr.speciality,DATE(pr.created_on) AS dateprescribe,YEAR(CURRENT_TIMESTAMP) - YEAR(c.dob) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(c.dob, 5)) as age   FROM prescription AS pr INNER JOIN client AS c ON pr.client_id = c.id INNER JOIN doctor AS dr ON pr.doctor_id = dr.id WHERE client_id =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($client_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /*========================================Get Patient History=========================================*/

        public function getPatientMedicalHistory($doctor_id)
        {
           $sql = "SELECT DISTINCT c.fullname,p.client_id,c.dob,c.phoneNumber,c.gender,c.email,YEAR(CURRENT_TIMESTAMP) - YEAR(c.dob) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(c.dob, 5)) as age  FROM  prescription AS p INNER JOIN client AS c ON p.client_id = c.id INNER JOIN doctor AS d ON p.doctor_id = d.id WHERE p.doctor_id=?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }


         public function getPatientName($client_id)
        {
           $sql = "SELECT fullname,gender,avatar from client WHERE id=?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($client_id));
            $return = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $return;
        }

      /*========================================Get Patient History=========================================*/




       /*========================================Get individual Patient Medical History History=========================================*/

        public function getPatientPrecriptionHistory($client_id)
        {
           $sql = "SELECT pr.id,pr.client_id,pr.prescnumber,pr.doc,pr.drugs,pr.dusage,c.fullname,c.address AS c_address,c.gender,c.phoneNumber AS c_phone,c.avatar,c.email,DATE(pr.created_on) AS dateprescribe,YEAR(CURRENT_TIMESTAMP) - YEAR(c.dob) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(c.dob, 5)) as age  FROM prescription AS pr INNER JOIN client AS c ON pr.client_id = c.id  INNER JOIN doctor AS dr ON pr.doctor_id = dr.id WHERE pr.client_id=?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($client_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }

      /*========================================Get Patient History=========================================*/


        
        public function DoctorCountPrescription($doctor_id)
        {
            $sql = "SELECT COUNT(*) AS total FROM prescription WHERE doctor_id =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function DoctorCountBookings($doctor_id)
        {
            $sql = "SELECT COUNT(*) AS total FROM booking WHERE doctor_id =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        

    	/*=====================end get all drug===================================*/


         public function ClientCountPrescription($client_id)
        {
            $sql = "SELECT COUNT(*) AS total FROM prescription WHERE client_id =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($client_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function totalPatienthist($doctor_id)
        {
          $sql = "SELECT  COUNT(DISTINCT client_id) AS totalPatienthist FROM prescription WHERE doctor_id=?";
          $stmt = $this->db->conn->prepare($sql);
          $stmt->execute(array($doctor_id));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
}