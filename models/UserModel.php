<?php 
class UserModel extends Model{
	protected $table = "users";
	protected $columns = ["name","email","password"];
	protected $args = [":name",":email",":password"];

	public function __construct(){
		parent::__construct();
	}

	public function selectByEmail(){
		$sql = "SELECT * FROM $this->table WHERE email=:email";
		$state = $this->db->prepare($sql);
		$state->bindParam(":email",$this->email);
		if($state->execute()){
			while($row=$state->fetch(PDO::FETCH_ASSOC)){
				$this->data[]=$row;
			}
			return $this->data;
		}
	}
}
?>
