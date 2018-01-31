<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/9/17
 * Time: 10:22 AM
 */

namespace Game;


class GameControllerTest extends \PHPUnit_Framework_TestCase {

    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $controller = new GameController($game);
    }

}