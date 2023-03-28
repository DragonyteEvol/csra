<?php 
class RecordModel extends Model{
	protected $table = "records";
	protected $columns = ["source_id","event_id","reported_at"];
	protected $args = [":source_id",":event_id",":reported_at"];

	public function __construct(){
		parent::__construct();
	}
}
?>
