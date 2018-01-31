<?php
/**
 * Controller for the form on the main (index) page.
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * Controller for the form on the main (index) page.
 */

class IndexController extends Controller {
	/**
	 * IndexController constructor.
	 * @param Game $game The game object
	 * @param array $post $_POST
	 */
	public function __construct(Game $game, array $post) {
		parent::__construct($game);

		// Default will be to return to the home page
		$this->setRedirect("../");

		// Clear any error
		$game->setMessage(null);

		if(!isset($post['name']) || !isset($post['game'])) {
			return;
		}

		$name = trim(strip_tags($post['name']));
		if($name === '') {
			$game->setMessage("You must enter a name!");
			return;
		}

		$id = strip_tags($post['game']);
		if(!$game->setGameById($id)) {
			$game->setMessage("Invalid game!");
			return;
		}

		$game->setPlayer($name);

		$this->setRedirect("../game.php");
	}
}