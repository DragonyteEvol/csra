<?php
require_once("models/ModuleModel.php");
class ModuleController extends Controller{

	public $autosave=true;

	public function __construct(){
		parent::__construct();
		$this->model = new ModuleModel();
	}
}
?>
