<?php
require "lib/game.inc.php";
$view = new Game\GameView($game);

//if($game->ActiveGame() != true){
//    header ('Location'. 'index.php');
//}


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

	<?php echo $view->Greeting(); ?>


</header>

<body>
	<div class="game_body">
	<div class="table_section">
        <?php echo $view->ViewGame(); ?>
	</div>

    <!--
	<nav id="game_buttons">
		
		<p><input  type="submit" value="Check Solution"></p>
		<p><input  type="submit" value="Solve"></p>
		<p><input  type="submit" value="Clear"></p>
	</nav>
	-->


</div>
</body>

<footer>
	<p><img class="footer_picture" src="nifty1-800.png" width="" height="" alt="footerpicture" align="center"/></p>
</footer>
</html>