<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/19/17
 * Time: 8:45 PM
 */

namespace Game;


class SolvedView
{
    public function __construct($game)
    {
        $this->game = $game;
    }

    public function ViewAnswer() {
        $games = $this->answers[$this->game->getDimension()];
        $game = $games['game'];


        $html = '<table class="table_section">';



        for($i=0;$i<sizeof($game);$i++){
            $html .= "<tr>";
            for($j=0;$j<sizeof($game);$j++){
                if($game[$i][$j] == "&nbsp;"){
                    $html .="<td class=\"cell_none\"><button name=\"cell\" value=\"$i,$j\">&nbsp;</button></td>";
                }
                else if(is_numeric($game[$i][$j])){
                    $num = $game[$i][$j];
                    $html .="<td class=\"number_cell\" value=\"$i,$j\">$num</td>";
                }
                else if($game[$i][$j] == "sea"){
                    $html .="<td class=\"sea_cell\"><button name=\"cell\" value=\"$i,$j\"></button></td>";

                }
                else if($game[$i][$j] == "island"){
                    $html .="<td class=\"island_cell\"><button name=\"cell\" value=\"$i,$j\">&#9679;</button></td>";
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



    public function present_header() {
        $name=$this->game->getName();
        $html=<<<HTML
<header>
    <img src="nifty800.png" height="140" width="800" alt="nifty image" />
    <nav>
        <p>
            <a href="./">NEW GAME</a>
            <a href="instructions.php">INSTRUCTIONS</a>
        </p>
    </nav>
    <h1>Congratulations, $name, you solved Nifty Nurikabe!</h1>
</header>
HTML;
        return $html;
    }

    public function present_footer(){
        $html=<<<HTML
<footer>
    <img src="nifty1-800.png" height="93" width="800" alt="nifty1"/>
</footer>
HTML;
        return $html;
    }

    public function present_body()
    {


    $this->ViewAnswer();



    }

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

}