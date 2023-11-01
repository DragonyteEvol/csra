<?php 
class ModuleModel extends Model{
	protected $table = "modules";
	protected $columns = ["module"];
	protected $args= [":module"];
	protected $one_to_much= ["modules"=>"access"];

	public function __construct(){
		parent::__construct();
	}
}
?>
