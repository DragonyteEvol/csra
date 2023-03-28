<?php
require_once("models/UserModel.php");
class LoginController extends Controller{

	public function __construct(){
		session_start();
		$this->model = new UserModel();
		parent::__construct();
	}

	/* valdia si los datos ingresador en el formulario de inicio de sesion */ 
	/* 	coinciden y crea una sesion si es asi */
	public function login(){
		foreach(array_keys($_POST) as $key){
			$this->model->{$key} = $_POST[$key];
		}
		$user = $this->model->selectByEmail();
		if(count($user)>0){
			if(password_verify($this->model->password,$user[0]["password"])){
				$_SESSION["user"] = $user[0]->name;
			}else{
				$_SESSION["error"] = "error";
				header("Location: /login");
			}
		}else{
			$_SESSION["error"] = "error";
			header("Location: /login");
		}
	}
}
?>
