<?php
require_once("models/UserModel.php");
class RegisterController extends Controller{

	public function __construct(){
		$this->model = new UserModel();
	}

	/* muestra el formulario de registro de usuarios */
	/* retorna una vista */
	public function index()
	{
		require_once("views/register/index.php");
	}

	/* registra al usuario a traves del formulario y redirecciona a la pagina de login */
	public function register()
	{
		$this->create();
		header("Location: /login");
	}
}
?>
