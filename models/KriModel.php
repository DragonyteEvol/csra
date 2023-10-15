<?php 
require_once("models/QualifierModel.php");
require_once("models/EventModel.php");
class KriModel extends Model{
	protected $table = "kris";
	protected $columns = ["kri","objective","propertie_id","percentage","syntax"];
	protected $args= [":kri",":objective",":propertie_id",":percentage",":syntax"];
	protected $one_to_one= ["kris"=>"properties"];
	protected $one_to_much= ["kris"=>"qualifiers"];
	protected $much_to_much= ["kris"=>"events"];

	public function __construct(){
		parent::__construct();
		$this->event_model = new EventModel(); //AFECTA LA TABLA EVENTS
		$this->qualifier_model = new QualifierModel(); //AFECTA A LA TABLA QUALIFIERS
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
		/* puntaje ponderado por calificadores */
		$this->data["score_qualified"]=$this->qualifier_model->getQualifierScore($id,$this->data["score"]);
		return $this->data["score_qualified"];
	}

}
?>
