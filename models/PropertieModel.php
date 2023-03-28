<?php 
class PropertieModel extends Model{
	protected $table = "properties";
	protected $columns = ["propertie"];
	protected $args= [":propertie"];

	public function __construct(){
		parent::__construct();
	}
}
?>
