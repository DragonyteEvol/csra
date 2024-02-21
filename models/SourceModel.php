<?php 
class SourceModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "plugin";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["vendor"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":vendor"];

	public function __construct(){
		parent::__construct(TRUE);
	}

	/* genera una lista con todas las fuentes de osiem */
	/* retorna una lista con las fuentes de osim sin duplicados */
	public function getAll()
	{
		$sql = "SELECT vendor FROM $this->table GROUP BY 1";
		$this->getCustom($sql);
		var_dump($this->data);
		return $this->data;
	}

}
?>
