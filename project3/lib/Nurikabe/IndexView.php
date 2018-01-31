<?php
/**
 * View class for the Index (main) page
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * View class for the Index (main) page
 */

class IndexView extends View {
	public function __construct(Game $game) {
		parent::__construct($game);
		$game->reset();
	}

	/**
	 * Present the page header
	 * @return string HTML
	 */
	public function present_header() {
		$html = parent::present_header();

		$html .= <<<HTML
<nav><p><a href="instructions.php">INSTRUCTIONS</a></p></nav>
<h1 class="center">Welcome to Keaton Coffman's Nifty Nurikabe!</h1>
</header>
HTML;

		return $html;
	}

	/**
	 * Present the page body
	 * @return string HTML
	 */
	public function present_body() {
		$game = $this->getGame();
		$name = $game->getPlayer();

		$html = <<<HTML
<div class="body">
<form class="newgame" method="post" action="post/index-post.php">
	<div class="controls">
	<p class="name"><label for="name">Name </label><br><input type="text" id="name" name="name" value="$name"></p>
	<p><select name="game">
HTML;

		foreach(Games::$games as $id => $g) {
			$desc = $g['desc'];
			$html .= "<option value=\"$id\">$desc</option>";
		}

		$html .= <<<HTML
		</select></p>
	<p><button>Start Game</button></p>
HTML;
		if($game->getMessage() !== null) {
			$html .= '<p class="message">' . $game->getMessage() . '</p>';
		}

		$html .= <<<HTML
	</div>
</form>
</div>
HTML;

		return $html;
	}
}