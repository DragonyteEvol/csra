<?php
require_once("models/TypeModel.php");
class TypeController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new TypeModel();
	}
}
?>
