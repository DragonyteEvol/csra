<?php 
class UserModel{
	private $db;
	private $users;

	public function __construct(){
		$this->db=Connection::connect();
		$this->users=array();
	}

	public function getUsers(){
		$sql = "SELECT * FROM users;";
		$state = $this->db->prepare($sql);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->users[]=$row;
			}
			return $this->users;
		}
	}

	public function getUserById($id){
		$sql = "SELECT * FROM users WHERE id=:id";
		$state = $this->db->prepare($sql);
		$state->bindParam(":id",$id);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->users[]=$row;
			}
			return $this->users;
		}
	}
}
/* if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["name"])){ */
/* 	$sql = "INSERT INTO users(name,email,password) values(:name,:email,:password)"; */
/* 	$state = $conn->prepare($sql); */
/* 	$state->bindParam(":name",$_POST["name"]); */
/* 	$state->bindParam(":email",$_POST["email"]); */
/* 	$password = password_hash($_POST["password"],PASSWORD_BCRYPT); */
/* 	$state->bindParam(":password",$password); */
/* 	if($state->execute()){ */
/* 		$message = "Succesfully created new user"; */
/* 	}else{ */
/* 		$message = "Sorry, We cant create the user"; */
/* 	} */
/* } */
?>
