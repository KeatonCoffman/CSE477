<?php
namespace Game;
require __DIR__ . "/../../vendor/autoload.php";


class GameTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);
        $this->assertInstanceOf("Game\Game", $game);

    }

    public function test_getDimension() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $this->assertEquals(3, $game->getDimension());

    }

    public function test_MakeGame() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $game->MakeGame();

    }

    public function test_MakeSolution() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $game->MakeSolution();

    }

}