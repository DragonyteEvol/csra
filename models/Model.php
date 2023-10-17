<?php 
class Model{
	public $db;
	public $data;
	private $process_data;

	public function __construct($second_database = FALSE){
		$this->db=Connection::connect($second_database);
	}

	/* permite ejecutar consultas sql customizadas a cada modelo */
	/* 	retorna la informacion consultada o registrada */
	public function getCustom($sql,$param=0){
		$this->execute($sql,$this->table,$param);
	}

	/* toma todos los usuarios de la base de datos */
	/* 	retorna un lista con usuarios */
	/* puede recibir un array de nobres de tablas para generar una relacion de uno a muchos */
	public function getAll(){
		/* relacion de tablas */
		$sql = "SELECT *,$this->table.id as id_master FROM $this->table ";
		if(count($this->one_to_one)<>0){
			foreach($this->one_to_one as $join){
				$column = substr($join,0,-1) . "_id";
				$sql = $sql . "INNER JOIN $join ON $this->table.$column=$join.id ";
			}
		}
		/* ejecucion de query */
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* toma un usuario por id de la base de datos */
	/* 	retorna una lista con el usuario */
	public function selectById($id){
		$sql = "SELECT *,$this->table.id as master_id FROM $this->table ";
		//RELACION 1 A 1
		if(count($this->one_to_one)<>0){
			foreach($this->one_to_one as $join){
				$column = substr($join,0,-1) . "_id";
				$sql = $sql . "INNER JOIN $join ON $this->table.$column=$join.id ";
			}
		}
		$sql = $sql . "WHERE $this->table.id=:id";
		$this->execute($sql,$this->table,$id);
		//RELACION 1 A MUCHOS
		if(count($this->one_to_much)<>0){
			$sql = "SELECT *,$this->table.id as master_id FROM $this->table ";
			foreach(array_keys($this->one_to_much) as $join){
				$relation= $this->one_to_much[$join];//QUALIFIERS;
				$column_2 = substr($join,0,-1) . "_id"; //KRI_ID;
				$sql = $sql . "INNER JOIN $relation ON $join.id=$relation.$column_2 ";
				$sql = $sql . "WHERE $this->table.id=:id";
				$this->data["sql"]=$sql;
				$this->execute($sql,$relation,$id);
				$sql = str_replace("WHERE $this->table.id=:id","",$sql);
			}
		}
		//RELACION MUCHOS A MUCHOS
		if(count($this->much_to_much)<>0){
			$sql = "SELECT *,$this->table.id as master_id FROM $this->table ";
			foreach(array_keys($this->much_to_much) as $join){
				$relation= substr($this->much_to_much[$join],0,-1);
				$table_relation = substr($join,0,-1) . "_" . $relation;
				$column_1 = $relation . "_id";
				$column_2 = substr($join,0,-1) . "_id";
				$join_table = $this->much_to_much[$join];
				$sql = $sql . " INNER JOIN $table_relation ON $join.id=$table_relation.$column_2 ";
				$sql = $sql . " INNER JOIN $join_table ON $table_relation.$column_1=$join_table.id ";
				$sql = $sql . "WHERE $this->table.id=:id";
				$this->execute($sql,$join_table,$id);
				$sql = str_replace("WHERE $this->table.id=:id","",$sql);
			}
		}
		return $this->data;
	}

	/* inserta un registro a la base de datos con sus respectivas relaciones */
	/* 	retorna el id del elemento registrado */
	public function insert(){
		try{
			if(!$this->db->inTransaction()){
				$this->db->beginTransaction();
			}
			$columns = implode(",",$this->columns);
			$args = implode(",",$this->args);
			$sql = "INSERT INTO $this->table($columns) values($args)";
			$state = $this->db->prepare($sql);
			$this->setParams($state);
			$state->execute();
			$id = $this->db->lastInsertId();
			if(count($this->much_to_much)>0){
				foreach(array_keys($this->much_to_much) as $join){
					$relation= substr($this->much_to_much[$join],0,-1);//event
					$table_relation = substr($join,0,-1) . "_" . $relation;//kri_event
					$column_2 = substr($join,0,-1) . "_id";//kri_id
					$column_1 = $relation . "_id";//event_id
					$sql = "INSERT INTO $table_relation($column_1,$column_2) VALUES(:$column_1,:$column_2)";
					for($i=0;$i< count($_POST[$relation]);$i++){
						$state = $this->db->prepare($sql);
						$state->bindParam(":$column_1",$_POST[$relation][$i]);
						$state->bindParam(":$column_2",$id);
						$state->execute();
					}
				}

			}
			return $id;
		}catch(PDOException $e){
			echo $e->getMessage();
			$this->db->rollBack();
		}
	}

	/* modifica un elemento en la base de datos */
	/* recibe el id del elemento a modificar */
	/* 	retorna el ultimo in elemento de la tabla */
	public function update($id){
		try{
			if(!$this->db->inTransaction()){
				$this->db->beginTransaction();
			}
			$prepare_sql = "";
			for($i=0;$i < count($this->args);$i++){
				if((count($this->args)-1)==$i){
					$prepare_sql = $prepare_sql . $this->columns[$i] . "=" . $this->args[$i];
				}else{
					$prepare_sql = $prepare_sql . $this->columns[$i] . "=" . $this->args[$i] . ",";
				}
			}
			$sql = "UPDATE $this->table set $prepare_sql WHERE id=:id";
			$state = $this->db->prepare($sql);
			$state = $this->setParams($state);
			$state->bindParam(":id",$id);
			$state->execute();
			$this->refreshDataRelations($id,$this->much_to_much);
		}catch(PDOException $e){
			var_dump($e);
			$this->db->rollBack();
		}
	}

	/* borra un elemento de la base de datos */
	/* 	no retorna informacion */
	public function delete($id){
		try{
			if(!$this->db->inTransaction()){
				$this->db->beginTransaction();
			}
			$sql = "DELETE FROM $this->table WHERE id=:id";
			$state = $this->db->prepare($sql);
			$state->bindParam(":id",$id);
			$state->execute();
		}catch(PDOException $e){
			$this->db->rollBack();
		}
	}

	/* busca elementos en la base de datos */
	/* 	retorna un array con los elementos encontrados */
	public function search($search){
		$sql = "SELECT *,$this->table.id as master_id FROM $this->table ";
		if(count($this->one_to_one)<>0){
			foreach($this->one_to_one as $join){
				$column = substr($join,0,-1) . "_id";
				$sql = $sql . "INNER JOIN $join ON $this->table.$column=$join.id ";
			}
		}
		$column = substr($this->table,0,-1);
		$sql=$sql . " WHERE $column LIKE '%$search%'";
		$this->execute($sql,$this->table);
		return $this->data;
	}

	/* escribe los cambios en la base de datos si el dml esta en una transaccion */
	/* 	no retorna informacion pero termina la transaccion actual */
	public function saveChanges(){
		$this->db->commit();
	}

	/* establece las variables de las consultas preparadas */
	/* 	no retorna informacion pero deja la consulta preparada lista para su ejecucion */
	public function setParams($state){
		for($i=0;$i < count($this->args);$i++){
			if($this->args[$i]==":password"){
				$password = password_hash($this->password,PASSWORD_BCRYPT);
				$state->bindParam($this->args[$i],$password);
			}else{
				$state->bindParam($this->args[$i],$this->{$this->columns[$i]});
			}
		}
		return $state;
	}

	/* ejecuta la consulta preparada */
	/* modifica la variable data adjuntando la informacion en esta variable con llave especifica*/
	public function execute($sql,$key,$id=0){
		$state = $this->db->prepare($sql);
		if($id<>0){
			$state->bindParam(":id",$id);
		}
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->process_data[]=$row;
			}
			$this->data[$key]=$this->process_data;
			$this->process_data=[];
		}
	}

	//BORRA Y RECREA LAS RELACIONES MUCHOS A MUCHOS DE UNA TABLA RELACION
	//recibe un id de referencia generalemente el id de el elemento de la tabla principal, y las un diccionario de tabla relacion
	//no retorna informacion
	public function refreshDataRelations($id_reference,$relations){
		foreach(array_keys($relations) as $join){
			$relation= substr($relations[$join],0,-1);//event
			$table_relation = substr($join,0,-1) . "_" . $relation;//kri_event
			$column_2 = substr($join,0,-1) . "_id";//kri_id
			$column_1 = $relation . "_id";//event_id
			//BORRA LAS DEPENDECIAS O RELACIONES ANTERIORES
			$sql = "DELETE FROM $table_relation WHERE $column_2=:id";
			$state = $this->db->prepare($sql);
			$state->bindParam(":id",$id_reference);
			$state->execute();
			//RECREA LAS DEPENEDENCIAS O RELACIONES
			$sql = "INSERT INTO $table_relation($column_1,$column_2) VALUES(:$column_1,:$column_2)";
			for($i=0;$i< count($_POST[$relation]);$i++){
				$state = $this->db->prepare($sql);
				$state->bindParam(":$column_1",$_POST[$relation][$i]);
				$state->bindParam(":$column_2",$id_reference);
				$state->execute();
			}
		}

	}
}
?>
