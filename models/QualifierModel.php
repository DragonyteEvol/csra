<?php 
class QualifierModel extends Model{
	protected $table = "qualifiers";
	protected $columns = ["qualifier","value"];
	protected $args= [":qualifier",":value"];

	public function __construct(){
		parent::__construct();
	}
}
?>
