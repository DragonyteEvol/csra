<?php 
require_once("models/ThresholdModel.php");
require_once("models/EventModel.php");
class KriModel extends Model{
	protected $table = "kris";
	protected $columns = ["kri","objective","propertie_id","percentage","syntax"];
	protected $args= [":kri",":objective",":propertie_id",":percentage",":syntax"];
	protected $one_to_one= ["kris"=>"properties"];
	protected $one_to_much= ["kris"=>"thresholds"];
	protected $much_to_much= ["kris"=>"events"];
	protected $table_relations = ["thresholds"=>["type","value"],"events"];

	public function __construct(){
		parent::__construct();
		$this->event_model = new EventModel(); //AFECTA LA TABLA EVENTS
		$this->threshold_model = new ThresholdModel(); //AFECTA A LA TABLA QUALIFIERS
	}

	/* selecciona un kri de la base de datos calcula su puntaje */
	/* retorna un array de elementos con los datos del kri y su puntje */
	/* recibe un id de kri */
	public function getByIdScore($id){
		$this->selectById($id);
		/* CALCULAR PUNTAJE DE KRI */
		$syntax = $this->data["kris"][0]["syntax"];
		$this->getScore($id,$syntax);
		return $this->data;
	}

	/* calcula el puntaje ponderado y calificado de un kri */
	/* adjunta los resultados al array principal del modelo retorna el valor cualificado*/
	/* requiere como datos de entrada un id de kri y una syntax o ecuacion ejemplo 2+4 */
	public function getScore($id,$syntax){
		/* puntaje calculado por ecuacion */
		$this->data["score"] = $this->event_model->getScore($syntax);
		//creamos una llave en el array principal con los enventos implicados en el calculo y su conteo individual
		$this->data["event_score"] =$this->event_model->data["event_score"];
		$this->data["event"] =$this->event_model->data["event"];
		$this->data["syntax_abstract"] = $this->event_model->data["syntax_abstract"];
		$this->data["syntax"] = $this->event_model->data["syntax"];
		/* puntaje ponderado por calificadores */
		$this->data["score_qualified"]=$this->threshold_model->getThresholdScore($id,$this->data["score"]);
		return $this->data["score_qualified"];
	}

}
?>
