<?php
class UserController{
	public function index(){

		require_once("models/UserModel.php");
		$user = new UserModel();
		$data=$user->getUsers();
		var_dump($data);
	}
}
?>
