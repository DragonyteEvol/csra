<?php
/* variables de configuracion */
/* require_once("config.php"); */
class Connection{

	public static function connect($second_database){
		include "config.php" ;
		try{
			if($second_database){
				$conn = new PDO("mysql:host=$server2;dbname=$database2",$username2,$password2);
			}else{
				$conn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
			}
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		}catch(PDOException $e){
			die("Connection Failed: " . $e->getMessage());
		}
	}
}
?>
