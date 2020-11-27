<?php

class Drugs
{
  
  private $db;

  public function __construct(){
      $this->db = new Database();
  }

  public function store($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$imageurl,$expiry_date)
  {
     
    $sql ="INSERT INTO madicines(name,quantity,usage,sideeffect,precautions,interation,overdose,imageurl,expiry_date) VALUES('$name','$quantity','$usage','$sideeffect','$precautions','$interation','$overdose','$imageurl','$expiry_date')";
       
                $stmt = $this->db->conn->prepare($sql);
                $result_arry = $stmt->execute(array($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$imageurl,$expiry_date));
                if($result_arry){
                       
                     return true;
                }
                else{
                   return false; 
                }
  }

  /** get all drug */

      public function getallDrugs()
      {
        $sql = "SELECT md.id,md.name,md.quantity,md.`usage`,md.sideeffect,md.precautions,md.interation,md.overdose,md.imageurl,md.price,md.expiry_date,md.created_on,p.fullname,md.pid FROM madicines AS md INNER JOIN pharmacy AS p ON md.pid = p.id ";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      /*=====================end get all drug===================================*/

    
    public function updateDrug($drug_id){}

    public function addTocart($drug_id,$client_id,$quantity,$pid,$price,$updateDrugQuantity)
    {
      $database = new Database();
      $total = $quantity*$price;
      $newUpdate = $updateDrugQuantity-$quantity;
      self::updateDrugQuantity($newUpdate,$drug_id);
      $sql ="INSERT INTO cart(drug_id,client_id,quantity,price,pid,total) VALUES('$drug_id','$client_id','$quantity','$price','$pid','$total')";
       
        $stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($drug_id,$client_id,$quantity,$pid,$price,$total));
        if($result_arry){return true;}
        else{return false;}
    }

    private static function updateDrugQuantity($newUpdate,$drug_id)
    {
      $database = new Database();
      $sql ="UPDATE `madicines` SET `quantity`=? WHERE `id` = ?";
      $stmt = $database->conn->prepare($sql);
      $result_arry = $stmt->execute(array($newUpdate,$drug_id));
      if($result_arry){return true;}
      else{return false;}
    }

    public function getallMyCart($client_id)
      {
         $database = new Database();
        $sql = "SELECT crt.id,crt.drug_id,crt.pid,crt.price,crt.quantity,crt.total,p.fullname,med.name,med.quantity AS medQuantity,crt.status FROM cart AS crt INNER JOIN madicines AS  med  ON crt.drug_id = med.id INNER JOIN pharmacy p ON crt.pid = p.id WHERE crt.client_id =?";
      $stmt = $database->conn->prepare($sql);
      $stmt->execute(array($client_id));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

       public function getallMyOrder($client_id)
      {
         $database = new Database();
        $sql = "SELECT crt.id,crt.drug_id,crt.pid,crt.price,crt.quantity,crt.total,p.fullname,med.name,med.quantity AS medQuantity,crt.status FROM cart AS crt INNER JOIN madicines AS  med  ON crt.drug_id = med.id INNER JOIN pharmacy p ON crt.pid = p.id WHERE crt.client_id =?";
          $stmt = $database->conn->prepare($sql);
          $stmt->execute(array($client_id));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      

      public function getTotals($client_id)
      {
         $database = new Database();
        $sql = "SELECT SUM(total) AS totalA FROM cart WHERE client_id =?";
      $stmt = $database->conn->prepare($sql);
      $stmt->execute(array($client_id));
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function getQuantity($drug_id)
      {
      $database = new Database();
        $sql = "SELECT quantity FROM madicines WHERE id =?";
        $stmt = $database->conn->prepare($sql);
        $stmt->execute(array($drug_id));
        $quantity=$stmt->fetch();
         return $quantity;
      }

      public function RemoveCart($cartid,$cartQnty,$medqnty,$drug_id)
      {
        $database = new Database();
        $newQnty = $medqnty+$cartQnty;
        self::updateDrugQuantityNumber($newQnty,$drug_id);
        $sql ='DELETE FROM cart WHERE id = ?';
          $stmt = $database->conn->prepare($sql);
          $result_arry = $stmt->execute(array($cartid));
          if($result_arry){
            return true;
          }
           else{
            return false;
          }
      }

      private static function updateDrugQuantityNumber($newQnty,$drug_id)
      {
        $database = new Database();
        $sql ="UPDATE `madicines` SET `quantity`=? WHERE `id` = ?";
        $stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($newQnty,$drug_id));
        if($result_arry){return true;}
        else{return false;}
      }


      public function checkout($client_id,$pid,$total)
      {
       $database = new Database();
       $sql ="INSERT INTO `order` (`client_id`, `pid`, `total`) VALUES ('$client_id', '$pid', '$total')";
       $stmt = $database->conn->prepare($sql);
       $result_arry = $stmt->execute(array($client_id,$pid,$total));
       if($result_arry){return true;}
        else{return false;}
      }

      public function getallMyOrdersForClient($client_id)
      {
         $database = new Database();
        $sql = "SELECT op.id,op.client_id,op.total,op.`status`,crt.fullname,crt.phoneNumber,crt.address,p.fullname AS pharmName,p.phoneNumber AS pharnNumber,DATE(op.created_at ) AS dateorder FROM `order` AS op INNER JOIN `client` AS crt ON op.client_id = crt.id INNER JOIN pharmacy p ON op.pid = p.id  WHERE op.client_id=?";
          $stmt = $database->conn->prepare($sql);
          $stmt->execute(array($client_id));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function getallMyOrdersForPharmacy($pid)
      {
         $database = new Database();
        $sql = "SELECT op.id,op.client_id,op.total,op.`status`,crt.fullname,crt.phoneNumber,crt.address,p.fullname AS pharmName,p.phoneNumber AS pharnNumber,DATE(op.created_at ) AS dateorder FROM `order` AS op INNER JOIN `client` AS crt ON op.client_id = crt.id INNER JOIN pharmacy p ON op.pid = p.id  WHERE op.pid=?";
          $stmt = $database->conn->prepare($sql);
          $stmt->execute(array($pid));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }



}