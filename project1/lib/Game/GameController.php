<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/8/17
 * Time: 9:37 PM
 */

namespace Game;


class GameController {

    private $game;
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;

    public function __construct(Game $game,$post) {
        $this->game = $game;

        if(isset($post["name"])){
            $name = strip_tags($post["name"]);
            $name = trim($name);
            if (!empty($name)){
                $this->changeName($name);
                $this->page="game.php";
            }
            else {
                //$this->game->setFailFlag();
                $this->page="index.php";
            }
        }
        //if (isset($post["mode"])){
        //    $this->game->setMode($post["mode"]);
        //}
        if (isset($post["check"])){
            $this->game->Usercheck();
        }
        if (isset($post["solve"])){
            $this->game->askSolve();
            if ($post["solve"]=="yes"){

                // An array of arrays carrying the answers
                //$answers = $this->game->answers[$this->game->getDimension()]['game'];//[$row][$col]

                //$size = count($answers);





                //$this->game->getSolution()[$this->game->getDimension()]['game'];
                if($this->game->cellCheck()) {
                    $this->page = "solved.php";
                }
                $this->game->noSolve();
            }
            elseif($post["solve"]=="no"){
                $this->game->noSolve();
            }
        }
        if (isset($post["clear"])){
            $this->game->askClear();
            if ($post["clear"]=="yes"){
                $this->game->delete();
                $this->game->noClear();
                $this->game->destroyGame();
            }
            elseif($post["clear"]=="no"){
                $this->game->noClear();

            }
        }

    }


    public function isReset() {
        if($this->reset === true){
            return true;
        }
        else{
            return false;
        }
    }



    public function showRedirect() {
        return "<p><a href=\"$this->page\">$this->page</a>";
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

    public function changeName($val){
        $new_name=strip_tags($val);
        $this->game->setName($new_name);
    }

    public function getPage()
    {
        return $this->page;
    }


    public function ViewAnswer()
    {
        $games = $this->answers[$this->game->getDimension()];
        $game = $games['game'];


        $html = '<table class="table_section">';


        for ($i = 0; $i < sizeof($game); $i++) {
            $html .= "</tr>";
            for ($j = 0; $j < sizeof($game[$i]); $j++) {
                if ($game[$i][$j] === "&nbsp;") {
                    $html .= "<td class=\"cell_none\"><button name=\"cell\" >&nbsp;</button></td>";
                } else if ($game[$i][$j] === "sea") {
                    $html .= "<td class=\"sea_cell\"><button name=\"cell\" </button></td>";
                } else if ($game[$i][$j] === "island") {
                    $html .= "<td class=\"island_cell\"><button name=\"cell\" >&#9679;</button></td>";
                } else if (is_numeric($game[$i][$j])) {
                    $num = $game[$i][$j];
                    $html .= "<td class=\"number_cell\" >$num</td>";
                }
            }
            $html .= "</tr>";
        }
        $html .= '</table>';
        return $html;


    }