<?php 
require_once("models/EventModel.php");
class KriModel extends Model{
	protected $table = "kris";
	protected $columns = ["kri","objective","propertie_id","percentage","syntax"];
	protected $args= [":kri",":objective",":propertie_id",":percentage",":syntax"];
	protected $one_to_one= ["kris"=>"properties"];
	protected $one_to_much= ["kris"=>"qualifiers"];
	protected $much_to_much= ["kris"=>"events"];

	public function __construct(){
		parent::__construct();
	}

}
?>
