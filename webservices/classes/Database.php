<?php

class Database
{
	  /*
    |--------------------------------------------------------------------------
    | Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for a database work.
        $host = 'localhost';
        $user = 'sagehill_usersage_remotehealth';
        $pass = '@usersage_remotehealth#';
        $db = 'sagehill_sage_remotehealth';
    |
    */
	public $conn;
    public function __construct()
    {
         $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'sagehill_sage_remotehealth';
        try {
        	$this->conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         /*
	    |--------------------------------------------------------------------------
	    | if there is no database this error will be displayed 
	    |--------------------------------------------------------------------------
	    */
        } catch (Exception $e) {
        	die(json_encode(array("message"=>"Cannot connect to DB", "response"=>false)));
        }
    }

}