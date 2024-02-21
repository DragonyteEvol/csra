<?php 
class TypeModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "types";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["type"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":type"];

	public function __construct(){
		parent::__construct();
	}
}
?>
