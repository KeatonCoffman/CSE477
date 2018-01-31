<?php
/**
 * View class for the solved puzzle page.
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * View class for the solved puzzle page.
 */
class SolvedView extends View {
	public function __construct(Game $game) {
		parent::__construct($game);

	}

	/**
	 * Present the page header
	 * @return string HTML
	 */
	public function present_header() {
		$html = parent::present_header();

		$name = $this->getGame()->getPlayer();

		$html .= <<<HTML
<nav><p><a href="./">NEW GAME</a> <a href="instructions.php">INSTRUCTIONS</a></p></nav>
<h1 class="center">Congratulations, $name, you solved Nifty Nurikabe!</h1>
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

		$html = <<<HTML
<div class="body">
HTML;

		$html .= $game->present_game(false);

		$html .= <<<HTML
<p class="center">You're a winner!</p>
</div>
HTML;

		return $html;
	}


}