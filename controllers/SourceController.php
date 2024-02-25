<?php
require_once("models/SourceModel.php");
class SourceController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->model = new SourceModel();
	}

	/* ----------------------------------------------ALERTA MODIFICAR VISTA--------------------------------------------------------------------------------- */
	/* genera un vista de html con las fuentes y las muestra en pantalla */	
	/* retorna una vista con el html creado y una lista con las fuentes seleccionadas */
	public function index()
	{
		$this->checkAccess("r");
		$data = $this->model->getAll();
		foreach($data as $source){
			echo $source["vendor"] . "<BR>";
		}
	}
}
?>
