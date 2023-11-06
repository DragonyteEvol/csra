<?php
require_once("models/QualifierModel.php");
class QualifierController extends Controller{

	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new QualifierModel();
	}
}
?>
