<?php
require_once("models/RoleModel.php");
class RoleController extends Controller{

	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RoleModel();
	}
}
?>
