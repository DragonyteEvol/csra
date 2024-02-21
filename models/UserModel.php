<?php 
class UserModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "users";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["name","email","password","role_id"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args = [":name",":email",":password",":role_id"];

	/* lista con tablas a relacionar el modelo de forma uno a uno */ 
	protected $one_to_one= ["roles"];


	public function __construct(){
		parent::__construct();
	}

	/* genera una lista con el usuario asociado a un correo se usa para login */
	/* retorna un lista con los datos de un usuario */ 
	public function selectByEmail(){
		$sql = "SELECT * FROM $this->table WHERE email=:email";
		$state = $this->db->prepare($sql);
		$state->bindParam(":email",$this->email);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->data[]=$row;
			}
			return $this->data;
		}
	}
}
?>
