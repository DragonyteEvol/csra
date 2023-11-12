<?php
require_once("models/UserModel.php");
class UserController extends Controller{

	public $autosave=true;

	public function __construct(){
		parent::__construct();
		$this->model = new UserModel();
	}

}
?>
