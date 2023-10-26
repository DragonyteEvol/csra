<?php 
class SourceModel extends Model{
	protected $table = "plugin";
	protected $columns = ["vendor"];
	protected $args= [":vendor"];

	public function __construct(){
		parent::__construct(TRUE);
	}

	public function getAll()
	{
		$sql = "SELECT vendor FROM $this->table GROUP BY 1";
		$this->getCustom($sql);
		var_dump($this->data);
		return $this->data;
	}

}
?>
