<?php
namespace Game;
require __DIR__ . "/../../vendor/autoload.php";


class ViewTest  extends \PHPUnit_Framework_TestCase
{
    public function test_present() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $this->present = new View($game);
        //$this->present;

        echo $this->present->present();

    }

    public function test_getGame() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new View($game);

        $this->assertEquals($game,$view->getGame());

    }
}