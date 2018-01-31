<?php
require '../lib/localize.inc.php';
require_once "../lib/game.inc.php";

$controller = new \Nurikabe\GameController($game, $_POST);

/**
if(isset($_POST['save'])){
    $users = new \Nurikabe\Users($site);
    $user = $users->save($_SESSION['user']->getEmail(), $game->getGrid());
}

/**
if(isset($_POST['load'])){
    $users = new \Nurikabe\Users($site);
    $data = $users->load($game->getMode(), $_SESSION['user']->getEmail());

    $game->getBoard()->importConvertedCell($data);
}
 **/


header("location: " . $controller->getRedirect());