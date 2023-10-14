<?php 
class QualifierModel extends Model{
	protected $table = "qualifiers";
	protected $columns = ["type","value","kri_id"];
	protected $args= [":type",":value",":kri_id"];

	public function __construct(){
		parent::__construct();
	}

	public function getQualifierScore($kri_id,$score){
		$sql = "SELECT * FROM $this->table WHERE kri_id=$kri_id AND value >=$score ORDER BY value LIMIT 1";
	 	$this->getCustom($sql,"score_qualified");
		$type = ($this->data["qualifiers"][0]["type"]);
		$value = ($this->data["qualifiers"][0]["value"]);
		return ["type"=>$type,"value"=>$value];
	}

	public function insertQualifiers($id,$db){
		$this->db = $db;
		$this->kri_id=$id;
		for($i=0;$i < count($_POST["qualifiers"]);$i++){
			$this->type=$_POST["qualifiers"][$i];
			$this->value=$_POST["qualifiers_values"][$i];
			$this->insert();
		}
	}

}
?>
