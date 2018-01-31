<?php
require_once "../lib/game.inc.php";
$controller = new \Nurikabe\IndexController($game, $_POST);

//var_dump($_SESSION);
header("location: " . $controller->getRedirect());