<?php
require_once("database.php");
require("models/Model.php");
require("controllers/Controller.php");
/* var_dump($_GET); */
$controller = $_GET["controller"];
$action = $_GET["action"];
$id = $_GET["id"];

if(empty($action)){
	$action = "index";
}
$controller = ucfirst($controller) . "Controller";
include "controllers/$controller.php";
$ctrl = new $controller;
$ctrl->{$action}();
?>

