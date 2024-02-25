<?php
require_once("models/UserModel.php");
class RegisterController extends Controller{

	/* denota si se debe generar un commit en la base de datos para guardar la informacion de la ultima transaccion en curso */
	/* true genera commit automaticamente */
	/* false no genera commit hasta que termine la transaccion */
	public $autosave = true;

	public function __construct(){
		$this->model = new UserModel();
	}

	/* muestra el formulario de registro de usuarios */
	/* retorna una vista */
	public function index()
	{
		$this->checkAccess("r");
		require_once("views/register/index.php");
	}

	/* registra al usuario a traves del formulario y redirecciona a la pagina de login */
	public function register()
	{
		$this->insert();
		header("Location: /login");
	}
}
?>
