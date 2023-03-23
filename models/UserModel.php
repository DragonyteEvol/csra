<?php 
class UserModel extends Model{
	protected $table = "users";
	protected $columns = ["name","email","password"];
	protected $args = [":name",":email",":password"];

	public function __construct(){
		parent::__construct();
	}
}
?>
