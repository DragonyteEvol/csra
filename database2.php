<?php
/* variables de configuracion */
/* require_once("config.php"); */
class Connection{

	public static function connect(){
		include "config.php" ;
		try{
			$conn = new PDO("mysql:host=$server2;dbname=$database2",$username2,$password2);
			return $conn;
		}catch(PDOException $e){
			die("Connection Failed: " . $e->getMessage());
		}
	}
}
?>

