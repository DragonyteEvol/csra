<?php 
class AccessModel extends Model{
	protected $table = "access";
	protected $columns = ["user_id","module","access"];
	protected $args= [":user_id",":module",":access"];

	public function __construct(){
		parent::__construct();
	}
}
?>
