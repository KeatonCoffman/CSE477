<?php
require __DIR__ . '/lib/game.inc.php';
$controller = new Game\GameController($game, $_POST);


header('Location: ' . $controller->getPage());

exit;