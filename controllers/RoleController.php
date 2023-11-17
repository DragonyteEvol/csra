<?php
require_once("models/RoleModel.php");
class RoleController extends Controller{

	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RoleModel();
	}

	public function index(){
		$data=$this->model->getAllRole();
		require_once("views/$this->controller/index.php");
	}

	public function insert(){
		var_dump($_POST["risk"]);
	}
}
?>
