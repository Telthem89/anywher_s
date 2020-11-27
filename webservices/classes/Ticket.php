<?php 

class Ticket{
    private $db;
    public function __construct(){
        $this->db = new Database();
     }
    public function BookDemo($title ,$fullname,$phoneNumber,$email,$speciality,$date_u_a_free,$time_u_a_free,$reason_for_booking){
        $sql ="INSERT INTO `bookdemo`(`title`, `fullname`, `phoneNumber`, `email`,`speciality`,`date_u_a_free`,`time_u_a_free`,`reason_for_booking`) VALUES('$title','$fullname','$phoneNumber','$email','$speciality','$date_u_a_free','$time_u_a_free','$reason_for_booking')";

        $stmt = $this->db->conn->prepare($sql);
        $result_arry = $stmt->execute(array($title ,$fullname,$phoneNumber,$email,$speciality,$date_u_a_free,$time_u_a_free,$reason_for_booking));
        if($result_arry){
                
                return true;
        }
        else{
            return false; 
        }
        
    }

    public function checkbookdemoExist($email){
        $sql = 'SELECT email from bookdemo WHERE email =?';
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
}