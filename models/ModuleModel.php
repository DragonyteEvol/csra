<?php 
class ModuleModel extends Model{
	protected $table = "modules";
	protected $columns = ["module"];
	protected $args= [":module"];

	public function __construct(){
		parent::__construct();
	}
}
?>
