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

	/* Consulta todos los elementos del modelo en base en datos */
	/* retorna un array con los elementos consultados */
	public function getAll(){
		//optencion de query
		$sql = $this->getSelectQuery(TRUE);
		/* ejecucion de query */
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* Calcula el valor de un ecuacion relacionando los numeros a id de eventos y consultando su repeticion de aparicion en OSIEM en un tiempo determinado */
	/* recibe como entrada una ecuacion en formato string */
	/* retorna un numero con el valor de la ecuacion en un tiempo determinado */
	/* genera una llave en el array principal con la llave event_score que contiene todos los eventos procesados para generar el score */
	public function getScore($syntax){
		//definimos la llave de los eventos implicados 
		$this->data["event_score"] = array();
		/* generar array de numeros */
		$array_events= $this->extractNumberEvents($syntax);
		/* consultar eventos y aparicion */
		$abstract_syntax = $syntax;
		foreach($array_events as $event_id){
			$events = $this->selectById($event_id);
			//agregamos el evento al array
			array_push($this->data["event_score"],$events["events"][0]);
			if(count($events["events"])==0){
				$syntax = str_replace($event_id,"0",$syntax);
				continue;
			}
			foreach($events["events"] as $event){
				$score = $event["score"];
				$syntax = str_replace($event_id,$score,$syntax);
			}
			$abstract_syntax = str_replace($event_id,$events["events"][0]["event"],$abstract_syntax);

		}
		//INFORMACION ADICIONAL
		$this->data["syntax_abstract"] = $abstract_syntax;
		$this->data["syntax"] = $syntax;
		/* evaluar ecuacion */
		/* !!!!!!IMPORTANTE!!!!!!!!! */
		/* Aplicar tecnicas de sanitizacion debido a que la funcion eval puede ser muy peligrosa y poner en riesgo la informacion */
		eval("\$score = $syntax;");
		return $score;
	}

	/* extrae el numero de evento de evento a partir de un ecuacion */
	/* recibe como entrada una ecuacion en formato string */
	/* ej. (25-56)/24 => Array(25,56,24) */
	/* retorna un array con los eventos identificados */
	private function extractNumberEvents($syntax){
		$array_number = array();
		$number = "";
		for($i=0;$i<strlen($syntax);$i++){
			if(is_numeric($syntax[$i])){
				$number = $number . $syntax[$i];
			}else{
				if($number!=""){
					array_push($array_number,$number);
					$number = "";
				}	
			}
		}
		if($number!=""){
			array_push($array_number,$number);
		}	
		return $array_number;
	}


	/* busca elementos en la base de datos */
	/* 	retorna un array con los elementos encontrados */
	public function selectById($id){
		$sql = $this->getSelectQuery(FALSE);
		$sql=$sql . " WHERE $this->table.id='$id' ";
		//FILTRO DE TIEMPO
		$from = $_GET["from"];
		$to = $_GET["to"];
		if(!empty($from && !empty($to))){
			$sql=$sql . " AND reported_at BETWEEN '$from' AND '$to' ";
		}
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		$sql = $sql . "GROUP BY $this->table.id,$this->table.event_id,$this->table.source_id";
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* busca elementos en la base de datos */
	/* 	retorna un array con los elementos encontrados */
	public function search($search){
		$sql = $this->getSelectQuery(FALSE);
		$sql=$sql . " WHERE $this->search_criteria LIKE '%$search%' ";
		$from = $_GET["from"];
		$to = $_GET["to"];
		if(!empty($from && !empty($to))){
			$sql=$sql . " AND reported_at BETWEEN '$from' AND '$to' ";
		}
		//AGRUPACION POR ID DE OSIEM Y FUENTE PARA EVITAR CRUCES DE EVENTOS
		$sql = $sql . "GROUP BY $this->table.id,$this->table.event_id,$this->table.source_id";
		$this->execute($sql,$this->table);
		return $this->data;
	}

	//genera el query principal de la seleccion de eventos
	//recibe como paremetros un booleano para inyectar al query la agrupacion por evento y fuente
	//retorna un string con la query a ejecutar
	private function getSelectQuery($group){
		$sql = "SELECT *,count($this->record_table.event_id) as score,$this->table.id as master_id FROM $this->table ";
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
