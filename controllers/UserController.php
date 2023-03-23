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
		$id = $_GET["id"];
		$data=$this->model->getUserById($id);
		var_dump($data);
	}

	public function create(){
		$this->model->name = "test";
		$this->model->email = "test@hotmail.com";
		$this->model->password= "1234";
		$this->model->insert();
	}

	public function update(){
		$this->model->id = 1;
		$this->model->name = "pablo";
		$this->model->email = "test12@hotmail.com";
		$this->model->password= "1234";
		$this->model->update();
	}

	/* index - lista todos los elementos */
	/* show - muestra un elemento por su id */
	/* create - crea un elemento */
	/* update - modifica un elemento */
	/* delete - borra un elemento */
}
?>
