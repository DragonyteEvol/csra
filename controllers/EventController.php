<?php
require_once("models/EventModel.php");
class EventController extends Controller{

	public $autosave = true;

	public function __construct(){
		parent::__construct();
		$this->model = new EventModel();
	}

	public function sophos(){
		$array_number = array();
		$syntax = '(22+3)+(4*825)';
		$number = "";
		for($i=0;$i<strlen($syntax);$i++){
			if(is_numeric($syntax[$i])){
				$number = $number . $syntax[$i];
			}else{
				if($number!=""){
					array_push($array_number,$number);
					$number = "";
				}	
			}
		}
		eval("\$var = $syntax;");
		echo($var);
	}

}
?>
