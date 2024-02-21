<?php
require_once("models/PropertieModel.php");
class PropertieController extends Controller{

	/* denota si se debe generar un commit en la base de datos para guardar la informacion de la ultima transaccion en curso */
	/* true genera commit automaticamente */
	/* false no genera commit hasta que termine la transaccion */
	public $autosave = true;

	public function __construct(){
		parent::__construct();
		$this->model = new PropertieModel();
	}
}
?>
