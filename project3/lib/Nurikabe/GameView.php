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
	public function __construct(Game $game) {
		parent::__construct($game);

		if($game->getGrid() === null) {
			$this->setRedirect("./");
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
<nav><p><a href="./">NEW GAME</a> <a href="instructions.php" target="_blank">INSTRUCTIONS</a></p></nav>
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


		/**

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
<button class="clear" name="clear">Clear</button></p>
HTML;
		}

		if($game->getMessage() !== null) {
			$html .= '<p class="message">' . $game->getMessage() . '</p>';
		}
         **/


		$html .=<<<HTML
<div class="checksolveclear">
   <p><button class="check">Check Solution</button> 
      <button class="solve">Solve</button> 
      <button class="clear">Clear</button></p>
</div>
<div class="yesno" style="display:none">
   <p><button class="yes">Yes</button> <button class="no">No</button></p>
   <p class="message">Are you sure you want to solve?</p>
</div>
<div class="yesno2" style="display:none">
   <p><button class="yes2">Yes</button> <button class="no2">No</button></p>
   <p class="message">Are you sure you want to solve?</p>
</div>
<div class="solved" style="display:none">
    <p class="center">You're a winner</p>
</div>
HTML;

/**
		$html .= <<<HTML
</form>
</div>
HTML;
 **/

		return $html;
	}
}