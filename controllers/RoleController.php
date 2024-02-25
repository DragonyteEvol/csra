<?php
require_once("models/RoleModel.php");
require_once("models/ModuleModel.php");
class RoleController extends Controller{

	/* denota si se debe generar un commit en la base de datos para guardar la informacion de la ultima transaccion en curso */
	/* true genera commit automaticamente */
	/* false no genera commit hasta que termine la transaccion */
	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RoleModel();
		$this->module_model= new ModuleModel();
	}

	/* retorna la vista de inicio con la lista de todos los roles en base de datos */
	public function index(){
		$this->checkAccess("r");
		$data=$this->model->getAllRole();
		require_once("views/$this->controller/index.php");
	}

	/* crea un elemento en base de datos */
	/* retorna el id del elemento creado */
	public function insert(){
		$this->checkAccess("w");
		$this->modelParams();
		$id = $this->model->insertRole();
		$this->model->saveChanges();
		header("Location: /$this->controller");
		return $id;
	}

}
?>
