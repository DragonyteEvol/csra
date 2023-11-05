<?php 
require_once("models/KriModel.php");
class RiskModel extends Model{
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "risks";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["type_id","propertie_id","risk",];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":type_id",":propertie_id",":risk"];

	/* relaciones entre bases de datos uno a muchos */
	protected $one_to_one= ["properties","types"];

	/* relaciones entre bases de datos de muchos a muchos se debe definir las dos tablas que se desean relacionar */
	protected $much_to_much= ["risks"=>"kris","kris"=>"events"];

	public function __construct(){
		parent::__construct();
		$this->kri_model = new KriModel();
	}

	public function insertRisk(){
		$risk_id = $this->insert(FALSE);
		/* INSERTAR DEPENDENCIAS RELACIONALES DE KRIS */
		$sql = "INSERT INTO risk_kri(risk_id,kri_id,percentage) VALUES(:risk_id,:kri_id,:percentage)";
		$index = 0;
		foreach($_POST["kris"] as $kri_id){
			$state = $this->db->prepare($sql);
			$state->bindParam(":risk_id",$risk_id);
			$state->bindParam(":kri_id",$kri_id);
			$state->bindParam(":percentage",$_POST["percentages"][$index]);
			$index ++;
			$state->execute();
		}
		return $risk_id;
	}

	public function getScore($kris){
		$score = 0;
		$this->data["kri_score"] = array();
		$this->data["event_score"] = array();
		foreach($this->data["kris"] as $kri){
			$kri_score = $this->kri_model->getScore($kri["id"],$kri["syntax"]);
			$kri["score"] = $kri_score;
			$kri["syntax_abstract"] = $this->kri_model->data["syntax_abstract"];
			$kri["syntax"] = $this->kri_model->data["syntax"];
			$kri_score = $kri_score["value"] * ($kri["percentage"]/100);
			$score += $kri_score;
			//AGREGAMOS EL KRI CON SU PUNTAJE A LA LISTA DATA PARA USARLA EN LA VISTA 
			array_push($this->data["kri_score"],$kri);
			$this->data["event_score"] = array_merge($this->data["event_score"],$this->kri_model->data["event_score"]);
		};
		/* $this->data["event_score"] = $this->kri_model->data; */
		return $score;
	}
}
?>
