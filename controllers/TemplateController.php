<?php
require_once("models/TemplateModel.php");
class TemplateController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new TemplateModel();
	}

	/* Genera una busqueda de un evento en osiem */
	/* retorna la informacion consultado en formato json para ser consumida por el frontend */
	public function search(){
		$search = $_GET["id"]; 
		$data = $this->model->search($search);
		echo json_encode($data);
	}
}
?>
