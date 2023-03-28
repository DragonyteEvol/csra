<?php
require_once("models/KriModel.php");
class KriController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new KriModel();
	}

}
?>
