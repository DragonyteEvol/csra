<?php 
class TypeModel extends Model{
	protected $table = "types";
	protected $columns = ["type"];
	protected $args= [":type"];

	public function __construct(){
		parent::__construct();
	}
}
?>
