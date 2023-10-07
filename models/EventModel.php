<?php 
class EventModel extends Model{
	protected $table = "events";
	protected $columns = ["event","type","source_id","event_id"];
	protected $args= [":event",":type",":source_id",":event_id"];
	protected $record_table="records";
	protected $search_criteria="event";

	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		//optencion de query
		$sql = $this->getSelectQuery(TRUE);
		/* ejecucion de query */
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* busca elementos en la base de datos */
	/* 	retorna un array con los elementos encontrados */
	public function search($search){
		$sql = $this->getSelectQuery(FALSE);
		$sql=$sql . " WHERE $this->search_criteria LIKE '%$search%' ";
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		$sql = $sql . "GROUP BY $this->table.id,$this->table.event_id,$this->table.source_id";
		$this->execute($sql,$this->table);
		return $this->data;
	}

	//genera el query principal de la seleccion de eventos
	//recibe como paremetros un booleano para inyectar al query la agrupacion por evento y fuente
	//retorna un string con la query a ejecutar
	private function getSelectQuery($group){
		$sql = "SELECT *,count($this->table.event_id) as score,$this->table.id as id_master FROM $this->table ";
		//UNION A CALCULO DE PUNTAJE 
		$sql = $sql . "LEFT JOIN $this->record_table ON $this->table.event_id=$this->record_table.event_id AND $this->table.source_id=$this->record_table.source_id ";
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		if($group){
			$sql = $sql . "GROUP BY $this->table.id,$this->table.event_id,$this->table.source_id";
		}
		return $sql;
	}
}
?>
