<?php
/* variables de configuracion */
/* require_once("config.php"); */
class Connection{
	public static function connect(){
		include "config.php" ;
		try{
			$conn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
			return $conn;
		}catch(PDOException $e){
			die("Connection Failed: " . $e->getMessage());
		}
	}
}
?>
