<?php
require_once "lib/game.inc.php";
$view = new Nurikabe\SolvedView($game);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nifty Nurikabe Solved</title>
	<link href="game.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
echo $view->present();
?>
</body>
</html>
