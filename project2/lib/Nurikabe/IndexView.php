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


    private $session;
    private $hide_login = '';
    private $nav_tag = "";
    private $user_name = "";
    private $disable_name = "";

	public function __construct(Game $game, $session) {
		parent::__construct($game);
        $this->session = $session;
		$game->reset();


        if(isset($session['name'])) {
            $this->user_name = $session['name'];
        }

        if(isset($session['error'])){
            $this->msg = $session['error'];
        }

        if(isset($session['user'])){
            $this->user_name = $session['user']->getName();
            $this->disable_name = 'disabled';
            $this->hide_login = "<input type='hidden' value='{$session['user']->getName()}' name='name'>";
            $this->nav_tag = "<p><a href=\"instructions.php\">INSTRUCTIONS</a>  <a href=\"./post/logout.php\">LOG OUT</a> ";
        }
        else{
            $this->nav_tag = "<p><a href=\"instructions.php\">INSTRUCTIONS</a>  <a href=\"login.php\">LOG IN</a>  <a href=\"newuser.php\">NEW USER</a></p>";
        }



	}

	/**
	 * Present the page header
	 * @return string HTML
	 */
	public function present_header() {
		$html = parent::present_header();

		$html .= <<<HTML
<nav>
$this->nav_tag
</nav>
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


		$html = <<<HTML
<div class="body">
<form class="newgame" method="post" action="post/index-post.php">
   
	$this->hide_login
	
	<div class="controls">
	<p class="name"><label for="name">Name </label><br><input $this->disable_name type="text" id="name" name="name" value="$this->user_name"></p>
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