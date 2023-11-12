<?php 
class RoleModel extends Model{
	protected $table = "roles";
	protected $columns = ["role"];
	protected $args= [":role"];
	protected $much_to_much= ["roles"=>'modules'];

	public function __constrdfact(){
		parent::__construct();
	}
}
?>
