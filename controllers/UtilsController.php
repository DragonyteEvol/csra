<?php
class UtilsController extends Controller{

	public function unauthorized(){
		require_once("views/$this->controller/unauthorized.php");
	}

}
?>
