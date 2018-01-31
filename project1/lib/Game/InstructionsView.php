<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/10/17
 * Time: 7:16 PM
 */

namespace Game;


class InstructionsView
{
    public function __construct($game){

        $this->game= $game;
    }

    public function ReturnToGame() {
        $html = '<p><a href="index.php">NEW GAME</a>';
        if($this->game->getGame() !== null){
            $html .=  ' <a href="post/game-post.php">RETURN TO GAME</a> </p>';
        }
        return $html;
    }
}