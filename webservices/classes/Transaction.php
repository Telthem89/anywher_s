<?php

class Transaction
{
    private $db;
    public function __construct(){
        $this->db = new Database();
     }
	public function makePayment($description,$amount,$currency,$receiver,$doctid,$client_id,$senderNumber)
	{

		$sql ="INSERT INTO transactions(description,amount,currency,receiver,client_id,doctor_id,senderNumber) VALUES('$description','$amount','$currency','$receiver','$doctid','$client_id','$senderNumber')";      
            $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($description,$amount,$currency,$receiver,$doctid,$client_id,$senderNumber));
            if($result_arry){return true;}
            else{return false;}
	}

	public function updateBookingStaus($client_id)
	{

		$sql ="UPDATE booking SET paymentStatus = 'Paid' WHERE client_id=?";      
            $stmt = $this->db->conn->prepare($sql);
            $result_arry = $stmt->execute(array($client_id));
            if($result_arry){return true;}
            else{return false;}
	}


	 public function DoctorCountRevenues($doctor_id)
        {
            $sql = "SELECT SUM(amount) AS total FROM transactions WHERE doctor_id =?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(array($doctor_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}

