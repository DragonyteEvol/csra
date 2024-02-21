<?php 
class PropertieModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "properties";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["propertie"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":propertie"];

	public function __construct(){
		parent::__construct();
	}
}
?>
