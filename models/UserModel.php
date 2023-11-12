<?php 
class UserModel extends Model{
	protected $table = "users";
	protected $columns = ["name","email","password","role_id"];
	protected $args = [":name",":email",":password",":role_id"];
	protected $one_to_one= ["roles"];


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
