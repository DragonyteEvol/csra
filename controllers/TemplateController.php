<?php
require_once("models/TemplateModel.php");
class TemplateController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new TemplateModel();
	}

	public function search(){
		$search = $_GET["id"]; 
		$data = $this->model->search($search);
		echo json_encode($data);
	}
}
?>
