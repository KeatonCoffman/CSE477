<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/8/17
 * Time: 8:21 PM
 */

namespace Game;


class GameView{

    public $game;

    public function __construct(Game $game) {
        $this->game = $game;
    }

    public function ViewGame() {
        $games = $this->games[$this->game->getDimension()];
        $game = $games['game'];


        $html = "<form method='post' action='game-post.php'>";
        $html .= '<table class="table_section">';



        for($i=0;$i<sizeof($game);$i++){
            $html .= "<tr>";
            for($j=0;$j<sizeof($game);$j++){
                if($game[$i][$j] == 'j'){
                    $html .="<td class=\"cell_none\"><button name=\"cell\" value=\"$i,$j\">&nbsp;</button></td>";
                }
                else if($game[$i][$j] == "s"){
                    $html .="<td class=\"sea_cell\"><button name=\"cell\" value=\"$i,$j\"></button></td>";

                }
                else if(is_numeric($game[$i][$j])){
                    $num = $game[$i][$j];
                    $html .="<td class=\"number_cell\" value=\"$i,$j\">$num</td>";
                }
                else if($game[$i][$j] == "i"){
                    $html .="<td class=\"island_cell\"><button name=\"cell\" value=\"$i,$j\">&#9679;</button></td>";
                }
            }
            $html .= "</tr>";
        }



        $html .= '</table>';
        $html .= "</form>";

        /**
        for($i=0;$i<sizeof($game);$i++){
            $html .= "</tr>";
            for($j=0;$j<sizeof($game[$i]);$j++){


                if($game[$i][$j] == "&nbsp;"){
                    $html .="<td class=\"cell_none\"><button name=\"cell\" value=\"0,5\">&nbsp;</button></td>";
                }
                else if(is_numeric($game[$i][$j])){
                    $ne = $game[$i][$j];
                    $html .="<td class=\"number_cell\">$ne</td>";
                }
                else if($game[$i][$j] == "sea"){
                    $html .="<td class=\"sea_cell\"><button name=\"cell\" value=\"0,5\"></button></td>";

                }
                else if($game[$i][$j] == "island"){
                    $html .="<td class=\"island_cell\"><button name=\"cell\" value=\"0,5\">&#9679;</button></td>";
                }


            }
            $html .= "</tr>";

        }
         **/

        $html .= '</form>';

        $html .= '</table>';

        $html .= "<form method='post' action='game-post.php'>";

        /**
        $html .= <<<HTML
        <nav id="game_buttons">
                <p>
                 <button name="check" value="check" class="main_button">Check Solution</button>
                 <button name="solve" value="solve" class="main_button">Solve</button> 
                 <button name="clear" value="clear" class="main_button">Clear</button>
                </p>
        </nav>
</form>
HTML;
         **/
        if($this->game->getSolve()){
            $buttons = <<<BUTTONS
        <p>
        <button type="submit" name="solve" value="yes" class="main_button">yes</button>
        <button type="submit" name="solve" value="no" class="main_button">no</button>
        </p>
        <p id='name_error'>Are you sure you want to solve?</p>
BUTTONS;
        }
        elseif($this->game->getClear()){
            $buttons = <<<BUTTONS
        <p>
        <button type="submit" name="clear" value="yes" class="main_button">yes</button>
        <button type="submit" name="clear" value="no" class="main_button">no</button>
        </p>
        <p id='name_error'>Are you sure you want to clear?</p>
BUTTONS;
        }
        else{
            $buttons = <<<BUTTONS
        <p>
        <button type="submit" name="check" value="check" class="main_button">Check Solution</button>
        <button type="submit" name="solve" value="solve" class="main_button">Solve</button>
        <button type="submit" name="clear" value="clear" class="main_button">Clear</button>
        </p>
BUTTONS;

        }

        $html.=<<<HTML
    </table>
    <div class="bottom">
    $buttons
    </div>
    </form>
</div>
HTML;
        return $html;

    }


    public function ViewAnswer() {
        $games = $this->answers[$this->game->getDimension()];
        $game = $games['game'];


        $html = '<table class="table_section">';



        for($i=0;$i<sizeof($game);$i++){
            $html .= "</tr>";
            for($j=0;$j<sizeof($game[$i]);$j++){


                if($game[$i][$j] === "&nbsp;"){
                    $html .="<td class=\"cell_none\"><button name=\"cell\" value=\"$i,$j\">&nbsp;</button></td>";
                }
                else if($game[$i][$j] === "sea"){
                    $html .="<td class=\"sea_cell\"><button name=\"cell\" value=\"$i,$j\"></button></td>";

                }
                else if($game[$i][$j] === "island"){
                    $html .="<td class=\"island_cell\"><button name=\"cell\" value=\"$i,$j\">&#9679;</button></td>";
                }
                else if(is_numeric($game[$i][$j])){
                    $num = $game[$i][$j];
                    $html .="<td class=\"number_cell\" value=\"$i,$j\">$num</td>";
                }


            }
            $html .= "</tr>";
        }



        $html .= '</table>';

        $html .= <<<HTML
        <nav id="game_buttons">
                <p>
                 <button name="check" value="check" class="main_button">Check Solution</button>
                 <button name="solve" value="solve" class="main_button">Solve</button> 
                 <button name="clear" value="clear" class="main_button">Clear</button>
                </p>
        </nav>
</form>
HTML;

        return $html;
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

	<h1>Welcome to Charles Owen's Nifty Nurikabe!</h1>


</header>
HTML;
        return $html;
    }

