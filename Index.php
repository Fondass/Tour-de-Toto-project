<?php

define("LOCALTEST",$_SERVER['HTTP_HOST']==="localhost");

session_start();

require_once("classes/class.page_controller.php");
require_once("classes/class.debug.php");
require_once ("./config/".('LOCALTEST'?"local":"remote").".php");


$controller = new FonController();
$controller->handleRequest();