<?php 
require_once("models/ModuleModel.php");
class RoleModel extends Model{
	private $accesses = ["R","W","D","U"];
	protected $table = "roles";
	protected $columns = ["role"];
	protected $args= [":role"];

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

	/* crea un rol en base de datos con sus respectivas relaciones */
	public function insertRole(){
		$role_id = $this->insert();
		$this->insertRelation($role_id);
	}

	/* crea la relacion de roles con modules con sus repectivos permisos */
	/* recibe un numero role_id que es el identificador unico en base de datos del rol a relacionar */
	private function insertRelation($role_id){
		$sql = "INSERT INTO role_module(role_id,module_id,access) VALUES(:role_id,:module_id,:access)";
		$modules = $this->module_model->getAll();
		foreach($modules["modules"] as $module){
			$state = $this->db->prepare($sql);
			$access=$this->getAccess($module["module"]);
			$state->bindParam(":role_id",$role_id);
			$state->bindParam(":module_id",$module["id"]);
			$state->bindParam(":access",$access);
			$state->execute();
		}
	}

	/* genera un string con las letras base que denotan acceso a un modulo ejempo RW escritura y lectura */ 
	/* 	recibe un modulo en especifico para validar sus accesoe en la variable post del formulario */
	/* 	retorna un string con los permisos requeridos para ese modulo */
	private function getAccess($module){
		$concat = "";
		foreach($this->accesses as $access){
			$key = $module . $access;
			if(array_key_exists($key,$_POST)){
				$concat=$concat.$access;
			}
		}
		return $concat;
	}

}
?>
