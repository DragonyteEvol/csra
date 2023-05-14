<?php
require_once("models/KriModel.php");
require_once("models/QualifierModel.php");
class KriController extends Controller{

	public $autosave = false;

	public function __construct(){
		parent::__construct();
		$this->model = new KriModel();
		$this->qualifier_model = new QualifierModel();
	}

	/* public function insert(){ */
	/* 	$this->modelParams(); */
	/* 	$id = $this->model->insert(); */
	/* 	$qualifier= new QualifierModel(); */
	/* 	$qualifier->severalInsert($id); */
	/* 	$qualifier->saveChanges(); */
	/* 	$this->model->saveChanges(); */
	/* 	header("Location: /$this->controller"); */
	/* } */

	public function insert(){
		$this->modelParams();
		$id = $this->model->insert();
		$this->qualifier_model->insertQualifiers($id,$this->model->db);
		$this->model->saveChanges();
		header("Location: /$this->controller");
	}

}
?>
