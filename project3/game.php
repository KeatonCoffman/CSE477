<?php
require_once "lib/game.inc.php";
$view = new Nurikabe\GameView($game);

if($view->getRedirect() !== null) {
	header("location: " . $view->getRedirect());
	exit;
}

$desc = $game->getDesc();
$json_solution = json_encode(array('game' => $game->getSolutions($desc)));

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nifty Nurikabe</title>
	<link href="game.css" type="text/css" rel="stylesheet" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="site.con.js"></script>

    <script>
        $(document).ready(function() {
            new Cells("form",<?php echo $json_solution?>);
        });
    </script>

</head>

<body>
<?php
echo $view->present();
?>
</body>
</html>
