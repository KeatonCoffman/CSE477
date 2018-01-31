<?php
namespace Game;
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/8/17
 * Time: 9:29 PM
 */
class IndexView {

    public function __construct($game) {
        $this->game = $game;
    }

    public function present_header(){
        $html = "";
        $html .=<<<HTML
<header>

	<div class=align_text>
	<p><img class="header_picture" src="nifty800.png" width="" height="" alt="headerpicture" /></p>
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
	<p><img class="footer_picture" src="nifty1-800.png" width="" height="" alt="footerpicture" align="center"/></p>
</footer>
HTML;
        return $html;
    }


    public function present_body($name) {
        $html = "";
        $html .=<<<HTML

<div class="middle_content" >
	<form action="index-post.php" method="post" id="sessionForm">
		<p id="name_move">Name</p>
		<p> <input type="text" name="name" value=$name ><br> </p>
		<p>
		<select name="dimension">
		  <option value="3x3 Ultra Easy">3x3 Ultra Easy</option>
		  <option value="VeryEasy">8x8 Very Easy</option>
		  <option value="10x10 Easy">10x10 Easy</option>
		  <option value="8x8 Medium">8x8 Medium</option>
		</select>
		</p>
		<p><input id="start_button" type="submit" value="Start the Game"></p>
	



HTML;
        if (empty($this->game->getName()) ) {
            $html .= "<p id=".'"error_text"'.">You must enter a name! </p\>"."</"."form>"."</"."div>";
        }
        else{
            $html .="</"."form>". "</"."div>";
        }

        return $html;
    }



    public function present() {
        return $this->present_header() .
            $this->present_body($this->game->name) .
            $this->present_footer();
    }

}