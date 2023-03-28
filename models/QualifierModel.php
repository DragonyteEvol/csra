<?php 
class QualifierModel extends Model{
	protected $table = "qualifiers";
	protected $columns = ["type","value","kri_id"];
	protected $args= [":type",":value",":kri_id"];

	public function __construct(){
		parent::__construct();
	}
}
?>
