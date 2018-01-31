<?php
/**
 * Main game view class
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * Main game view class
 */
class GameView extends View {

    private $signed_in = "display:none;";



	public function __construct(Game $game, $session) {
		parent::__construct($game);

		if($game->getGrid() === null) {
			$this->setRedirect("./");
		}

        else if(isset($session['user'])){
            $this->signed_in = "";
        }

	}

	/**
	 * Preset the page header
	 * @return string HTML
	 */
	public function present_header() {
		$html = parent::present_header();

		$name = $this->getGame()->getPlayer();

		$html .= <<<HTML
<nav><p><a href="./">NEW GAME</a> <a href="instructions.php">INSTRUCTIONS</a></p></nav>
<h1 class="center">Greetings, $name, and welcome to Nifty Nurikabe!</h1>
</header>
HTML;

		return $html;
	}

	/**
	 * Present the page footer
	 * @return string HTML
	 */
	public function present_body() {
		$game = $this->getGame();

		$html = <<<HTML
<div class="body">
<form class="game" method="post" action="post/game.php">
HTML;

		$html .= $game->present_game(true);

		if($game->isSolving()) {
			$html .= <<<HTML
<p><button name="yes">Yes</button> <button name="no">No</button></p>
<p class="message">Are you sure you want to solve?</p>
HTML;
		} else if($game->isClearing()) {
			$html .= <<<HTML
<p><button name="yes">Yes</button> <button name="no">No</button></p>
<p class="message">Are you sure you want to clear?</p>
HTML;
		} else {
			$html .= <<<HTML
<p><button name="check">Check Solution</button> <button name="solve">Solve</button> 
<button name="clear">Clear</button></p> 
<button style =$this->signed_in name="save" value="true"  class = "save">Save Game</button>
<button style =$this->signed_in name="load" value="true"  class = "load">Load Game</button>
HTML;
		}

		if($game->getMessage() !== null) {
			$html .= '<p class="message">' . $game->getMessage() . '</p>';
		}

		$html .= <<<HTML
</form>
</div>
HTML;

		return $html;
	}
}