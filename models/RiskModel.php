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

	public function getScore($kris){
		$score = 0;
		foreach($this->data["kris"] as $kri){
			$kri_score = $this->kri_model->getScore($kri["id"],$kri["syntax"]);
			$kri_score = $kri_score["value"] * ($kri["percentage"]/100);
			$score += $kri_score;
		};
		return $score;
	}

}
?>
