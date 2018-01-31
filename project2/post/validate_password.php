<?php
require '../lib/game.inc.php';
require '../lib/localize.inc.php';

$controller = new Nurikabe\ValidatePasswordController($site, $_POST);
header("location: " . $controller->getRedirect());