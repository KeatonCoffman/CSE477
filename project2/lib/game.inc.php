<?php

require __DIR__ . "/../vendor/autoload.php";



// Start the PHP session system
session_start();

define("NURIKABE_SESSION", 'nurikabe');

// If there is a Nurikabe session, use that. Otherwise, create one
if(!isset($_SESSION[NURIKABE_SESSION])) {
	$_SESSION[NURIKABE_SESSION] = new Nurikabe\Game();
}

$game = $_SESSION[NURIKABE_SESSION];