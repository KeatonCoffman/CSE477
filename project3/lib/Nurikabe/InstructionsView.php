<?php
/**
 * View class for the instructions page
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * View class for the instructions page
 */
class InstructionsView extends View {
	public function __construct(Game $game) {
		parent::__construct($game);
	}

	/**
	 * Present the page header
	 * @return string HTML
	 */
	public function present_header() {
		$html = parent::present_header();

		$html .= <<<HTML
<nav><p><a href="./">NEW GAME</a>
HTML;

		if($this->getGame()->getGrid() !== null) {
			if($this->getGame()->solved()) {
				$html .= ' <a href="solved.php">RETURN TO GAME</a>';
			} else {
				$html .= ' <a href="game.php">RETURN TO GAME</a>';
			}

		}

		$html .= <<<HTML
</p></nav>
<h1 class="center">Nifty Nurikabe Instructions</h1>
</header>
HTML;

		return $html;
	}
}