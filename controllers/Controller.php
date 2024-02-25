<?php
require_once("models/AccessModel.php");
class Controller{

	public $controller;
	private $access;
	protected $module_with_out_access = ["login","register"];

	/* el contructor trae el controllador al que se accede desde la url y lo aloja en la clase */
	public function __construct()
	{
		$this->controller = $_GET["controller"];
		/* validacion de login */
		session_start();
		if(!isset($_SESSION["user"])&&
			!in_array($this->controller,
				$this->module_with_out_access)){
			header("location:/login");
		}
	}

	/* retona la vista de inicio y trae sus datos en lista */
	public function index(){
		$this->checkAccess("r");
		$data=$this->model->getAll();
		require_once("views/$this->controller/index.php");
	}

	/* despliega el formulario de creacion */
	public function create(){
		$this->checkAccess("w");
		require_once("views/$this->controller/create.php");
	}

	/* retorna la vista de mostrar un solo elemento con la informacion del elemnto */
	public function show(){
		$this->checkAccess("r");
		$id = $_GET["id"]; 
		$data=$this->model->selectById($id);
		require_once("views/$this->controller/show.php");
	}

	/* crea un elemento y redirecciona al inicio */
	public function insert(){
		$this->checkAccess("w");
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
		$this->checkAccess("u");
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
		$this->checkAccess("d");
		$id = $_GET["id"];
		$this->model->delete($id);
		header("Location: /$this->controller");
	}

	public function search(){
		$this->checkAccess("r");
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

	public function checkAccess($bit){
		/* generar accesos */
		$access_model = new AccessModel();
		$accesses = $access_model->getAccess($_SESSION["id"]);
		foreach($accesses as $access){
			if($access["module"]==$this->controller && $access[$bit]==1){
				return true;
			}	
		}		
		header("location:/utils/unauthorized");
	}

	/* index - lista todos los elementos */
	/* show - muestra un elemento por su id */
	/* create - crea un elemento */
	/* update - modifica un elemento */
	/* delete - borra un elemento */
}
?>
