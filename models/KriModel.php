<?php 
class KriModel extends Model{
	protected $table = "kris";
	protected $columns = ["kri","objective","propertie_id","percentage","syntax"];
	protected $args= [":kri",":objective",":propertie_id",":percentage",":syntax"];
	protected $relations= ["kris"=>"properties"];
	protected $much_to_much= ["kris"=>"events"];

	public function __construct(){
		parent::__construct();
	}

	public function insertKri(){
		$this->insert();
	}
}
?>
