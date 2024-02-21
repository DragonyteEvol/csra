<?php 
class RecordModel extends Model{
	
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "records";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["source_id","event_id","reported_at"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args = [":source_id",":event_id",":reported_at"];

	public function __construct(){
		parent::__construct();
	}
}
?>
