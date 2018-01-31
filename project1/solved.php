<?php
require "lib/game.inc.php";
$view = new Game\GameView($game);

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Nifty Nurikabe</title>
  <link href="nurikabe.css" type="text/css" rel="stylesheet" />
</head>
<header>

	<div class=align_text>
	<p><img class="header_picture" src="nifty800.png" width="" height="" alt="headerpicture" /></p>
	<nav id="new_game">
		<a href="./"><I>NEW GAME</I></a>
		<a href="instructions.html"><I>INSTRUCTIONS</I></a>
	</nav>
	</div>

	<h1>Congratulations, Player, you solved Nifty Nurikabe!</h1>


</header>

<body>
	<div class="game_body">
	<div class="table_section">
	<?php echo $view->ViewAnswer(); ?>
	<p>You're a winner!</p>
	</div>

</div>
</body>

<footer>
<p><img class="footer_picture" src="nifty1-800.png" width="" height="" alt="footerpicture" align="center"/></p>
</footer>



</html>