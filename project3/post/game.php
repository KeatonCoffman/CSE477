<?php
require_once "../lib/game.inc.php";
$controller = new \Nurikabe\GameController($game, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());