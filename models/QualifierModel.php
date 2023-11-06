<?php 
class QualifierModel extends Model{
	protected $table = "qualifiers";
	protected $columns = ["qualifier","value"];
	protected $args= [":qualifier",":value"];

	public function __construct(){
		parent::__construct();
	}

	public function getScore($type){
		$sql= "SELECT * FROM $this->table WHERE qualifier='$type'";
		$this->getCustom($sql);
		return $this->data["qualifiers"][0];
	}

	public function getQualifier($score){
		$sql= "SELECT * FROM $this->table WHERE value>=$score ORDER BY value LIMIT 1";
		$this->getCustom($sql);
		return $this->data["qualifiers"][0];
	}
}
?>
