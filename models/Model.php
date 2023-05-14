<?php 
class Model{
	public $db;
	private $data;
	private $process_data;

	public function __construct($second_database = FALSE){
		$this->db=Connection::connect($second_database);
	}

	public function getCustom($sql,$param=0){
		$this->execute($sql,$this->table,$param);
		return $this->data;
	}

	/* toma todos los usuarios de la base de datos */
	/* 	retorna un lista con usuarios */
	/* puede recibir un array de nobres de tablas para generar una relacion de uno a muchos */
	public function getAll(){
		/* relacion de tablas */
		$sql = "SELECT *,$this->table.id as id_master FROM $this->table ";
		if(count($this->relations)<>0){
			foreach($this->relations as $join){
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
		$sql = "SELECT *,$this->table.id as master_id FROM $this->table WHERE $this->table.id=:id";
		$this->execute($sql,$this->table,$id);
		if(count($this->much_to_much)<>0){
			$sql = "SELECT *,$this->table.id as master_id FROM $this->table ";
			foreach(array_keys($this->much_to_much) as $join){
				$relation= substr($this->much_to_much[$join],0,-1);
				$table_relation = substr($join,0,-1) . "_" . $relation;
				$column_1 = $relation . "_id";
				$column_2 = substr($join,0,-1) . "_id";
				$join_table = $this->much_to_much[$join];
				$sql = $sql . "INNER JOIN $table_relation ON $join.id=$table_relation.$column_2 ";
				$sql = $sql . "INNER JOIN $join_table ON $table_relation.$column_1=$join_table.id ";
				$sql = $sql . "WHERE $this->table.id=:id";
				$this->execute($sql,$join_table,$id);
				$sql = str_replace("WHERE $this->table.id=:id","",$sql);
			}
		}
		return $this->data;
	}

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

	public function update(){
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
			$this->setParams($state);
			$state->bindParam(":id",$this->id);
			$state->execute();
			return $this->db->lastInsertId();
		}catch(PDOException $e){
			$this->db->rollBack();
		}
	}

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

	public function search($search){
		$column = substr($this->table,0,-1);
		$sql = "SELECT * FROM $this->table WHERE $column LIKE '%$search%'";
		$this->execute($sql,$this->table);
		return $this->data;
	}

	public function saveChanges(){
		$this->db->commit();
	}

	private function setParams($state){
		for($i=0;$i < count($this->args);$i++){
			if($this->args[$i]==":password"){
				$password = password_hash($this->password,PASSWORD_BCRYPT);
				$state->bindParam($this->args[$i],$password);
			}else{
				$state->bindParam($this->args[$i],$this->{$this->columns[$i]});
			}
		}
	}

	private function execute($sql,$key,$id=0){
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
}
?>
