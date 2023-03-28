<?php 
class KriModel extends Model{
	protected $table = "kris";
	protected $columns = ["kri","objective","propertie_id","percentage","syntax"];
	protected $args= [":kri",":objective",":propertie_id",":percentage",":syntax"];

	public function __construct(){
		parent::__construct();
	}
}
?>
