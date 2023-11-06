<?php 
class RoleModel extends Model{
	protected $table = "roles";
	protected $columns = ["role"];
	protected $args= [":role"];

	public function __construct(){
		parent::__construct();
	}
}
?>
