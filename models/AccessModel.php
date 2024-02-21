<?php 
class AccessModel extends Model{
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "access";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["user_id","module","access"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":user_id",":module",":access"];

	public function __construct(){
		parent::__construct();
	}
}
?>
