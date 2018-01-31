<?php
require "lib/game.inc.php";
$view = new Game\InstructionsView($game);

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

		<!--<a href="./"><I>NEW GAME</I></a>-->
        <?php echo $view->ReturnToGame() ?>
		<a href="instructions.html"><I>INSTRUCTIONS</I></a>
	</nav>
	</div>

	<h1>Nifty Nurikabe Instructions</h1>


</header>

<body>
	<div class="gray_back">
		<div class="green_area">
		<p><img id="solved" src="example1.png" width="" height="" alt="solved" /></p>

		<h2>Rules</h2>
		<p></p>

		<p>The game of Nurikabe is played on a rectangular grid of cells. Some cells contain numbers. When the game begins, all cells, other than the numbered cells, are empty, which is indicated by a cell filled with white. Game play consists of setting each cell to either an island or the sea.</p>

		<p>Islands are indicated by either cells with a number in them or cells with a dot. Every island has exactly one numbered cell that indicates how many cells there are in that island. Cells in an island are all connected horizontally or vertically.</p>


		<p>The sea is colored blue. A cell that is set to be part of the sea is filled with blue. There are two rules about the:</p>

		<ol>
		  <li>The sea is contiguous, meaning every sea cells is adjacent horizontally or vertically to another sea cell.</li>
		  <li>No "pools" are allowed. A pool is a 2 by 2 area of sea.</li>
		</ol>

		<p>Nurikabe solutions are unique. There is only one possible solution to any given game.</p>

		<h2>How to Play</h2>
		<p></p>


		<p>Game play proceeds by clicking on cells. Each click toggles a cell from empty to sea to island. For example, if an empty cell is clicked on, it becomes sea. If sea is clicked on, it becomes an island. If an island cell is clicked on, it becomes empty. Cells with numbers in them are automatically island cells and are not clickable at all.</p>

		<h2>Links</h2>
		<p></p>

		<ul>
			<li><a href="https://en.wikipedia.org/wiki/Nurikabe"><I>Wikipedia page on Nurikabe</I></a></li>
			<li><a href="http://dl.acm.org/citation.cfm?id=2362108"><I>Computational Complexity of Nurikabe</I></a></li>
		</ul>
		</div>
	</div>
</body>


<footer>
<p><img class="footer_picture" src="nifty1-800.png" width="" height="" alt="footerpicture" align="center"/></p>
</footer>

</html>