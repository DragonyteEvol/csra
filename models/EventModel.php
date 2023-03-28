<?php 
class EventModel extends Model{
	protected $table = "events";
	protected $columns = ["event","type","source_id","event_id"];
	protected $args= [":event",":type",":source_id",":event_id"];

	public function __construct(){
		parent::__construct();
	}
}
?>
