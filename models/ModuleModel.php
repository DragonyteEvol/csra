<?php 
class ModuleModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "modules";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["module"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":module"];

	public function __construct(){
		parent::__construct();
	}
}
?>
