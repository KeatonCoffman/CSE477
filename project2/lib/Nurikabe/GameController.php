<?php


namespace Nurikabe;

/**
 * Main game controller. Handles post from the game page.
 */
class GameController extends Controller {
	/**
	 * GameController constructor.
	 * @param Game $game Game object
	 * @param array $post $_POST
	 */
	public function __construct(Game $game, array $post) {
		parent::__construct($game);

		// Default will be to return to the game page
		$this->setRedirect("../game.php");

		$game->setChecking(isset($post['check']));

		// Clear any messages
		$game->setMessage(null);

		// Handle clicks on cells
		if(isset($post['cell'])) {
			$s = explode(',', strip_tags($post['cell']));
			$row = $s[0];
			$col = $s[1];

			$game->click($row, $col);
			if($game->solved()) {
				$this->setRedirect("../solved.php");
				return;
			}
		}

		//
		// Clearing logic
		//
		if($game->isClearing()) {
			if(isset($post['yes'])) {
				$game->clear();
			}

			$game->setClearing(false);
		}

		if(isset($post['clear'])) {
			$game->setClearing(true);
		}

		//
		// Solving logic
		//
		if($game->isSolving()) {
			if(isset($post['yes'])) {
				$game->solve();
				$this->setRedirect("../solved.php");
			}

			$game->setSolving(false);
		}

		if(isset($post['solve'])) {
			$game->setSolving(true);
		}

		/**
        if(isset($_POST['save'])){
            $users = new \Nurikabe\Users($site);
            $user = $users->save($_SESSION['user']->getEmail(), $game->getGrid());
        }
         **/


	}

}