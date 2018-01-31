<?php
require __DIR__ . '/lib/game.inc.php';


$controller = new Game\IndexController($game, $_POST);

header('Location: ' . $controller->getPage());
exit;

/**
//$controller->setName(strip_tags($_POST["name"]));
//$controller->setDimension($_POST["dimension"]);

$game->setActive(true);

if(isset($_POST["name"]) && !empty($_POST["name"])){
    header("Location: " . $controller->getPage());
    exit;
}
else{
    header("Location: " . "http://webdev.cse.msu.edu/~coffma30/project1/");
    exit;

}
**/