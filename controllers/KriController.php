<?php
require_once("models/KriModel.php");
require_once("models/QualifierModel.php");
class KriController extends Controller{

	public $autosave = false;

	public function __construct(){
		parent::__construct();
		/* modelos */
		$this->model = new KriModel();
		$this->qualifier_model = new QualifierModel();
	}

	/* inserta un kri en base de datos y sus calificadores */
	/* 	retorna una redireccion al index de kri */
	public function insert(){
		$this->modelParams();
		$id = $this->model->insert();
		$this->qualifier_model->insertQualifiers($id,$this->model->db);
		$this->model->saveChanges();
		header("Location: /$this->controller");
	}

}
?>
