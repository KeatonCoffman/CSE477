<?php
namespace Game;
require __DIR__ . "/../../vendor/autoload.php";


class GameViewTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new GameView($game);

        //$this->assertContains(array(array()),$view->present());
    }

    public function test_ViewGame(){
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new GameView($game);

        $view->ViewGame();


    }
}