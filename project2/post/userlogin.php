<?php
require '../lib/localize.inc.php';
require '../lib/game.inc.php';

$controller = new \Nurikabe\UserLoginController($site, $_SESSION, $_POST);

//var_dump($_SESSION);

header("location: " . $controller->getRedirect());