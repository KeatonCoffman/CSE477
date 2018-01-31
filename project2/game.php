<?php
require_once "lib/game.inc.php";
$view = new Nurikabe\GameView($game,$_SESSION);
if($view->getRedirect() !== null) {
	header("location: " . $view->getRedirect());
	exit;
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nifty Nurikabe</title>
	<link href="game.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
echo $view->present();
?>
</body>
</html>
