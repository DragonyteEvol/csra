<?php
require_once("database.php");
require("models/Model.php");
require("controllers/Controller.php");

/* var_dump($_GET); */
/* extrae el nombre del controlador de la uri de la url*/
/* http://sy.com/mycontroller =====>>> mycontroller */
$controller = $_GET["controller"];
/* extrae el nombre de la funcion a llamar de la uri de la url */
/* http://sy.com/mycontroller/show =====>>> show*/
$action = $_GET["action"];
/* extrae el id o parametro personalizado en la funcion de la uri de la url */
/* http://sy.com/mycontroller/show/1 =====>>> 1*/
$id = $_GET["id"];

if(empty($action)){
	$action = "index";
}

$controller = ucfirst($controller) . "Controller";

/* referencia el controlador accedido por la uri y crea una instancia */
include "controllers/$controller.php";
$ctrl = new $controller;
/* llama a la funcion de la uri */
$ctrl->{$action}();
?>

