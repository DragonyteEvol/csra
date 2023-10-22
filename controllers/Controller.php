<?php
class Controller{

	public $controller;

	/* el contructor trae el controllador al que se accede desde la url y lo aloja en la clase */
	public function __construct()
	{
		$this->controller = $_GET["controller"];
	}

	/* retona la vista de inicio y trae sus datos en lista */
	public function index(){
		$data=$this->model->getAll();
		require_once("views/$this->controller/index.php");
	}

	/* despliega el formulario de creacion */
	public function create(){
		require_once("views/$this->controller/create.php");
	}

	/* retorna la vista de mostrar un solo elemento con la informacion del elemnto */
	public function show(){
		$id = $_GET["id"]; 
		$data=$this->model->selectById($id);
		require_once("views/$this->controller/show.php");
	}

	/* crea un elemento y redirecciona al inicio */
	public function insert(){
		$this->modelParams();
		$id = $this->model->insert();
		if($this->autosave){
			$this->model->saveChanges();
			header("Location: /$this->controller");
		}
		return $id;
	}

	/* modifica un elemento y redirecciona al inicio */
	public function update(){
		$id = $_GET["id"];
		$this->modelParams();
		$this->model->update($id);
		if($this->autosave){
			$this->model->saveChanges();
			header("Location: /$this->controller");
		}
	}

	/* borra un elemento y redireccion al inicio */
	public function delete(){
		$id = $_GET["id"];
		$this->model->delete($id);
		header("Location: /$this->controller");
	}

	public function search(){
		$search = $_GET["id"];
		$from= $_GET["from"];
		$to = $_GET["to"];
		$data = $this->model->search($search,$from,$to);
		echo json_encode($data);
	}

	/* relaciona los parametros de entrado por POST con parametros de la clase */
	public function modelParams(){
		foreach(array_keys($_POST) as $key){
			$this->model->{$key} = $_POST[$key];
		}
	}

	/* index - lista todos los elementos */
	/* show - muestra un elemento por su id */
	/* create - crea un elemento */
	/* update - modifica un elemento */
	/* delete - borra un elemento */
}
?>
