<?php
require_once("models/RiskModel.php");
class RiskController extends Controller{

	/* denota si se debe generar un commit en la base de datos para guardar la informacion de la ultima transaccion en curso */
	/* true genera commit automaticamente */
	/* false no genera commit hasta que termine la transaccion */
	public $autosave = true;	

	public function __construct(){
		parent::__construct();
		$this->model = new RiskModel();
	}

	/* retorna la vista de mostrar un solo elemento con la informacion del elemnto */
	public function show(){
		$id = $_GET["id"]; 
		$data=$this->model->selectById($id);
		$this->model->data["score"] = $this->model->getScore($data["kris"]);
		$data = $this->model->data;
		require_once("views/$this->controller/show.php");
	}

	/* crea un elemento en la base de datos */
	/* retorna el id del elemento creado */
	public function insert(){
		$this->modelParams();
		$id = $this->model->insertRisk();
		if($this->autosave){
			$this->model->saveChanges();
			header("Location: /$this->controller");
		}
		return $id;
	}

}
?>
