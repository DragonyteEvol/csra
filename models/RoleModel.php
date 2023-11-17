<?php 
require_once("models/ModuleModel.php");
class RoleModel extends Model{
	protected $table = "roles";
	protected $columns = ["role"];
	protected $args= [":role"];
	protected $much_to_much= ["roles"=>'modules'];

	public function __construct(){
		parent::__construct();
		$this->module_model = new ModuleModel();
	}

	public function getAllRole(){
		$this->getAll();
		$this->module_model->getAll();
		$this->data["modules"] = $this->module_model->data["modules"];
		return $this->data;
	}
}
?>
