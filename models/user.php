<?php 
require("database.php");
$message= "";
if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["name"])){
	$sql = "INSERT INTO users(name,email,password) values(:name,:email,:password)";
	$state = $conn->prepare($sql);
	$state->bindParam(":name",$_POST["name"]);
	$state->bindParam(":email",$_POST["email"]);
	$password = password_hash($_POST["password"],PASSWORD_BCRYPT);
	$state->bindParam(":password",$password);
	if($state->execute()){
		$message = "Succesfully created new user";
	}else{
		$message = "Sorry, We cant create the user";
	}
}
?>
