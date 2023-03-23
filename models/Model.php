<?php 
class Model{
	private $db;
	private $data;

	public function __construct(){
		$this->db=Connection::connect();
		$this->data=array();
	}

	/* toma todos los usuarios de la base de datos */
	/* 	retorna un lista con usuarios */
	public function getUsers(){
		$sql = "SELECT * FROM $this->table";
		$state = $this->db->prepare($sql);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->data[]=$row;
			}
			return $this->data;
		}
	}


	/* toma un usuario por id de la base de datos */
	/* 	retorna una lista con el usuario */
	public function getUserById($id){
		$sql = "SELECT * FROM $this->table WHERE id=:id";
		$state = $this->db->prepare($sql);
		$state->bindParam(":id",$id);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->data[]=$row;
			}
			return $this->data;
		}
	}

	/* inserta un usuario en la base de datos */
	/* 	retorna el numero de id de el usuario registrado */
	public function insert(){
		$columns = implode(",",$this->columns);
		$args = implode(",",$this->args);
		$sql = "INSERT INTO $this->table($columns) values($args)";
		$state = $this->db->prepare($sql);
		$this->setParams($state);
		$state->execute();
		return $this->db->lastInsertId();
	}


	public function update(){
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
		echo "pedor". $this->id;
		$state->execute();
		return $this->db->lastInsertId();
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
}
?>
