<?php
require_once("models/UserModel.php");
class UserController{
	private $model;

	public function __construct(){
		$this->model = new UserModel();
	}
	public function index(){
		$data=$this->model->getUsers();
		var_dump($data);
	}

	public function show(){
		$data=$this->model->getUserById(2);
		var_dump($data);
	}

	/* index - lista todos los elementos */
	/* show - muestra un elemento por su id */
	/* create - crea un elemento */
	/* update - modifica un elemento */
	/* delete - borra un elemento */
}
?>
