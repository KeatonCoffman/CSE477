<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/9/17
 * Time: 12:48 PM
 */

namespace Game;


class View{

    public $game;

    public function __construct($game) {
        $this->game = $game;
    }

    public function getGame() {
        return $this->game;
    }

    public function present_header(){
        $html = "";
        $html .=<<<HTML
<header>

	<div class=align_text>
	<p><img class="header_picture" src="../nifty800.png" width="" height="" alt="headerpicture" /></p>
	<nav>
		<a href="instructions.php"><I>INSTRUCTIONS</I></a>
		</p>
	</nav>
	</div>

	<h1>Welcome to Keaton Coffman's Nifty Nurikabe!</h1>


</header>
HTML;
        return $html;
    }

    public function present_footer() {
        $html = "";
        $html .=<<<HTML
        <footer>
	<p><img class="footer_picture" src="../nifty1-800.png" width="" height="" alt="footerpicture" align="center"/></p>
</footer>
HTML;
        return $html;
    }




    public function present() {
        return $this->present_header() .
            $this->present_footer();
    }

}