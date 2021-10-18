<?php
	class Db{
		private $conn;
		private static $instance = null;
		 
		private function __construct($user,$pass,$db,$server){
			$this->conn = new PDO( "sqlsrv:server=$server ; Database=$db", $user, $pass);
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
		 }
		 
		 public static function connect($user,$pass,$db,$server){
			if(!self::$instance){	
				try
				{  
					self::$instance = new Db($user,$pass,$db,$server);
				}catch(Exception $e){   
					die( print_r( $e->getMessage() ) );   
				}  
			}
			return self::$instance->conn;
		 }
	}
?>