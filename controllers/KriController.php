<?php
require_once("models/KriModel.php");
require_once("models/ThresholdModel.php");
require_once("models/EventModel.php");
require_once("models/QualifierModel.php");
class KriController extends Controller{

	/* denota si se debe generar un commit en la base de datos para guardar la informacion de la ultima transaccion en curso */
	/* true genera commit automaticamente */
	/* false no genera commit hasta que termine la transaccion */
	public $autosave = false;

	public function __construct(){
		parent::__construct();
		/* modelos */
		$this->model = new KriModel(); //AFECTA A LA TABLA KRIS
		$this->event_model = new EventModel(); //AFECTA LA TABLA EVENTS
		$this->threshold_model = new ThresholdModel(); //AFECTA A LA TABLA QUALIFIERS
		$this->qualifier_model = new QualifierModel(); //AFECTA A LA TABLA QUALIFIERS
	}

	/* inserta un kri en base de datos y sus calificadores */
	/* 	retorna una redireccion al index de kri */
	public function insert(){
		$this->checkAccess("w");
		$this->modelParams();
		$id = $this->model->insert();
		$this->threshold_model->insertThresholds($id,$this->model->db);
		$this->model->saveChanges();
		header("Location: /$this->controller");
	}

	/* consulta un kri a apartir de su id y despliega la vista de modificacion de kri */
	/* calcula el puntaje del kri */
	/* returna una vista con la informacion del kri y su puntaje*/
	public function show(){
		$this->checkAccess("r");
		$id = $_GET["id"]; 
		$data = $this->model->getByIdScore($id);
		/* VISTA */
		require_once("views/$this->controller/show.php");
	}

	/* modifica un kri y sus umbrales */
	/* retorna un redirect al index del controlador */
	public function update(){
		$this->checkAccess("u");
		$id = $_GET["id"];
		$this->modelParams();
		$this->model->update($id);
		$this->threshold_model->updateThresholds($id,$this->model->db);
		$this->model->saveChanges();
		header("Location: /$this->controller");
	}

	/* retona la vista de inicio y trae sus datos en lista */
	public function create(){
		$this->checkAccess("w");
		$data=$this->qualifier_model->getAll();
		require_once("views/$this->controller/create.php");
	}
}
?>
