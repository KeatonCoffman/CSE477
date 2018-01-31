<?php

require '../lib/site.inc.php';
$controller = new Felis\CaseController($site,$_GET, $_POST,$_SESSION);
header("location: " . $controller->getRedirect());