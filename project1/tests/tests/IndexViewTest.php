<?php
namespace Game;
require __DIR__ . "/../../vendor/autoload.php";


class IndexViewTest extends \PHPUnit_Framework_TestCase
{

    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new IndexView($game);


    }

    public function test_present() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new IndexView($game);
        echo $view->present();

    }

}