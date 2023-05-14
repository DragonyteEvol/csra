<?php
require_once("models/EventModel.php");
class EventController extends Controller{

	public $autosave = true;

	public function __construct(){
		parent::__construct();
		$this->model = new EventModel();
	}

	public function show(){
		$numbers = [0,1,2,3,4,5,6,7,8,9];
		$syntax = "(22+3)+(4*825)";
		$z=4;
		if(is_numeric($syntax[$z])){
			echo $syntax[$z];
		}
	}

}
?>
