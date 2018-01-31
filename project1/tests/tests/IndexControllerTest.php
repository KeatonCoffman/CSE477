<?php
namespace Game;
require __DIR__ . "/../../vendor/autoload.php";



class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $controller = new IndexController($game);

    }

}