<?php
require_once("models/RiskModel.php");
class RiskController extends Controller{
	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RiskModel();
}
}
?>
