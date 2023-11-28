<?php
require_once("models/RoleModel.php");
require_once("models/ModuleModel.php");
class RoleController extends Controller{

	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RoleModel();
		$this->module_model= new ModuleModel();
	}

	public function index(){
		$data=$this->model->getAllRole();
		require_once("views/$this->controller/index.php");
	}

	public function insert(){
		$this->modelParams();
		$id = $this->model->insertRole();
		$this->model->saveChanges();
		header("Location: /$this->controller");
		return $id;
	}

}
?>
