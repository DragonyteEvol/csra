<?php
require_once("models/EventModel.php");
class EventController extends Controller{

	public $autosave = true;

	public function __construct(){
		parent::__construct();
		$this->model = new EventModel();
	}

}
?>
