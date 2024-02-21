<?php 
class QualifierModel extends Model{
	
	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "qualifiers";
	
	/* columns que modifica el modelo en base de datos */
	protected $columns = ["qualifier","value"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":qualifier",":value"];

	public function __construct(){
		parent::__construct();
	}

	/* consulta el valor numerico de un calificador */
	/* recibe como parametros el nombre del calificador ej. Alto,Bajo,Medio */
	/* retorna una dupla de clave valor con el valor de el calificador ej. {"calificador" => "Alto","valor" => 3} */
	public function getScore($type){
		$sql= "SELECT * FROM $this->table WHERE qualifier='$type'";
		$this->getCustom($sql);
		return $this->data["qualifiers"][0];
	}

	/* consulta un calificador a partir de un valor */
	/* recibe como parametro un valor ej. 3,2,1 */
	/* retorna una dupla de clave valor con el valor del calificador que se encuentra en el rango del valor de entrada */
	public function getQualifier($score){
		$sql= "SELECT * FROM $this->table WHERE value>=$score ORDER BY value LIMIT 1";
		$this->getCustom($sql);
		return $this->data["qualifiers"][0];
	}
}
?>
