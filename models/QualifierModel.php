<?php 
class QualifierModel extends Model{
	protected $table = "qualifiers";
	protected $columns = ["type","value","kri_id"];
	protected $args= [":type",":value",":kri_id"];

	public function __construct(){
		parent::__construct();
	}

	/* realciona un puntaje con el valor de un calificador */
	/* recibe el id del kri y el puntaje a relacionar */
	/* retorna una lista con el typo de calificador y su valor ej. Alto,45 */
	public function getQualifierScore($kri_id,$score){
		$sql = "SELECT * FROM $this->table WHERE kri_id=$kri_id AND value >=$score ORDER BY value LIMIT 1";
	 	$this->getCustom($sql,"score_qualified");
		$type = ($this->data["qualifiers"][0]["type"]);
		$value = ($this->data["qualifiers"][0]["value"]);
		return ["type"=>$type,"value"=>$value];
	}

	/* inserta los calificadores de un kri */
	/* recibe el id del kri y la conexion con base de datos para continuar la transaccion */
	/* no retorna informacion */
	public function insertQualifiers($kri_id,$db){
		$this->db = $db;
		$this->kri_id=$kri_id;
		for($i=0;$i < count($_POST["qualifier"]);$i++){
			$this->type=$_POST["qualifier"][$i];
			$this->value=$_POST["qualifier_value"][$i];
			$this->insert();
		}
	}

	//Actualiza los calificadores de un kri los borra y los recrea
	//no retorna informacion
	//recibe el id del kri y la conexion con base de datos para continuar la transaccion
	public function updateQualifiers($kri_id,$db){
		$this->db = $db;
		$sql = "DELETE FROM $this->table WHERE kri_id=:id";
		$state = $this->db->prepare($sql);
		$state->bindParam(":id",$kri_id);
		$state->execute();
		$this->insertQualifiers($kri_id,$db);
	}
}
?>
