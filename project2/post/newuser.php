<?php
require '../lib/localize.inc.php';

//var_dump($_POST);
$controller = new Nurikabe\NewUserController($site, $_POST);
header("Location: " . $controller->getRedirect());