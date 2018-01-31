<?php
require __DIR__ . '/../vendor/autoload.php';

//session_start();
if(session_status()==PHP_SESSION_NONE) session_start();

if (!defined("GAME_SESSION")) define("GAME_SESSION",'game');



if(!isset($_SESSION['GAME_SESSION'])) {
    $_SESSION['GAME_SESSION'] = new Game\Game();
}

$game = $_SESSION['GAME_SESSION'];


