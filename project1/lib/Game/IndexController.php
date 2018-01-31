<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/9/17
 * Time: 8:44 PM
 */

namespace Game;


class IndexController {

    private $game;
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;

    public function __construct(Game $game) {
        $this->game = $game;

    }

    public function getPage() {
        return $this->page;
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

    public function setName($val){
        $this->game->name = $val;
    }

    public function setDimension($val){
        $this->game->dimension_name = $val;
    }

    public function getName(){
        return $this->game->name;
    }



}