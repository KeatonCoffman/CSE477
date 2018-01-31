<?php
/**
 * Base class for controllers
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * Base class for controllers
 *
 * Every controller needs to know what game it is
 * a part of and any redirect page.
 */
class Controller {
	/**
	 * Controller constructor.
	 * @param Game $game Game this is a part of
	 */
	public function  __construct(Game $game) {
		$this->game = $game;
	}

	/**
	 * Get the game
	 * @return Game
	 */
	public function getGame() {
		return $this->game;
	}

	/**
	 * Set any redirect page
	 * @param $redirect Redirect page
	 */
	public function setRedirect($redirect) {
		$this->redirect = $redirect;
	}

	/**
	 * Get any redirect page
	 * @return string Redirect page
	 */
	public function getRedirect() {
		return $this->redirect;
	}

	/**
	 * Debug option to display the redirect page instead of redirecting to it.
	 * @return string HTML
	 */
	public function showRedirect() {
		return "<p><a href=\"$this->redirect\">$this->redirect</a>";
	}

	private $game;
	private $redirect = "./";
}