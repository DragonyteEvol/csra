<?php
require_once("models/SourceModel.php");
class SourceController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new SourceModel();
	}

	public function index()
	{
		$data = $this->model->getAll();
		foreach($data as $source){
			echo $source["vendor"] . "<BR>";
		}
	}
}
?>
