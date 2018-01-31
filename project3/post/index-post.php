<?php
require_once "../lib/game.inc.php";
$controller = new \Nurikabe\IndexController($game, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());