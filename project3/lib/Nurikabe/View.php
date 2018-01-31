<?php
/**
 * General purpose view base class, where we put generic formatting.
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * General purpose view base class, where we put generic formatting.
 */
class View {
	public function  __construct($game) {
		$this->game = $game;
	}

	public function getGame() {
		return $this->game;
	}

	public function setRedirect($redirect) {
		$this->redirect = $redirect;
	}

	public function getRedirect() {
		return $this->redirect;
	}

	public function present() {
		return $this->present_header() .
			$this->present_body() .
			$this->present_footer();
	}

	public function present_header() {
		$html = <<<HTML
		<header>
<p class="center"><img src="images/nifty800.png" width="800" height="140" alt="Header image"/></p>
HTML;
		return $html;
	}

	public function present_footer() {
		$html = <<<HTML
<footer>
	<p class="center"><img src="images/nifty1-800.png" width="800" height="93" alt="Footer image"/></p>
</footer>
HTML;

		return $html;
	}

	private $game;
	private $redirect = null;
}