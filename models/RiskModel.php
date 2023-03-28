<?php 
class RiskModel extends Model{
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "risks";
	
	/* columns que modifica el modelo en base de datos */
	protected $columns = ["type_id","propertie_id","risk",];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":type_id",":propertie_id",":risk"];

	/* relaciones entre bases de datos uno a muchos */
	protected $relations= ["properties","types"];

	public function __construct(){
		parent::__construct();
	}

}
?>
