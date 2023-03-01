<?php
	$server = "mysql";
	$username = "root";
	$password = "1234";
	$database = "csra";

	try{
		$conn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
	}catch(PDOException $e){
		die("Connection Failed: " . $e->getMessage());
	}
?>
