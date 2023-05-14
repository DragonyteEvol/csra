<?php
require_once("models/PropertieModel.php");
class PropertieController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new PropertieModel();
	}
}
?>
