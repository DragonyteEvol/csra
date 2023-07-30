<?php 
class EventModel extends Model{
	protected $table = "events";
	protected $columns = ["event","type","source_id","event_id"];
	protected $args= [":event",":type",":source_id",":event_id"];
	protected $record_table="records";

	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		/* relacion de tablas */
		$sql = "SELECT *,count($this->table.event_id) as score,$this->table.id as id_master FROM $this->table ";
		if(count($this->one_to_one)<>0){
			foreach($this->one_to_one as $join){
				$column = substr($join,0,-1) . "_id";
				$sql = $sql . "LEFT JOIN $join ON $this->table.$column=$join.id ";
			}
		}
		//UNION A CALCULO DE PUNTAJE 
		$sql = $sql . "LEFT JOIN $this->record_table ON $this->table.event_id=$this->record_table.event_id AND $this->table.source_id=$this->record_table.source_id ";
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		$sql = $sql . "GROUP BY $this->table.event_id,$this->table.source_id";
		/* ejecucion de query */
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* busca elementos en la base de datos */
	/* 	retorna un array con los elementos encontrados */
	public function search($search){
		$sql = "SELECT *,count($this->table.event_id) as score,$this->table.id as master_id FROM $this->table ";
		if(count($this->one_to_one)<>0){
			foreach($this->one_to_one as $join){
				$column = substr($join,0,-1) . "_id";
				$sql = $sql . "LEFT JOIN $join ON $this->table.$column=$join.id ";
			}
		}
		//UNION A CALCULO DE PUNTAJE 
		$sql = $sql . "LEFT JOIN $this->record_table ON $this->table.event_id=$this->record_table.event_id AND $this->table.source_id=$this->record_table.source_id ";
		$column = substr($this->table,0,-1);
		$sql=$sql . " WHERE $column LIKE '%$search%' ";
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		$sql = $sql . "GROUP BY $this->table.event_id,$this->table.source_id";
		$this->execute($sql,$this->table);
		return $this->data;
	}
}
?>
