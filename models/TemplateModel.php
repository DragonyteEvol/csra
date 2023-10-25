<?php 
class TemplateModel extends Model{
	protected $table = "plugin_sid";
	protected $columns = ["name"];
	protected $args= [":name"];

	public function __construct(){
		parent::__construct(TRUE);
	}

	public function search($search)
	{
		$sql = "SELECT $this->table.name,plugin_id,sid,vendor from $this->table inner join plugin on plugin.id=plugin_sid.plugin_id where $this->table.name like '%$search%' limit 10";
		$this->getCustom($sql);
		return ($this->data);
	}

}
?>
