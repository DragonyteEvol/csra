<?php 
require_once("models/ModuleModel.php");
class RoleModel extends Model{

	/* lista de caracteres que definen los accesos a un modulo R=Read, W= Write,D= Delete, U=update */
	private $accesses = ["R","W","D","U"];
	
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "roles";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["role"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":role"];

	/* relaciones entre bases de datos de muchos a muchos se debe definir las dos tablas que se desean relacionar */
	protected $much_to_much = ["roles"=>"modules"];

	public function __construct(){
		parent::__construct();
		$this->module_model = new ModuleModel();
	}

    /* genera una lista con todos los roles y modulos asociados al rol */
	/* retorna una lista */
	public function getAllRole(){
		$this->getAll();
		$this->module_model->getAll();
		$this->data["modules"] = $this->module_model->data["modules"];
		return $this->data;
	}

	/* crea un rol en base de datos con sus respectivas relaciones */
	public function insertRole(){
		$role_id = $this->insert(FALSE);
		$this->insertRelation($role_id);
		return $role_id;
	}

	/* borra y recrea las dependencias de un rol */
	public function refreshDataRelations($id_reference){
		/* BORRAR RELACIONES EN TABLA DE RELACION MUCHO A MUCHO */
		$sql = "DELETE FROM role_module WHERE role_id=:role_id";
		$state = $this->db->prepare($sql);
		$state->bindParam(":role_id",$id_reference);
		$state->execute();
		/* RECREAR DEPENDENCIAAS */
		$this->insertRelation($id_reference);
	}

	/* crea la relacion de roles con modules con sus repectivos permisos */
	/* recibe un numero role_id que es el identificador unico en base de datos del rol a relacionar */
	private function insertRelation($role_id){
		$sql = "INSERT INTO role_module(role_id,module_id,r,w,u,d) VALUES(:role_id,:module_id,:R,:W,:U,:D)";
		$modules = $this->module_model->getAll();
		foreach($modules["modules"] as $module){
			$state = $this->db->prepare($sql);
			$state = $this->bindAccess($module["module"],$state);
			$state->bindParam(":role_id",$role_id);
			$state->bindParam(":module_id",$module["id"]);
			$state->execute();
		}
	}

	/* genera un string con las letras base que denotan acceso a un modulo ejempo RW escritura y lectura */ 
	/* 	recibe un modulo en especifico para validar sus accesoe en la variable post del formulario */
	/* 	retorna un string con los permisos requeridos para ese modulo */
	private function bindAccess($module,$state){
		$true = 1;
		$false = 0;
		foreach($this->accesses as $access){
			$key = $module . $access;
			$bind = ":" . $access;
			if(array_key_exists($key,$_POST)){
				$state->bindParam($bind,$true);
			}else{
				$state->bindParam($bind,$false);
			}
		}
		return $state;
	}

}
?>
