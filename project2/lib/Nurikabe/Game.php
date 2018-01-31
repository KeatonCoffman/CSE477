<?php
/**
 * The main game representation class
 *
 * Represents the current state of the game.
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * The main game representation class
 *
 * Represents the current state of the game.
 */
class Game {
	/**
	 * Set the game we will play, initializing for game play.
	 * @param $id ID for the game to set
	 * @return True if successful
	 */
	public function setGameById($id) {
		// Find the game in the collection
		$game = Games::getGame($id);
		if($game === null) {
			return false;
		}

		$this->desc = $game['desc'];

		// Empty grid...
		$this->grid = array();

		// Fill the grid
		$r = 0;
		foreach($game['game'] as $row) {
			$rowarray = array();
			$c = 0;
			foreach($row as $cell) {
				$rowarray[] = new Cell($cell,$r, $c);
				$c++;
			}

			$this->grid[] = $rowarray;
			$r++;
		}

		$this->checking = false;
		$this->clearing = false;
		$this->solving = false;

		return true;
	}

	/**
	 * Present the game as a table
	 * @param $buttons If true, put buttons in the cells
	 * @return string HTML
	 */
	public function present_game($buttons) {
		$grid = $this->getGrid();

		$html = <<<HTML
<table class="game">
HTML;

		foreach($grid as $row) {
			$html .= "<tr>";

			foreach($row as $cell) {
				$html .= $cell->present($buttons, $this->checking);
			}

			$html .= "</tr>";
		}

		$html .= "</table>";

		return $html;
	}

	/**
	 * Get the current game's description
	 * @return mixed Current game description
	 */
	public function getDesc() {
		return $this->desc;
	}

	/**
	 * Handle a click on a game grid cell
	 * @param $row
	 * @param $col
	 */
	public function click($row, $col) {
		if($row >= 0 && $row < count($this->grid)) {
			if($col >= 0 && $col < count($this->grid[$row])) {
				$this->grid[$row][$col]->click();
			}
		}
	}

	/**
	 * Reset the game to no current valid game
	 *
	 * This is called by IndexView to indicate now game active
	 */
	public function reset() {
		$this->grid = null;
		$this->desc = null;
	}

	/**
	 * Clear the game to an initial state
	 */
	public function clear() {
		foreach($this->grid as $row) {
			foreach($row as $cell) {
				$cell->clear();
			}
		}
	}

	/**
	 * Set the clearing state.
	 *
	 * This is set to indicate the press of Clear.
	 * A second Yes is then required for this to be accepted.
	 * @param $c Value to set
	 */
	public function setClearing($c) {
		$this->clearing = $c;
	}

	/**
	 * Get the value of clearing
	 * @return bool Current value
	 */
	public function isClearing() {
		return $this->clearing;
	}


	/**
	 * Solve the game?
	 */
	public function solve() {
		foreach($this->grid as $row) {
			foreach($row as $cell) {
				$cell->solve();
			}
		}
	}

	/**
	 * Is the game solved?
	 * @return bool True if game is solved
	 */
	public function solved() {
		foreach($this->grid as $row) {
			foreach($row as $cell) {
				if(!$cell->solved()) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Set the solving state.
	 *
	 * This is set to indicate the press of Solve.
	 * A second Yes is then required for this to be accepted.
	 * @param $c Value to set
	 */
	public function setSolving($c) {
		$this->solving = $c;
	}

	/**
	 * @return bool Solving property
	 */
	public function isSolving() {
		return $this->solving;
	}
	/**
	 * Get the current game grid as a PHP array.
	 */
	public function getGrid() {
		return $this->grid;
	}

	/**
	 * Set a message that appears on a page.
	 *
	 * This is used for error messages.
	 * @param $message Message string to set
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return Get any current message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Set the player's name
	 * @param $player Player name
	 */
	public function setPlayer($player) {
		$this->player = $player;
	}

	/**
	 * @return string Player name
	 */
	public function getPlayer() {
		return $this->player;
	}

	/**
	 * @param $checking Set true to enable error checking
	 */
	public function setChecking($checking) {
		$this->checking = $checking;
	}

	private $message = null;	///< Any error message for the pages?
	private $player = "";		///< Player name

	private $desc;				///< Game description
	private $grid = null;		///< Current game grid

	private $clearing = false;	///< True if we are asking if we are sure about clearing!
	private $solving = false;	///< True if we are asking if we are sure about solving?
	private $checking = false;	///< True if checking the result
}