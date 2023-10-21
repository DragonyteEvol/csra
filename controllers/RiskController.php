<?php
require_once("models/RiskModel.php");
class RiskController extends Controller{
	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RiskModel();
	}

	/* retorna la vista de mostrar un solo elemento con la informacion del elemnto */
	public function show(){
		$id = $_GET["id"]; 
		$data=$this->model->selectById($id);
		$data["score"] = $this->model->getScore($data["kris"]);
		require_once("views/$this->controller/show.php");
	}
}
?>
