<?php 
require_once("models/QualifierModel.php");
class ThresholdModel extends Model{
	protected $table = "thresholds";
	protected $columns = ["type","value","kri_id"];
	protected $args= [":type",":value",":kri_id"];

	public function __construct(){
		parent::__construct();
		$this->qualifier_model = new QualifierModel();
	}

	/* realciona un puntaje con el valor de un calificador */
	/* recibe el id del kri y el puntaje a relacionar */
	/* retorna una lista con el typo de calificador y su valor ej. Alto,45 */
	public function getThresholdScore($kri_id,$score){
		$sql = "SELECT * FROM $this->table WHERE kri_id=$kri_id AND value >=$score ORDER BY value LIMIT 1";
	 	$this->getCustom($sql,"score_qualified");
		$type = ($this->data["thresholds"][0]["type"]);
		$value = ($this->data["thresholds"][0]["value"]);
		return ["type"=>$type,"value"=>$value];
	}

	/* inserta los calificadores de un kri */
	/* recibe el id del kri y la conexion con base de datos para continuar la transaccion */
	/* no retorna informacion */
	public function insertThresholds($kri_id,$db){
		$qualifiers = $this->qualifier_model->getAll();
		$this->db = $db;
		$this->kri_id=$kri_id;
		for($i=0;$i < count($qualifiers["qualifiers"]);$i++){
			$this->type=$qualifiers["qualifiers"][$i]["qualifier"];
			$this->value=$_POST["thresholds_values"][$i];
			$this->insert();
		}
	}

	//Actualiza los calificadores de un kri los borra y los recrea
	//no retorna informacion
	//recibe el id del kri y la conexion con base de datos para continuar la transaccion
	public function updateThresholds($kri_id,$db){
		$this->db = $db;
		$sql = "DELETE FROM $this->table WHERE kri_id=:id";
		$state = $this->db->prepare($sql);
		$state->bindParam(":id",$kri_id);
		$state->execute();
		$this->insertThresholds($kri_id,$db);
	}
}
?>
