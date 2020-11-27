<?php

/**
 *  |--------------------------------------------------------------------------
    | 								BOOKINGS
    |--------------------------------------------------------------------------
    |
 */
class Booking
{
    private $db;
	public function __construct(){
          $this->db = new Database();
      }
public function getBookingBelongtoDoctor($doctor_id){}


	public function myBooking($description,$client_id,$doctor_id,$book_time)
	{
	
		$sql ="INSERT INTO booking(description,client_id,doctor_id,book_time) VALUES('$description','$client_id','$doctor_id','$book_time')";
       
                $stmt = $this->db->conn->prepare($sql);
                $result_arry = $stmt->execute(array($description,$client_id,$doctor_id,$book_time));
                if($result_arry){
                       
                     return true;
                }
                else{
                   return false; 
                }
	}

    public function myNewBooking($patient_id)
    {
        
        $sql = "SELECT bk.id,bk.description,bk.client_id,TIME(bk.book_time) AS booktime, DATE(bk.book_time) AS bookdate,MONTHNAME(bk.book_time) AS myMonthName,DAYOFMONTH(bk.book_time) AS mydayofMonths,DAYNAME(bk.book_time) AS dataName,year(bk.book_time) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate ,CONCAT(d.firstname,' ',d.lastname) AS doctorName,d.speciality,bk.paymentStatus,bk.reschudule_status,bk.readstatus,bk.reschedule FROM booking AS bk INNER JOIN doctor d ON bk.doctor_id = d.id WHERE bk.client_id=?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($patient_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /*==============================Doctor Reschedule Appointment========================================*/
    public function RescheduleAppointment($book_time,$reschedule,$client_id)
    {
        
        $reschudule_status =1;
        $sql ="UPDATE `booking` SET `book_time` = ? ,`reschedule` = ?,`reschudule_status` = ?  WHERE `client_id` = ?";
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($book_time,$reschedule,$reschudule_status,$client_id));
          if($result_arry){ return true;}
          else{return false;}
    }
    /*==============================Doctor Reschedule Appointment========================================*/



/*==============================Doctor Reschedule Appointment========================================*/
    public function UpdateReadStatusforBookingAppointment($book_id,$client_id)
    {
        
        $readstatus =1;
        $sql ="UPDATE `booking` SET `readstatus` = ?  WHERE `id` = ? || client_id =?";
          $stmt = $this->db->conn->prepare($sql);
          $result_arry = $stmt->execute(array($book_id,$client_id,$readstatus));
          if($result_arry){ return true;}
          else{return false;}
    }
    /*==============================Doctor Reschedule Appointment========================================*/




	


	 /**
     * Display the specified resource for patient who made appoinmet.
     *
     * @param  int  $patient id
     * @return Response
     */
    public function getBookingByPatient_id($patient_id)
    {
       
        $sql = "SELECT bk.id,bk.description,TIME(bk.book_time) AS booktime, DATE(bk.book_time) AS bookdate,MONTHNAME(bk.book_time) AS myMonthName,DAYOFMONTH(bk.book_time) AS mydayofMonths,DAYNAME(bk.book_time) AS dataName,year(bk.book_time) AS yearname,CONCAT(firstname,' ',lastname) AS fullname ,DATE(created_on) AS datecreate ,CONCAT(d.firstname,' ',d.lastname) AS doctorName,d.speciality,bk.paymentStatus FROM booking AS bk INNER JOIN doctor d ON bk.doctor_id = d.id WHERE bk.client_id=?";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->execute(array($patient_id));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * Display the specified resource for DOCTOR.
     *
     * @param  int  $patient id
     * @return Response
     */
    public function DoctorGetHisorHerAppointments($doctor_id)
    {
       
        $paymentStatus ="Paid";
        $sql = "SELECT bk.id,bk.client_id,bk.description,TIME(bk.book_time) AS booktime, DATE(bk.book_time) AS bookdate,CONCAT(cl.firstname,' ',cl.lastname) AS patientName,cl.email,cl.phoneNumber,bk.paymentStatus FROM booking AS bk INNER JOIN client AS cl ON bk.client_id = cl.id WHERE bk.doctor_id=? && paymentStatus =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id,$paymentStatus));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTotalAppointment($doctor_id)
    {
      
        $sql = "SELECT COUNT(*) AS totatApointment FROM booking WHERE doctor_id=?";
        $stmt = $this->db->conn->prepare($sql);
         $stmt->execute(array($doctor_id));
        $result = $stmt->fetch();
        return $result;
    }

}