    public function present_body() {
        $html = '<form class="game" method="post" action="/game-post.php">';

        $html .= $this->ViewGame();


        $html .= '</form>';

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

    public function IsGameActive(){
        if ($this->game->ActiveGame() === false){
            return 'index.php';
        }
        else{
            return null;
        }

    }

    public function Greeting() {
        $name = $this->game->getName();
        return "<h1>Greetings, $name, and welcome to Nifty Nurikabe!</h1>";
    }

    public function Congratulations() {
        $name = $this->game->getName();
        return "<h1>Congratulations, $name, you solved Nifty Nurikabe!</h1>";
    }


    /**

    private function SolveButtons(){
        $html = <<<HTML
                <p>
                 <button name="menu_button" value="yes" class="main_button">Yes</button>
                 <button name="menu_button" value="no" class="main_button">No</button> 
                </p>
           
HTML;
        return $html;
    }
     *
     **/

    public $answers= [
        '3x3 Ultra Easy'=> ['desc'=>'3x3 Ultra Easy', 'game'=>[[1, 'sea', 1],
            ['sea', 'sea', 'sea'],
            [2, 'island', 'sea']]],
        'VeryEasy'=> ['desc'=>'8x8 Very Easy', 'game'=>[['sea', 'sea', 2, 'sea', 'sea', 'sea', 'sea', 'sea'],
            ['sea', 1, 'sea', 'sea', 'sea', 4, 'island', 'sea'],
            ['sea', 'sea', 'sea', 'island', 2, 'sea', 'island', 'sea'],
            ['sea', 2, 'island', 'sea', 'sea', 'sea', 'island', 'sea'],
            [4, 'sea', 'sea', 'sea', 'island', 2, 'sea', 'sea'],
            ['island', 'sea', 'island', 'sea', 'sea', 'sea', 'sea', 'island'],
            ['island', 'sea', 'island', 3, 'sea', 'island', 'sea', 3],
            ['island', 'sea', 'sea', 'sea', 'island', 3, 'sea', 'island']]],
        '10x10 Easy'=> ['desc'=>'10x10 Easy', 'game'=>[[4, 'island', 'island', 'island', 'sea', 'sea', 'sea', 'sea', 'sea', 1],
            ['sea', 'sea', 'sea', 'sea','sea', 'island', 'island', 'sea', 'island', 'sea'],
            ['sea', 'island', 'sea', 'island', 'island', 'sea', 3, 'sea', 3, 'sea'],
            ['sea', 2, 'sea', 3, 'sea', 'sea', 'sea', 'sea', 'island', 'sea'],
            [1, 'sea', 'sea', 'sea', 4, 'island', 'sea', 3, 'sea', 'sea'],
            ['sea', 'sea', 2, 'island', 'sea', 'island', 'sea', 'island', 'sea', 5],
            ['sea', 'island', 'sea', 'sea', 'sea', 'island', 'sea', 'island', 'sea', 'island'],
            ['sea', 'island', 'sea', 1, 'sea', 'sea', 'sea', 'sea', 'sea', 'island'],
            ['sea', 'island', 4, 'sea', 'sea', 3, 'island', 'island', 'sea', 0],
            ['sea', 'sea', 'sea', 'island', 2, 'sea', 'sea', 'sea', 'sea', 'island']]],
        '8x8 Medium'=> ['desc'=>'8x8 Medium', 'game'=>[['island', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea'],
            [2, 'sea', 'island', 'island', 'sea', 'island', 'island', 'island'],
            ['sea', 4, 'island', 'sea', 'sea', 'sea','sea', 'island'],
            ['sea', 'sea', 'sea', 'sea', 2, 'island', 'sea', 6],
            ['sea', 'island', 'sea', 2, 'sea', 'sea', 'sea', 'island'],
            ['sea', 2, 'sea', 'island', 'sea', 'island', 'sea', 'sea'],
            [5, 'sea', 'sea', 'sea', 4, 'island', 'island', 'sea'],
            ['island', 'island', 'island', 'island', 'sea', 'sea', 'sea', 'sea']]],

    ];

    public $games =
        [ '3x3 Ultra Easy'=> ['desc'=>'3x3 Ultra Easy', 'game'=>[[1, 0, 1], [0, 0, 0], [2, 0, 0]]], 'VeryEasy'=> ['desc'=>'8x8 Very Easy', 'game'=>[[0, 0, 2, 0, 0, 0, 0, 0], [0, 1, 0, 0, 0, 4, 0, 0], [0, 0, 0, 0, 2, 0, 0, 0],[0, 2, 0, 0, 0, 0, 0, 0],[4, 0, 0, 0, 0, 2, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 3, 0, 0, 0, 3],[0, 0, 0, 0, 3, 0, 0, 0] ]], '10x10 Easy'=> ['desc'=>'10x10 Easy', 'game'=>[[4, 0, 0, 0, 0, 0, 0, 0, 0, 1], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 3, 0, 3, 0],[0, 2, 0, 3, 0, 0, 0, 0, 0, 0],[1, 0, 0, 0, 4, 0, 0, 3, 0, 0],[0, 0, 2, 0, 0, 0, 0, 0, 0, 5],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 1, 0, 0, 0, 0, 0, 0],[0, 0, 4, 0, 0, 3, 0, 0, 0, 0],[0, 0, 0, 0, 2, 0, 0, 0, 0, 0] ]],
            '8x8 Medium'=> ['desc'=>'8x8 Medium', 'game'=>[[0, 0, 0, 0, 0, 0, 0, 0], [2, 0, 0, 0, 0, 0, 0, 0], [0, 4, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 2, 0, 0, 6],[0, 0, 0, 2, 0, 0, 0, 0],[0, 2, 0, 0, 0, 0, 0, 0],[5, 0, 0, 0, 4, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0] ]],
        ];




    
}