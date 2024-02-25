<?php 
require_once("models/UserModel.php");
class AccessModel extends Model{
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "role_module";
	protected $table_aux = "modules";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["role_id","module_id","r","w","u","d"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":user_id",":module",":access"];

	public function __construct(){
		parent::__construct();
		$this->user_model = new UserModel();
	}

	/* consulta los modulos y accesos atribuidos a cada modulo asignado a un rol especifico de un usuario */
	/* recibe un entero de entrada que coincide con el id del usuario logeado se carga por cookie */
	/* retorna una lista relacionada con los accesos asociados a el rol del usuario consultado */
	public function getAccess($id){
		/* re seleccionamos el usuario desde el modelo para evitar accesos indebidos desde la cookie */
		$users=$this->user_model->selectById($id);
		foreach($users["users"] as $user){
			$sql = "SELECT * FROM $this->table INNER JOIN $this->table_aux ON $this->table.module_id=$this->table_aux.id WHERE role_id=:role_id";
			$state = $this->db->prepare($sql);
			$state->bindParam(":role_id",$user["role_id"]);
			if($state->execute()){
				while($row=$state->fetch(PDO::FETCH_ASSOC)){
					$this->data[]=$row;
				}
				return $this->data;
			}
		}
	}
}
?>
